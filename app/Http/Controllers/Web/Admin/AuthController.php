<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    protected $title = 'Form Login';
    protected $menu = 'login';
    protected $sub_menu = '';
    protected $direktori = 'user.page.auth';
    public function login(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        return view($this->direktori . '.login', $data);
    }
    public function register(Request $request)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = IdentitasWeb::query()->first();
        return view($this->direktori . '.register', $data);
    }
    public function postRegister(Request $request)
    {
        if (empty($request->name)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Full Name Field Must Be Filled', null);
        }
        if (empty($request->email)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Email Field Must Be Filled', null);
        }
        if (empty($request->no_wa)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'No. WA Field Must Be Filled', null);
        }
        if (empty($request->level_user)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Level User Field Must Be Filled', null);
        }
        if (empty($request->password) && empty($id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Password Field Must Be Filled', null);
        }
        $user = new User();
        if ($request->has('proof_authenticity')) {
            if ($request->old_proof_authenticity) {
                if (file_exists($request->old_proof_authenticity)) {
                    unlink($request->old_proof_authenticity);
                }
            }
            $image = $request->file('proof_authenticity');
            $thumb_image = Image::make($image->getRealPath())->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_path = 'image-upload/proof-authenticity/' . Str::random(4) . hash('sha256', $image->getContent()) . '.' . $image->getClientOriginalExtension();
            $thumb_path = public_path() . '/' . $image_path;
            $thumb_image = Image::make($thumb_image)->save($thumb_path);
            $user->proof_authenticity = $image_path;
        }
        $user->name = $request->name;
        $user_cek = User::query()->where('email', $request->email)->first();
        if ($user_cek) {
            if ($user_cek->email != $user->email) {
                return ResponseJsonTrait::responseJson(500, 'error', 'Email Already Used by Someone Else', null);
            }
        }
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->level_user = $request->level_user;
        $user->no_wa = $request->no_wa;
        if ($user->level_user == 'Partner') {
            $user->level_subscription = 'Class 3';
            $user->status_user = 'Non-Active';
        } else {
            $user->level_subscription = $request->level_subscription;
            $user->status_user = 'Active';
        }
        $user->save();

        if ($user) {
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
    public function postLogin(Request $request)
    {
        if (empty($request->email)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Email Field Must Be Filled', null);
        }
        if (empty($request->password)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Password Field Must Be Filled', null);
        }
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!empty($user) && $user->status_user == 'Non-Active') {
            return response()->json([
                'status' => 'error',
                'message' => 'Your Account is Currently Deactivated',
            ]);
        }
        if (Auth::attempt($credentials)) {
            if (!$request->is('api/*')) {
                $request->session()->regenerate();
            }
            return ResponseJsonTrait::responseJson(200, 'success', 'Success Login', $user);
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Incorrect Email or Password, Please Try Again !!', null);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->route('login')->with('title', 'Berhasil !')->with('message', 'Logout Success.')->with('icon', 'success');
    }
}
