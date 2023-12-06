<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SubscriptionUserController extends Controller
{
    protected $title = 'Subscription';
    protected $menu = 'subscription';
    protected $sub_menu = '';
    protected $direktori = 'user.page.subscription';
    public function main(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['cover_path'] = null;
        return view($this->direktori . '.main', $data);
    }
    public function createPayment(Request $request)
    {
        $identitas_web = IdentitasWeb::query()->first();
        $external_id = Str::uuid();
        $amount = 0;
        if (Auth::user()->level_subscription == 'Class 1') {
            $amount = $identitas_web->payment_class_1;
        } elseif (Auth::user()->level_subscription == 'Class 2') {
            $amount = $identitas_web->payment_class_2;
        } else {
            $amount = $identitas_web->payment_class_3;
        }
        $transaction_subscription = TransactionSubscription::create([
            'user_id' => Auth::id(),
            'checkout_link' => '-',
            'external_id' => $external_id,
            'payment_type' => '-',
            'status' => 'pending',
            'amount' => $amount,
        ]);
        $params = [
            'external_id' => $external_id,
            'payer_email' => Auth::user()->email,
            'description' => "User Subscription Rp. $amount",
            'amount' => $amount,
            'redirect_url' => '127.0.0.1:8000/subscription'
        ];
        $invoice = $this->createInvoice($params);
        $transaction_subscription->update([
            'checkout_link' => $invoice['invoice_url'],
        ]);
        return redirect()->away($transaction_subscription->checkout_link);
    }
    public function createInvoice($request)
    {
        $xendit_key = base64_encode(env('XENDIT_SECRET_KEY'));
        $authorization = "Basic $xendit_key";
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $authorization,
        ];
        $res = Http::withHeaders($headers)->post('https://api.xendit.co/v2/invoices', $request);
        return json_decode($res->body(), true);
    }
    public function callbackInvoice(Request $request)
    {
        try {
            $transaction_subscription = TransactionSubscription::query()->where('external_id', $request->external_id)->first();
            if ($request->header('x-callback-token') != env('XENDIT_CALLBACK_TOKEN')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid callback token',
                ], 400);
            }
            if ($transaction_subscription) {
                $transaction_subscription->update([
                    'status' => $request->status,
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
