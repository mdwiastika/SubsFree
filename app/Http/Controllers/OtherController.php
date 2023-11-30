<?php

namespace App\Http\Controllers;

use App\Models\CategoryRoom;
use App\Models\User;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function cariUser(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = User::where('name', 'like', "%$search%")->get();
        }
        return response()->json($data);
    }
    public function cariCategoryRoom(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = CategoryRoom::where('name_category_room', 'like', "%$search%")->get();
        }
        return response()->json($data);
    }
}
