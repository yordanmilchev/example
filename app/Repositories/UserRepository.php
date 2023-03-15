<?php

namespace App\Repositories;
use App\Constant\RolesConstant;
use App\Models\ACL\Role;
use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * getUserList
     *
     * @param array $query
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getUserList(array $query): \Illuminate\Pagination\LengthAwarePaginator
    {
        $usersQuery = DB::table('users')
            ->select('users.id as id',
                'users.name as name',
                'users.lastname as lastname',
                'users.phone_number as phone_number',
                'users.email as email',
                'users.created_at as created_at',
            );

        if (!empty($query)) {
            if (!empty($query['email'])) {
                $usersQuery->where('users.email', $query['email']);
            }
            if (!empty($query['name'])) {
                $usersQuery->where('users.name', 'like', '%' . $query['name'] . '%');
            }
            if (!empty($query['lastname'])) {
                $usersQuery->where('users.lastname', 'like', '%' . $query['lastname'] . '%');
            }
            if (!empty($query['user_id'])) {
                $usersQuery->where('users.id', $query['user_id']);
            }
            if (!empty($query['phone_number'])) {
                $usersQuery->where('users.phone_number', 'like', '%' . $query['phone_number'] . '%');
            }
            if (!empty($query['role_id'])) {
                $usersQuery->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', $query['role_id']);
            }
        }

        $users = $usersQuery->orderBy('users.id', 'desc')->paginate(30);

        return $users;
    }

    /**
     * @param $roleConstant
     * @return \Illuminate\Support\Collection
     */
    public static function getUsersWithRole($roleConstant){
        $role = Role::where('name', '=', $roleConstant)->first();
        $usersQuery = DB::table('users')
            ->select('users.id as id',
                'users.name as username',
                'users.email as email'
            )
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', $role->id);

        return $usersQuery->get();
    }

}
