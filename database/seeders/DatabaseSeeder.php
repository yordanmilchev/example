<?php

namespace Database\Seeders;

use App\Models\ACL\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.bg',
            'password' => Hash::make('12345678'),
            'created_at' => \Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Second',
            'lastname' => 'User',
            'email' => 'suser@abv.bg',
            'phone_number' => '0889898989898',
            'password' => Hash::make('12345678'),
            'created_at' => \Carbon\Carbon::now()
        ]);

        $permissions = Permission::all();
        foreach ($permissions as $permission){
            DB::table('permission_role')->insert([
                'permission_id' => $permission->id,
                'role_id' => '1'
            ]);
        }

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1'
        ]);
    }
}
