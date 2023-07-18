<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Station;
use \Carbon\Carbon;
use DB;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $stations = Station::all();
        foreach ($stations as $station){
            $date = Carbon::now();
            for ($i=0; $i < 240; $i++) { 
                DB::table('forecasts')->insert([
                    'station_id' => $station->id,
                    'date' => $date->addHours(1)->format("Y-m-d H:00"),
                    'forecast_date' => "20230715_12",
                    'rain' => $faker->numberBetween(0, 20),
                    'temperature' => $faker->numberBetween(21, 32),
                    'wind_speed' => $faker->numberBetween(0, 12),
                    'wind_direction' => $faker->numberBetween(0, 359),
                    'humidity' => $faker->numberBetween(60, 100),
                    'pressure' => $faker->numberBetween(990, 1010),
                    'probability' => $faker->numberBetween(10, 100),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
