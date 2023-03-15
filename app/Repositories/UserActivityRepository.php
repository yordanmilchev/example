<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class UserActivityRepository
{
    public static function hasActivityToday($userId)
    {
        $activitiesToday = \DB::table("user_activities")
            ->where('user_id', $userId)
            ->whereRaw('Date(created_at) = CURDATE()')
            ->get();

        return count($activitiesToday) > 0;
    }

    public static function getForStaffUsers($userId = null)
    {
        $qb = \DB::table("user_activities")
            ->select(['users.*', 'user_activities.*', 'user_activities.created_at as activity_datetime'])
            ->join('users', 'users.id', '=', 'user_activities.user_id')
            ->join('role_user', 'role_user.user_id' , '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereIn('roles.name', ['technical_administrator', 'administrator', 'operative_team', 'regional_manager', 'call_center', 'sales_operator', 'human_resources', 'financial_analyst', 'dispatcher'])
            ->orderBy('user_activities.created_at', 'DESC')
            ->groupBy(['user_activities.id', 'users.id']);

        if ($userId) {
            $qb->where('users.id', '=', $userId);
        }
        return $qb;
    }
}
