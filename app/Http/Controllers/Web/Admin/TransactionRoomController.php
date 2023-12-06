<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Models\TransactionRoom;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionRoomController extends Controller
{
    protected $title = 'Transaction Room';
    protected $menu = 'transaction-room';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.transaction-room';
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
        $data = TransactionRoom::getData($request);
        foreach ($data['rows'] as $key => $dt) {
            $dt->name_user = User::find($dt->user_id)['name'];
            $dt->name_room = Room::find($dt->room_id)['name_room'];
        }
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = array();
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();

        $data['edit'] = (!empty($request->id)) ? true : false;
        $data['id_transaction_room'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? TransactionRoom::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function store(Request $request)
    {
        $id = $request->id_transaction_room;
        if (empty($request->room_id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Name Room Field Must Be Filled', null);
        }
        if (empty($request->user_id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'User Name Field Must Be Filled', null);
        }
        if (empty($request->start_date)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Start Date Field Must Be Filled', null);
        }
        if (empty($request->end_date)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'End Date Field Must Be Filled', null);
        }
        $transaction_room = TransactionRoom::find($id);
        if (empty($transaction_room)) {
            $transaction_room = new TransactionRoom();
        }
        $transaction_room->room_id = $request->room_id;
        $transaction_room->user_id = $request->user_id;
        $transaction_room->start_date = $request->start_date;
        $transaction_room->end_date = $request->end_date;
        $transaction_room->save();

        if ($transaction_room) {
            $no_receipt = 'SA-' . str_pad($transaction_room->id_transaction_room, 6, '0', STR_PAD_LEFT);
            $transaction_room->no_receipt = $no_receipt;
            $transaction_room->save();
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Successfully Save Data', null);
            } else {
                return ResponseJsonTrait::responseJson(200, 'success', 'Successfully Update Data', null);
            }
        } else {
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Save Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Update Data', null);
            }
        }
    }
    public function destroy(Request $request)
    {
        $transaction_room = TransactionRoom::find($request->id);
        if (!empty($transaction_room)) {
            $transaction_room->delete();
            if ($transaction_room) {
                return ['status' => 'success', 'code' => 200, 'message' => 'Berhasil Menghapus Data'];
            } else {
                return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
            }
        } else {
            return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }
}
