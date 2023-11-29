<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $title = 'User';
    protected $menu = 'user';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.user';
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
        $data = User::getData($request);
        foreach ($data['rows'] as $key => $dt) {
            // Admin, Analis, Programmer, Designer, Client, Finance
            if ($dt->status_user == 'Aktif') {
                $dt->status_user = "
                <a href='javascript:void(0)' class='btn btn-sm btn-success' onclick=changeStatus($dt->id)>$dt->status_user <span class='fas fa-sync'></span></a>
                ";
            } else {
                $dt->status_user = "
                <a href='javascript:void(0)' class='btn btn-sm btn-danger' onclick=changeStatus($dt->id)>$dt->status_user <span class='fas fa-sync'></span></a>
                ";
            }
            $dt->level_user = $dt->level_user == 'Admin' ? "<a href='javascript:void(0)' class='btn btn-sm btn-secondary'>$dt->level_user</a>" : "<a href='javascript:void(0)' class='btn btn-sm btn-info'>$dt->level_user</a>";
        }
        return response()->json($data);
    }

    public function create(Request $request)
    {
        // return $request->all();
        $data = array();
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();

        $data['edit'] = (!empty($request->id)) ? true : false;
        $data['id'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? User::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function store(Request $request)
    {
        $id = $request->id;
        if (empty($request->nama_lengkap)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Nama Lengkap Harus Diisi', null);
        }
        if (empty($request->username)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Username Harus Diisi', null);
        }
        if (empty($request->email)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Email Harus Diisi', null);
        }
        if (empty($request->no_wa)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom No. WA Harus Diisi', null);
        }
        if (empty($request->password) && empty($id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Password Harus Diisi', null);
        }
        if (empty($request->level_user)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Level User Harus Diisi', null);
        }
        $user = User::find($id);
        if (empty($user)) {
            $user = new User();
        }
        $user->nama_lengkap = $request->nama_lengkap;
        $user_cek = User::query()->where('email', $request->email)->first();
        if ($user_cek) {
            if ($user_cek->email != $user->email) {
                return ResponseJsonTrait::responseJson(500, 'error', 'Email Sudah Digunakan Orang Lain', null);
            }
        }
        $user->email = $request->email;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->level_user = $request->level_user;
        $user->no_wa = $request->no_wa;
        $user->save();

        if ($user) {
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Berhasil Meyimpan Data', null);
            } else {
                return ResponseJsonTrait::responseJson(200, 'success', 'Berhasil Mengubah Data', null);
            }
        } else {
            if (empty($id)) {
                return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Meyimpan Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Mengubah Data', null);
            }
        }
    }
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $user->delete();

            if ($user) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Berhasil Menghapus Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Menghapus Data', null);
            }
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Menghapus Data', null);
        }
    }
    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $user->status_user = $user->status_user == 'Aktif' ? 'Non-Aktif' : 'Aktif';
            $user->save();
            if ($user) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Berhasil Mengubah Status Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Mengubah Status Data', null);
            }
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Gagal Mengubah Status Data', null);
        }
    }
    public function myProfile()
    {
        $data['title'] = "My Profile";
        $data['menu'] = 'my-profile';
        $data['sub_menu'] = 'my-profile';
        $data['identitas_web'] = IdentitasWeb::query()->first();
        $data['edit'] = true;
        $data['id'] = auth()->user()->id;
        $data['data'] = auth()->user();
        $data['show'] = false;
        return view('admin.page.my-profile.main', $data);
    }
}
