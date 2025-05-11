<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trajet_id',
        'bus_id',
        'full_name',
        'email',
        'phone_number',
        'amount_paid',
        'payment_id',
        'status',
        'transaction_reference',
        'reservation_date'
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'amount_paid' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}