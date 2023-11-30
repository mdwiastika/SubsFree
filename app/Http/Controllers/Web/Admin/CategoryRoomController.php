<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Support\Str;
use App\Models\CategoryRoom;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryRoomController extends Controller
{
    protected $title = 'Category Room';
    protected $menu = 'category-room';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.category-room';
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
        $data = CategoryRoom::getData($request);
        foreach ($data['rows'] as $key => $dt) {
            $dt->icon_category_room = $dt->icon_category_room ? "<img src='" . asset('' . $dt->icon_category_room) . "' alt='' class='img-show'>" : 'Tidak Ada';
        }
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data = array();
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['identitas_web'] = Auth::user()->level_user == 'Pengguna' ? IdentitasWeb::query()->where('web_preferences_id', $data['web_preferences_id'])->first() : IdentitasWeb::query()->first();

        $data['edit'] = (!empty($request->id)) ? true : false;
        $data['id_category_room'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? CategoryRoom::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function store(Request $request)
    {
        $id = $request->id_category_room;
        if (empty($request->name_category_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Name Category Room Field Must Be Filled', null);
        }
        $category_room = CategoryRoom::find($id);
        if (empty($category_room)) {
            $category_room = new CategoryRoom();
        }
        if (empty($request->file('icon_category_room')) && empty($request->old_icon_category_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Icon Category Room Field Must Be Filled', null);
        }
        if ($request->has('icon_category_room')) {
            if ($request->old_icon_category_room) {
                if (file_exists($request->old_icon_category_room)) {
                    unlink($request->old_icon_category_room);
                }
            }
            $image = $request->file('icon_category_room');
            $thumb_image = Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_path = 'image-upload/category-room/' . Str::random(4) . hash('sha256', $image->getContent()) . '.' . $image->getClientOriginalExtension();
            $thumb_path = public_path() . '/' . $image_path;
            $thumb_image = Image::make($thumb_image)->save($thumb_path);
            $category_room->icon_category_room = $image_path;
        }
        $category_room->name_category_room = $request->name_category_room;
        $category_room->slug_category_room = null;
        $category_room->save();

        if ($category_room) {
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
        $category_room = CategoryRoom::find($request->id);
        if (!empty($category_room)) {
            if ($category_room->icon_category_room) {
                if (file_exists($category_room->icon_category_room)) {
                    unlink($category_room->icon_category_room);
                }
            }
            $category_room->delete();
            if ($category_room) {
                return ['status' => 'success', 'code' => 200, 'message' => 'Berhasil Menghapus Data'];
            } else {
                return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
            }
        } else {
            return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }
}
