<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('station_id')->unsigned();
            $table->foreign('station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->datetime('date');
            $table->string('forecast_date');
            $table->float('rain')->nullable();
            $table->float('temperature')->nullable();
            $table->float('wind_speed')->nullable();
            $table->float('wind_direction')->nullable();
            $table->float('humidity')->nullable();
            $table->float('pressure')->nullable();
            $table->float('probability')->nullable();             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forecasts');
    }
};
