<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Providers;
use App\Models\Enrollees;

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

    public function provider()
    {
        return $this->belongsTo(Providers::class, 'hcp_id');
    }
    public function enrollee()
    {
        return $this->belongsTo(Enrollees::class, 'enrollee_id');
    }
}
