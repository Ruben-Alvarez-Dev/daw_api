<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'name',
        'business_name',
        'tax_id',
        'adress',
        'phone',
        'photo_path',
        'status'
    ];
    //
}
