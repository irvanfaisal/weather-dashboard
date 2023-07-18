<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observation;

class ObservationController extends Controller
{
    public function list(Request $request)
    {
        $date_start = $request->date_start;
        if (!$date_start) {
            $date_start = \Carbon\Carbon::today()->addDays(-2);
        }

        $date_end = $request->date_end;
        if (!$date_end) {
            $date_end = \Carbon\Carbon::today();
        }

        $data = Observation::where("station_id",$request->id)->where("date",">=",$date_start)->where("date","<",$date_end)->orderBy("date")->get();
        return response()->json([
            'data' => $data,
            'date_end' => $date_end
        ]);
    }
    
    public function latest(Request $request)
    {
        $data = Observation::where("station_id",$request->id)->orderBy("date","desc")->first();
        return response()->json([
            'data' => $data
        ]);
    }
}
