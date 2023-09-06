<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rooms;
use App\Models\Image;

class testController extends Controller
{
    public function store(Request $request) {
        
        // $data =  $request->validate([
        //     'address' => 'required',
        //     'capacity' => 'required',
        //     'room_number' => 'required',
        //     'description' => 'required',
        //     'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        // ]);

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
}
