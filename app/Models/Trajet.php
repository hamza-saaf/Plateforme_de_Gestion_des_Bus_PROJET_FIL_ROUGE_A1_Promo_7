<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'depart',
        'destination',
        'date',
        'price',
        'available_seats'
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2'
    ];
}
