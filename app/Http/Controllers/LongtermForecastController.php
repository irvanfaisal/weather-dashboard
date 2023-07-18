<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LongtermForecast;
use \Carbon\Carbon;

class LongtermForecastController extends Controller
{
    public function list(Request $request)
    {
        $dataMonthly = [];
        $data = LongtermForecast::where("station_id",$request->id)->where("date",">=",Carbon::today()->format("Y-m-01"))->orderBy('date')->get();
        
        foreach($data as $key => $val){
            $data[$key]["img"] = "img/" . ($val->rain > 0 ? "day-rain" : "day-clear") . ".png";
            $data[$key]["weather"] = ($val->rain <= 0 ? "Clear" : ($val->rain <= 20 ? "Light Rain" : ($val->rain <= 50 ? "Moderate Rain" : ($val->rain <= 100 ? "Heavy Rain" : "Extreme Rain"))));
        }
        for ($i=0; $i < 6; $i++) {
            $dateMonthly = Carbon::today()->addMonths($i);
            $monthly = $data->filter(function($item) use($dateMonthly) {
                if ($dateMonthly->format("Y-m") == Carbon::parse($item->date)->format("Y-m")) {
                    return $item;
                }
            });
            $tmp = [
                "date" => $dateMonthly->format("M Y"),
                "datestring" => $dateMonthly->format("Y-m-d"),
                "rain" => $monthly->sum("rain"),
                "weather" => ($monthly->sum("rain") <= 0 ? "Clear" : ($monthly->sum("rain") <= 20 ? "Light Rain" : ($monthly->sum("rain") <= 50 ? "Moderate Rain" : ($monthly->sum("rain") <= 100 ? "Heavy Rain" : "Extreme Rain")))),
                "img" => "img/" . ($monthly->sum("rain") > 0 ? "day-rain" : "day-clear") . "-white.png"
            ];
            $dataMonthly[] = $tmp;
        }
        return response()->json([
            'data' => $data,
            'data_monthly' => $dataMonthly
        ]);
    }
}
