<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionSubscription;
use Carbon\Carbon;
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
        $data['subscription_valid'] = false;
        $date_subscription = '';
        $transaction_subscription_latest = TransactionSubscription::query()->where('user_id', Auth::id())->where('status', 'Paid')->latest()->first();
        if ($transaction_subscription_latest) {
            $date_subscription_latest = Carbon::now($transaction_subscription_latest->date_subscription);
            if (Carbon::now()->diffInMonths($date_subscription_latest)) {
                $date_subscription = $date_subscription_latest->addMonth();
            } else {
                $data['subscription_valid'] = true;
            }
        } else {
            $date_subscription_latest = Carbon::parse(Auth::user()->created_at)->subMonth();
            $date_subscription = Carbon::parse(Auth::user()->created_at);
        }
        if ($data['subscription_valid']) {
            $data['message'] = 'You have already paid for your subscription for this month';
        } else {
            $transaction_subscription = TransactionSubscription::create([
                'user_id' => Auth::id(),
                'checkout_link' => '-',
                'external_id' => $external_id,
                'payment_type' => '-',
                'status' => 'Unpaid',
                'amount' => $amount,
                'date_subscription' => $date_subscription,
            ]);
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $external_id,
                    'gross_amount' => $amount,
                ),
                'customer_details' => array(
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->no_wa,
                ),
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $interval_unpayment = Carbon::now()->diffInMonths($date_subscription_latest);
            $data['message'] = "You haven't paid for $interval_unpayment months, please pay now";
        }
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['snap_token'] = $snapToken;
        $data['identitas_web'] = $identitas_web;
        return view($this->direktori . '.subscription', $data);
    }
    public function callbackPayment(Request $request)
    {
        $server_key = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $server_key);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $transaction_subscription = TransactionSubscription::query()->where('external_id', $request->order_id)->first();
                $transaction_subscription->update([
                    'status' => 'Paid',
                ]);
            }
        }
    }
}
