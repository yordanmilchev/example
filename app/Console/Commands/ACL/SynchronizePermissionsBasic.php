<?php

namespace App\Console\Commands\ACL;

use App\Constant\Permission\PermissionBasicConstant;
use App\Models\ACL\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SynchronizePermissionsBasic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize-basic-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes basic permissions.';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('Permissions synchronization started.');

        $presentPermission = Permission::all();
        $alreadyCreatedPermissions = $presentPermission->keyBy('name');
        // array holding permissions that will be removed after match with the new ones
        // after iteration only those that need to be removed will be left in it
        $permissionsLookup = $presentPermission->keyBy('name');

        $permissions = PermissionBasicConstant::PERMISSION_DESCRIPTIONS;
        foreach ($permissions as $permissionName => $permissionDescription) {
            if (isset($alreadyCreatedPermissions[$permissionName])) {
                $alreadyCreatedPermission = $alreadyCreatedPermissions[$permissionName];
                $alreadyCreatedPermission->label = $permissionDescription;
                $alreadyCreatedPermission->save();

                unset($permissionsLookup[$permissionName]);
            } else {
                $newPermission = new Permission();
                $newPermission->name = $permissionName;
                $newPermission->label = $permissionDescription;
                $newPermission->save();
                $alreadyCreatedPermissions[$permissionName] = $newPermission;
            }
        }

        foreach ($permissionsLookup as $permissionToBeDeleted) {
            $permissionToBeDeleted->delete();
            DB::table('permission_role')->where('permission_id', $permissionToBeDeleted->id)
                ->delete();
        }

        $this->info("Permissions synchronization finished");
    }
}
