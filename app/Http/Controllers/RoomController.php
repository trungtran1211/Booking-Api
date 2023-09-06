<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Places;
use App\Models\RoomTypes;
use App\Models\Rooms;
use App\Models\Image;


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

        if(Rooms::where('room_number', $request->room_number)->exists()){
            return response()->json(['message' => 'add room error'], 401);
        }
        
        $uploadedImage = $request->file("cover_image");
        $imageName = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('images', $imageName, 'public');
        $uploadedImage->move(public_path('/images'), $imagePath);
        $rooms = new Rooms();
        $rooms->place_id = $request->place_id;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->address = $request->address;
        $rooms->capacity = $request->capacity;
        $rooms->room_number = $request->room_number;
        $rooms->description = $request->description;
        $rooms->cover_image = $imagePath;
        $rooms-> save();
        $roomId = $rooms->id;

        if($request->hasFile("images")){
            $files = $request->file("images");
            foreach($files as $file){
                $imagesName1=time().'_'.$file->getClientOriginalName();
                $upload = $file->storeAs('images', $imagesName1);
                $file->move(public_path("/images"),$upload);
                $image = new Image();
                $image->room_id = $roomId; 
                $image->path = $upload;
                $image->save();
            }
        }
        return response()->json(['message' => 'add room success', 'data' => $rooms], 200);
    }

    public function deleteRooms($id) {
        Rooms::where('id', $id)->delete();
        return response()->json(['message' => 'delete room success'], 200);
    }

}
