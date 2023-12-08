<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\TransactionRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $title = 'Dashboard';
    protected $menu = 'dashboard';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.dashboard';
    public function index(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['pengguna_count'] = User::query()->where('level_user', 'Regular')->count();
        $data['mitra_count'] = User::query()->where('level_user', 'Partner')->count();
        if (Auth::user()->level_user == 'Partner') {
            $data['transaksi_count'] = TransactionRoom::query()->join('rooms', 'rooms.id_room', '=', 'transaction_rooms.room_id')->where('rooms.user_id', Auth::id())->count();
        } else {
            $data['transaksi_count'] = TransactionRoom::query()->count();
        }
        $data['cover_path'] = null;
        return view($this->direktori . '.main', $data);
    }
}
