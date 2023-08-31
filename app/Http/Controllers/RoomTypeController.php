<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RoomTypes;

class RoomTypeController extends Controller
{

    public function getRoomTypes() {
        $data = RoomTypes::all();
        return response()->json($data, 200);
    }

    public function addRoomTypes(Request $request) {
        $data =  $request->validate([
            'name' => 'required',
        ]);

        if (RoomTypes::where('name', $data['name'])->exists()) {
            return response()->json(['message' => 'Name already exists'], 400);
        }

        $roomType = new RoomTypes();
        $roomType->name = $data['name'];
        $roomType->save();

        return response()->json(['message' => 'add room type success', 'data' => $roomType], 200);
    }

    public function getEditRoomTypes($id) {
        $data = RoomTypes::select('*')->where('id', $id)->first();
        return response()->json(['data' => $data], 200);
    }

    public function postEditRoomTypes(Request $request, $id) {
        $roomType = new RoomTypes();
        $arr['name'] = $request->name;
        
        $roomType::where('id', $id)->update($arr);
        return response()->json(['message' => 'edit room type success'], 200);
    }

    public function deleteRoomTypes($id) {
        RoomTypes::where('id', $id)->delete();
        return response()->json(['message' => 'delete room type success'], 200);
    }
}
