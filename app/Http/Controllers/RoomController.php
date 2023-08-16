<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\RoomTypes;
use App\Models\Rooms;

class RoomController extends Controller
{
    public function getRooms() {
        $data = Rooms::all();
        return response()->json(compact('data'), 200);
    }

    public function getAddRooms() {
        $places = Places::all();
        $roomTypes = RoomTypes::all();
        return response()->json(compact('places', 'roomTypes'), 200);
    }

    public function postAddRooms(Request $request) {
        $data =  $request->validate([
            'address' => 'required',
            'capacity' => 'required',
        ]);

        $rooms = new Rooms();
        $rooms->place_id = $request->place_id;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->address = $data['address'];
        $rooms->capacity = $data['capacity'];
        $rooms-> save();

        return response()->json(['message' => 'add room type success', 'data' => $rooms], 200);
    }
}
