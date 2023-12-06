<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\TransactionRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryTransactionController extends Controller
{
    protected $title = 'History Transaction';
    protected $menu = 'history';
    protected $sub_menu = '';
    protected $direktori = 'user.page.history-transaction';
    public function main(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['cover_path'] = null;
        $data['transaction_rooms'] = TransactionRoom::query()->where('user_id', Auth::id())->with(['room', 'room.category_room'])->latest()->get();
        return view($this->direktori . '.main', $data);
    }
}
