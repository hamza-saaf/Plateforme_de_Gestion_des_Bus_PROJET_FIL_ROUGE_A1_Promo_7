<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'name',
        'status',
        'capacity'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}