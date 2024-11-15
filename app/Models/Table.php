<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'name',
        'capacity',
        'status',
        'zone'
    ];

    protected $attributes = [
        'status' => 'active',
        'zone' => 'main',
        'capacity' => 1
    ];
}
