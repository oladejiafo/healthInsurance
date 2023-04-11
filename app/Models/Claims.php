<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'hcp_name',
        'enrollee_name',
        'created_at',
        'updated_at',
    ];
}
