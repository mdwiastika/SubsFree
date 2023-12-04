<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $title = 'Home';
    protected $menu = 'home';
    protected $sub_menu = '';
    protected $direktori = 'user.page.home';
    public function main(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['cover_path'] = null;
        return view($this->direktori . '.main', $data);
    }
}
