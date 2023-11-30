<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Room;
use Illuminate\Support\Str;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    protected $title = 'Room';
    protected $menu = 'room';
    protected $sub_menu = '';
    protected $direktori = 'admin.page.room';
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
        $data = Room::getData($request);
        foreach ($data['rows'] as $key => $dt) {
            $dt->photo_room = $dt->photo_room ? "<img src='" . asset('' . $dt->photo_room) . "' alt='' class='img-show'>" : 'Tidak Ada';
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
        $data['id_room'] = (!empty($request->id)) ? $request->id : "";
        $data['data'] = (!empty($request->id)) ? Room::find($request->id) : "";
        $data['show'] = (!empty($request->show)) ? true : false;
        $content = view($this->direktori . '.add', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }

    public function store(Request $request)
    {
        $id = $request->id_room;
        if (empty($request->category_room_id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Category Room Field Must Be Filled', null);
        }
        if (empty($request->user_id)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'User Name Field Must Be Filled', null);
        }
        if (empty($request->name_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Name Room Field Must Be Filled', null);
        }
        if (empty($request->level_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Level Room Field Must Be Filled', null);
        }
        $room = Room::find($id);
        if (empty($room)) {
            $room = new Room();
        }
        if (empty($request->file('photo_room')) && empty($request->old_photo_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Photo Room Field Must Be Filled', null);
        }
        if (empty($request->location_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Location Room Field Must Be Filled', null);
        }
        if (empty($request->description_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Description Room Field Must Be Filled', null);
        }
        $destination_path = public_path('/image-upload/room');
        if ($request->hasFile('photo_room')) {
            if ($request->old_photo_room) {
                foreach (unserialize(base64_decode($request->old_photo_room)) as $key => $single_image) {
                    $path = $single_image;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            foreach ($request->file('photo_room') as $key => $single_image) {
                $image = $single_image;
                $input['file'] = Str::random(4) . time() . hash('sha256', $single_image->getContent()) . '.' . $image->getClientOriginalExtension();
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination_path . '/' . $input['file']);
                $data_photo_room[] = 'image-upload/room/' . $input['file'];
            }
            $room->photo_room = base64_encode(serialize($data_photo_room));
        }
        $room->category_room_id = $request->category_room_id;
        $room->user_id = $request->user_id;
        $room->name_room = $request->name_room;
        $room->slug_room = null;
        $room->location_room = $request->location_room;
        $room->description_room = $request->description_room;
        $room->level_room = $request->level_room;
        $room->save();

        if ($room) {
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
        $room = Room::find($request->id);
        if (!empty($room)) {
            if ($room->photo_room) {
                if (file_exists($room->photo_room)) {
                    unlink($room->photo_room);
                }
            }
            $room->delete();
            if ($room) {
                return ['status' => 'success', 'code' => 200, 'message' => 'Berhasil Menghapus Data'];
            } else {
                return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
            }
        } else {
            return ['status' => 'error', 'code' => 500, 'message' => 'Gagal Menghapus Data'];
        }
    }
}
