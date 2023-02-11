<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'miles',
        'total',
        'car_id',
    ];

    public static function setTotalMiles(Car $car, float $miles): float
    {
        return $car->trip_miles + $miles;
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
