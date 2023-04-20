<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 
        'category', 
        'name', 
        'sub_category', 
        'price', 
        'provider', 
        

    ];
}
