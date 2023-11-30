<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\TransactionSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionSubscriptionController extends Controller
{
    protected $title = 'Transaction Subscription';
    protected $menu = 'transaction-subscription';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.transaction-subscription';
    public function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        return view($this->direktori . '.main', $data);
    }

    public function datagrid(Request $request)
    {
        $data = TransactionSubscription::getData($request);
        foreach ($data['rows'] as $key => $dt) {
            $dt->transaction_status = "
                <a href='javascript:void(0)' class='btn btn-sm btn-success'>$dt->transaction_status</a>
                ";
            $dt->name_user = User::find($dt->user_id)['name'];
            $dt->gross_amount = "Rp. " . number_format($dt->gross_amount, 0, ',', '.');
        }
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = array();
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = Auth::user()->level_user == 'Pengguna' ? IdentitasWeb::query()->where('web_preferences_id', $data['web_preferences_id'])->first() : IdentitasWeb::query()->first();

        $data['edit'] = (!empty($request->id)) ? true : false;
        $data['id_transaction_subscription'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? TransactionSubscription::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }
}
