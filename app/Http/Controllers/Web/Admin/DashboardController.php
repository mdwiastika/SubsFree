<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\TransactionRoom;
use App\Models\User;
use Illuminate\Http\Request;

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
        $data['pengguna_count'] = User::query()->where('level_user', 'Pengguna')->count();
        $data['mitra_count'] = User::query()->where('level_user', 'Mitra')->count();
        $data['transaksi_count'] = TransactionRoom::query()->count();
        $data['cover_path'] = null;
        return view($this->direktori . '.main', $data);
    }
}
