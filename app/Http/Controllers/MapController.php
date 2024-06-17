<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        return view('home.mapcontrol.map');
    }

    public function getLocations()
    {
        $locations = [
            ['lat' => -6.897645, 'lng' => 107.634078, 'popup' => 'ITB'],
            ['lat' => -7.770717, 'lng' => 110.377724, 'popup' => 'UGM'],
            ['lat' => -6.267647, 'lng' => 106.798296, 'popup' => 'UI'],
            ['lat' => -6.888701, 'lng' => 109.668289, 'popup' => 'UIN'],
            ['lat' => -5.132193, 'lng' => 119.488449, 'popup' => 'UNHAS'],
        ];

        return response()->json($locations);
    }
}
