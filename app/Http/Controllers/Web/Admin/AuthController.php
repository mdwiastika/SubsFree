<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $title = 'Form Login';
    protected $menu = 'login';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.auth';
    public function login(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        return view($this->direktori . '.login', $data);
    }
    public function postLogin(Request $request)
    {
        if (empty($request->email)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Email Harus Diisi', null);
        }
        if (empty($request->password)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Kolom Password Harus Diisi', null);
        }
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!empty($user) && $user->status == 'Non-Aktif') {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun Anda Sedang Dinonaktifkan',
            ]);
        }
        if (Auth::attempt($credentials)) {
            if (!$request->is('api/*')) {
                $request->session()->regenerate();
            }
            return ResponseJsonTrait::responseJson(200, 'success', 'Login Berhasil', $user);
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Email atau Password Salah, silahkan Coba Kembali !!', null);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->route('login')->with('title', 'Berhasil !')->with('message', 'Anda telah logout.')->with('icon', 'success');
    }
}
