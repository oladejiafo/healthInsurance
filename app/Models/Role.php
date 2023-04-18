<?php

namespace App\Models;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Permission\Models\Role;

class Role extends Model
{
    use HasFactory;

    public function users()
{
    return $this->hasMany(User::class);
}
public function permissions()
{
    return $this->belongsToMany(Permission::class);
}

}
