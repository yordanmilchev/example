<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    /**
     * permissions
     * @return relationship object
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * givePermissionTo
     * @param App\Permission $permission
     * @return void
     *
     * @example
     * $permission = Permission::find(3);
     * $role = Role::find(3);
     * $role->givePermissionTo($permission);
     */
    public function givePermissionTo(Permission $permission)
    {
        //check if permission is already given
        if ($this->permissions()->where('permission_id', $permission->id)->where('role_id', $this->id)->exists() === false) {
            $this->permissions()->save($permission); //(SQL: insert into `permission_role` (`permission_id`, `role_id`) values (1, 2))
        }
    }

    /**
     * revokePermissionTo
     * @param  App\Permission $permission
     * @return void
     *
     * @example
     * $permission = Permission::find(3);
     * $role = Role::find(3);
     * $role->revokePermissionTo($permission);
     */
    public function revokePermissionTo(Permission $permission)
    {
        $this->permissions()->detach();
    }
}
