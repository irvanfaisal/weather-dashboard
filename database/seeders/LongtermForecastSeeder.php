<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Station;
use \Carbon\Carbon;
use DB;

class LongtermForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $stations = Station::all();
        foreach ($stations as $station){
            $date = Carbon::today();
            for ($i=0; $i < 240; $i++) { 
                DB::table('longterm_forecasts')->insert([
                    'station_id' => $station->id,
                    'date' => $date->addDays(1)->format("Y-m-d"),
                    'rain' => $faker->numberBetween(0, 20),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
    }
}
