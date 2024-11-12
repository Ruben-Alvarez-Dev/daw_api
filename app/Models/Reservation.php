<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    private $fillable = [
        'id',
        'user_id',
        'table_id',
        'datetime',
        'pax',
        'status'
    ];

    //
}
