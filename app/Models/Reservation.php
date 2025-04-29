<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'trajet_id',
        'full_name',
        'email',
        'phone_number',
        'amount_paid',
        'payment_id',
        'status',
        'transaction_reference'
    ];

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }
}