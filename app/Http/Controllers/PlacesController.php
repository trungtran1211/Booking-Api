<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Places;

class PlacesController extends Controller
{
    public function getPlaces() {
        $data = Places::all();
        return response()->json(compact('data'), 200);
    }

    public function addPlaces(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if (Places::where('name', $data['name'])->exists()) {
            return response()->json(['message' => 'Name already exists'], 400);
        }

        $places = new Places();
        $places->name = $data['name'];
        $places->description = $data['description'];
        $places->save();
        return response()->json(['message' => 'Places has been added successfully', 'data' => $data], 200);
    }

    public function getEditPlaces($id) {
        $data = Places::select('*')->where('id', $id)->first();
        return response()->json(['data' => $data], 200);
    }

    public function postEditPlaces(Request $request, $id) {
        
        $places = new Places();
        $arr['name'] = $request->name;
        $arr['description'] = $request->description;

        $places::where('id', $id)->update($arr);
        return response()->json(['message' => 'edit places success'], 200);
    }

    public function deletePlaces($id) {
        Places::where('id', $id)->delete();
        return response()->json(['message' => 'delete places success'], 200);
    }
}
