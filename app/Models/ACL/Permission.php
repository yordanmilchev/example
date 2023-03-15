<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;
use App\Models\ACL\Role;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class); //returns all roles associated with given permission id
    }
}
