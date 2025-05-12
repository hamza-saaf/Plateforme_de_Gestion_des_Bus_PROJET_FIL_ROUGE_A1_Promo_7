<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'ville_depart',
        'ville_arrivee',
        'heure_depart',
        'heure_arrivee',
        'prix'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}