<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
   use HasFactory;

   protected $table = 'units';

   protected $fillable = [
        'business_name',
        'tax_id',
        'name',
        'adress',
        'phone',
        'photo_path',
        'status',
        'zones'
   ];

   protected $attributes = [
        'status' => 'active',
        'zones' => '["main"]'   
    ];

   protected $casts = [
       'zones' => 'array'
   ];
}