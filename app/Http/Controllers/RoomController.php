<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\RoomTypes;

class RoomController extends Controller
{
    public function getAddRooms() {

        $places = Places::all();
        $roomTypes = RoomTypes::all();

        return response()->json(compact('places', 'roomTypes'), 200);
    }
}
