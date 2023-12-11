<?php

namespace App\Http\Controllers\Web\User;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\IdentitasWeb;
use Illuminate\Http\Request;
use App\Models\TransactionRoom;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Models\TransactionSubscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
                ->whereYear('created_at', Carbon::now()->year)
                ->where('user_id', Auth::id())
                ->value('total_interval_harian');
            $data['remaining_interval'] = 5 - $transaction_interval;
        } else {
            $data['remaining_interval'] = 5;
        }
        return view($this->direktori . '.main', $data);
    }
    public function detail(Request $request, $slug_room)
    {
        try {
            $request->validate([
                'start_date' => 'date_format:d/m/Y',
                'end_date' => 'date_format:d/m/Y'
            ]);
            $data['title'] = $this->title;
            $data['menu'] = $this->menu;
            $data['sub_menu'] = $this->sub_menu;
            $data['identitas_web'] = IdentitasWeb::query()->first();
            $data['cover_path'] = null;
            $data['location'] = $request->location;
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
            $data['room'] = Room::query()->where('slug_room', $slug_room)->with(['user'])->first();
            if (empty($data['location']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['room'])) {
                return abort(404, 'Not Found');
            }
            $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date);
            $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date);
            if ($start_date >= $end_date || empty($start_date->greaterThan(Carbon::now()))) {
                return abort(503, 'Invalid Information');
            }
            return view($this->direktori . '.detail', $data);
        } catch (\Throwable $th) {
            return abort(503, 'Invalid Information');
        }
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
    public function bookingRoom(Request $request, $slug_room)
    {
        if (empty($slug_room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Invalid Room', null);
        }
        if (empty($request->location)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Invalid Location', null);
        }
        if (empty($request->start_date)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Invalid Start Date', null);
        }
        if (empty($request->end_date)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Invalid End Date', null);
        }
        $start_date = Carbon::createFromFormat('d/m/Y', $request->start_date, 'Asia/Jakarta');
        $end_date = Carbon::createFromFormat('d/m/Y', $request->end_date, 'Asia/Jakarta');
        $start_date_format = $start_date->format('Y/m/d');
        $end_date_format = $end_date->format('Y/m/d');
        if ($start_date >= $end_date || empty($start_date->greaterThan(Carbon::now()))) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Please Enter Valid Start & End Date', null);
        }
        $room_id_exceptions = TransactionRoom::where(function ($query) use ($start_date_format, $end_date_format) {
            $query->whereBetween('start_date', [$start_date_format, $end_date_format])
                ->orWhereBetween('end_date', [$start_date_format, $end_date_format])
                ->orWhere(function ($query) use ($start_date_format, $end_date_format) {
                    $query->where('start_date', '<=', $start_date_format)
                        ->where('end_date', '>=', $end_date_format);
                });
        })->pluck('room_id');
        $room = Room::query()->whereNotIn('id_room', $room_id_exceptions)->where('slug_room', $slug_room)->first();
        if (empty($room)) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Room Full, Please Select Other Room', null);
        }
        $transaction_subscription_latest = TransactionSubscription::query()->where('user_id', Auth::id())->where('status', 'Paid')->latest()->first();
        if ($transaction_subscription_latest) {
            $date_subscription_latest = Carbon::parse($transaction_subscription_latest->date_subscription, 'UTC');
            if (Carbon::now()->diffInMonths($date_subscription_latest)) {
                return ResponseJsonTrait::responseJson(500, 'error', 'You have to pay this month\'s subscription to book a place.', null);
            }
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'You have to pay this month\'s subscription to book a place.', null);
        }
        $transaction_interval = TransactionRoom::query()
            ->selectRaw('SUM(DATEDIFF(end_date, start_date)) as total_interval_harian')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('user_id', Auth::id())
            ->value('total_interval_harian');
        $remaining_interval = 5 - $transaction_interval;
        if ($start_date->diffInDays($end_date) > $remaining_interval) {
            return ResponseJsonTrait::responseJson(500, 'error', 'Maximum annual order is 5 times. You exceeded your annual booking amount', null);
        }
        $transaction_room = new TransactionRoom();
        $transaction_room->user_id = Auth::id();
        $transaction_room->room_id = $room->id_room;
        $transaction_room->start_date = $start_date;
        $transaction_room->end_date = $end_date;
        $transaction_room->save();
        if ($transaction_room) {
            $no_receipt = 'SA-' . str_pad($transaction_room->id_transaction_room, 6, '0', STR_PAD_LEFT);
            $transaction_room->no_receipt = $no_receipt;
            $transaction_room->save();
            return ResponseJsonTrait::responseJson(200, 'success', 'Booking Success, Have a Great Time!', null);
        } else {
            return ResponseJsonTrait::responseJson(500, 'error', 'Failed Booking, Please Try Again!', null);
        }
    }
}
