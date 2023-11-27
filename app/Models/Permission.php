<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $guarded = [];

    public function roles()
    {

        return $this->belongsToMany(Role::class);
    }

    public function users()
    {

        return $this->belongsToMany(User::class);
    }
}
