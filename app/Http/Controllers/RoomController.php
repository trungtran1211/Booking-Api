<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\RoomTypes;
use App\Models\Rooms;
use App\Models\Image;
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

    public function postAddRooms(Request $request) {
        $data =  $request->validate([
            'address' => 'required',
            'capacity' => 'required',
            'room_number' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if(Rooms::where('room_number', $data['room_number'])->exists()){
            return response()->json(['message' => 'add room error'], 401);
        }

        $uploadedImage = $request->file('cover_image');
        $imageName = time() . '_' . $uploadedImage->getClientOriginalName();
        $imagePath = $uploadedImage->storeAs('images', $imageName, 'public');

        $rooms = new Rooms();
        $rooms->place_id = $request->place_id;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->address = $data['address'];
        $rooms->capacity = $data['capacity'];
        $rooms->room_number = $data['room_number'];
        $rooms->description = $data['description'];
        $rooms->cover_image = $imagePath;
        $rooms-> save();
        $roomId = $rooms->id;
        

        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        }
        dd($images);
        $image = new Image();
        $image->room_id = $roomId;
        $image->path = implode("|",$images);
        $image->save();
        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $imageFile) {
        //         $imageNametess = time() . '_' . $imageFile->getClientOriginalName();
        //         $imagePath = $imageFile->storeAs('images', $imageNametess, 'public');
                
        //         $image = new Image();
        //         $image->room_id = $roomId;
        //         $image->path = $imagePath;
        //         $image->save();
        //     }
        // }
        // $imagesController->addImageToRoom($roomId, $request);
        return response()->json(['message' => 'add room success', 'data' => $rooms], 200);
    }

    public function deleteRooms($id) {
        Rooms::where('id', $id)->delete();
        return response()->json(['message' => 'delete room success'], 200);
    }

}
