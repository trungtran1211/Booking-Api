<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\RoomTypes;
use App\Models\Rooms;
use App\Http\Controllers\ImagesController;

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

    public function postAddRooms(Request $request, ImagesController $imagesController) {
        $data =  $request->validate([
            'address' => 'required',
            'capacity' => 'required',
            'room_number' => 'required',
            'description' => 'required',
        ]);
        if(Rooms::where('room_number', $data['room_number'])->exists()){
            return response()->json(['message' => 'add room error'], 401);
        }

        $rooms = new Rooms();
        $rooms->place_id = $request->place_id;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->address = $data['address'];
        $rooms->capacity = $data['capacity'];
        $rooms->room_number = $data['room_number'];
        $rooms->description = $data['description'];
        $rooms-> save();
        $roomId = $rooms->id;

        $imagesController->addImageToRoom($roomId, $request);
        return response()->json(['message' => 'add room success', 'data' => $rooms], 200);
    }

    public function deleteRooms($id) {
        Rooms::where('id', $id)->delete();
        return response()->json(['message' => 'delete room success'], 200);
    }

}
