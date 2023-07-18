<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;

    public function forecasts(): HasMany
    {
        return $this->hasMany(Forecast::class);
    }

    public function observations(): HasMany
    {
        return $this->hasMany(Observation::class);
    }    
}
