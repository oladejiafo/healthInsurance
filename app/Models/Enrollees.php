<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollees extends Model
{
    use HasFactory;

    public function hcp()
    {
        return $this->belongsTo(Providers::class);
    }

    public function enrollees()
{
    return $this->hasMany(Enrollees::class);
}
}
