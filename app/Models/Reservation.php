<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'user_id',
        'table_ids',
        'datetime',
        'pax',
        'status'
    ];

    protected $attributes = [
        'pax' => 1,
        'status' => 'pending'
    ];

    protected $casts = [
        'table_ids' => 'array',
        'datetime' => 'datetime'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
