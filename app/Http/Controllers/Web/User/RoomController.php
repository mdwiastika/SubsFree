<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\IdentitasWeb;
use App\Models\Room;
use App\Models\TransactionRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $transaction_interval = TransactionRoom::query()
                ->selectRaw('SUM(DATEDIFF(end_date, start_date)) as total_interval_harian')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->where('user_id', Auth::id())
                ->value('total_interval_harian');
            $data['remaining_interval'] = 10 - $transaction_interval;
        } else {
            $data['remaining_interval'] = 10;
        }
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
    public function getRooms(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'date_format:d/m/Y',
            'end_date' => 'date_format:d/m/Y'
        ]);
        $level_rooms = [];
        if (Auth::check()) {
            if (Auth::user()->level_subscription == 'Class 1') {
                $level_rooms = ['Class 1', 'Class 2', 'Class 3'];
            } elseif (Auth::user()->level_subscription == 'Class 2') {
                $level_rooms = ['Class 2', 'Class 3'];
            } else {
                $level_rooms = ['Class 3'];
            }
        } else {
            $level_rooms = ['Class 1', 'Class 2', 'Class 3'];
        }
        $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date, 'Asia/Jakarta')->format('Y/m/d');
        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date, 'Asia/Jakarta')->format('Y/m/d');
        $room_id_exceptions = TransactionRoom::where(function ($query) use ($start_date, $end_date) {
            $query->whereBetween('start_date', [$start_date, $end_date])
                ->orWhereBetween('end_date', [$start_date, $end_date])
                ->orWhere(function ($query) use ($start_date, $end_date) {
                    $query->where('start_date', '<=', $start_date)
                        ->where('end_date', '>=', $end_date);
                });
        })->pluck('room_id');
        $data['rooms'] = Room::query()->whereIn('level_room', $level_rooms)->whereNotIn('id_room', $room_id_exceptions)->where('location_room', 'LIKE', "%$request->location%")->with(['category_room'])->latest()->paginate(6);
        $content = view('user.page.room.get-main', $data)->render();
        return ['status' => 'success', 'content' => $content];
    }
}
