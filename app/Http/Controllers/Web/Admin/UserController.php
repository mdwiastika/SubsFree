<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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
            if ($dt->status_user == 'Active') {
                $dt->status_user = "
                <a href='javascript:void(0)' class='btn btn-sm btn-success' onclick=changeStatus($dt->id)>$dt->status_user <span class='fas fa-sync'></span></a>
                ";
            } else {
                $dt->status_user = "
                <a href='javascript:void(0)' class='btn btn-sm btn-danger' onclick=changeStatus($dt->id)>$dt->status_user <span class='fas fa-sync'></span></a>
                ";
            }
            if ($dt->level_user == 'Admin') {
                $dt->level_user = "<a href='javascript:void(0)' class='btn btn-sm btn-secondary'>$dt->level_user</a>";
            } elseif ($dt->level_user == 'Partner') {
                $dt->level_user = "<a href='javascript:void(0)' class='btn btn-sm btn-warning'>$dt->level_user</a>";
            } else {
                $dt->level_user = "<a href='javascript:void(0)' class='btn btn-sm btn-info'>$dt->level_user</a>";
            }
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
        $data['id'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? User::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function store(Request $request)
    {
        $id = $request->id;
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
        if (empty($request->level_subscription)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Level Subscription Field Must Be Filled', null);
        }
        if (empty($request->status_user)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Status User Field Must Be Filled', null);
        }
        if (empty($request->password) && empty($id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Password Field Must Be Filled', null);
        }
        $user = User::find($id);
        if (empty($user)) {
            $user = new User();
        }
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
        $user->status_user = $request->status_user;
        $user->level_subscription = $request->level_subscription;
        $user->no_wa = $request->no_wa;
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
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $user->delete();

            if ($user) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Successfully Delete Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Delete Data', null);
            }
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Failed Delete Data', null);
        }
    }
    public function changeStatus(Request $request)
    {
        $user = User::find($request->id);
        if (!empty($user)) {
            $user->status_user = $user->status_user == 'Active' ? 'Non-Active' : 'Active';
            $user->save();
            if ($user) {
                return ResponseJsonTrait::responseJson(200, 'success', 'Succes Update Status Data', null);
            } else {
                return ResponseJsonTrait::responseJson(500, 'error', 'Failed Update Status Data', null);
            }
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Failed Update Status Data', null);
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
