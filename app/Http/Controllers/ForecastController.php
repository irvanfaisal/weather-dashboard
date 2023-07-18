<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forecast;
use \Carbon\Carbon;

class ForecastController extends Controller
{
    public function list(Request $request)
    {
        $date_start = $request->date_start;
        if (!$date_start) {
            $date_start = \Carbon\Carbon::now();
        }

        $date_end = $request->date_end;
        if (!$date_end) {
            $date_end = \Carbon\Carbon::now()->addDays(10);
        }

        $dataDaily = [];
        $tmp = Forecast::where("station_id",$request->id)->where("date",">=",$date_start)->where("date","<=",$date_end)->orderBy('date')->orderBy('forecast_date','desc')->get()->groupBy('date');
        $data = [];
        foreach ($tmp as $key => $value) {
            $data[] = $value[0];
        }
        $data = collect($data);
        foreach($data as $key => $val){
            $data[$key]["img"] = "img/" . ($val->rain > 0 ? "day-rain" : "day-clear") . ".png";
            $data[$key]["weather"] = ($val->rain <= 0 ? "Clear" : ($val->rain <= 5 ? "Light Rain" : ($val->rain <= 10 ? "Moderate Rain" : ($val->rain <= 20 ? "Heavy Rain" : "Extreme Rain"))));
        }
        for ($i=0; $i < 8; $i++) {
            $dateDaily = Carbon::today()->addDays($i);
            $daily = $data->filter(function($item) use($dateDaily) {
                if ($dateDaily->format("Y-m-d") == Carbon::parse($item->date)->format("Y-m-d")) {
                    return $item;
                }
            });
            $tmp = [
                "date" => $dateDaily->format("d F"),
                "datestring" => $dateDaily->format("Y-m-d"),
                "temperature" => $daily->average("temperature"),
                "temperature_max" => $daily->max("temperature"),
                "temperature_min" => $daily->min("temperature"),
                "rain" => $daily->sum("rain"),
                "humidity" => $daily->average("humidity"),
                "humidity_max" => $daily->max("humidity"),
                "humidity_min" => $daily->min("humidity"),
                "wind_speed" => $daily->average("wind_speed"),
                "wind_speed_max" => $daily->max("wind_speed"),
                "wind_speed_min" => $daily->min("wind_speed"),
                "probability" => $daily->max("probability"),
                "weather" => ($daily->sum("rain") <= 0 ? "Clear" : ($daily->sum("rain") <= 20 ? "Light Rain" : ($daily->sum("rain") <= 50 ? "Moderate Rain" : ($daily->sum("rain") <= 100 ? "Heavy Rain" : "Extreme Rain")))),
                "img" => "img/" . ($daily->sum("rain") > 0 ? "day-rain" : "day-clear") . "-white.png"
            ];
            $dataDaily[] = $tmp;
        }
        foreach($data as $key => $val){
            $data[$key]["date"] = Carbon::parse($val->date)->format("d F Y H:i");
        };
        return response()->json([
            'data' => $data,
            'data_daily' => $dataDaily
        ]);
    }
}
