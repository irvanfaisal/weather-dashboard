<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;

class StationController extends Controller
{
    public function list(Request $request)
    {
        $data = Station::All();
        return response()->json([
            'data' => $data
        ]);
    }

    public function nearest(Request $request)
    {
        $data = Station::first();
        return response()->json([
            'data' => $data
        ]);
    }
}