<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'bus_id'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}