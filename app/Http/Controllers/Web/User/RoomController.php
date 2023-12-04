<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $title = 'Rooms';
    protected $menu = 'rooms';
    protected $sub_menu = '';
    protected $direktori = 'user.page.room';
    public function main(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['rooms'] = Room::query()->latest()->paginate(10);
        $data['cover_path'] = null;
        return view($this->direktori . '.main', $data);
    }
    public function detail($slug_room)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['cover_path'] = null;
    }
}
