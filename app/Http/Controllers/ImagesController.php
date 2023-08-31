<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImagesController extends Controller
{
    public function addImageToRoom($roomId, Request $request) {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imageName = time() . '_' . $imageFile->getClientOriginalName();
                $imagePath = $imageFile->storeAs('images', $imageName, 'public');
                
                $image = new Image();
                $image->room_id = $roomId;
                $image->path = $imagePath;
                $image->save();
            }
        }
    }
}
