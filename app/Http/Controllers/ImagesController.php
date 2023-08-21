<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImagesController extends Controller
{
    public function addImageToRoom($roomId, Request $request) {
        $images = new Image();
        $images->room_id = $roomId;
        $images->path = $request->path;
        $images->save();
    }
}
