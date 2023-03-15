<?php

namespace App\Console\Commands\ACL;

use App\Constant\RolesConstant;
use App\Models\ACL\Role;
use Illuminate\Console\Command;

class SynchronizeRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'synchronize-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes roles.';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
            $this->info('Roles synchronization started.');

            $presentRoles = Role::all();
            $alreadyCreatedRoles = $presentRoles->keyBy('name');

            // array holding roles that will be removed after match with the new ones
            // after iteration only those that need to be removed will be left in it
            $rolesLookup = $presentRoles->keyBy('name');

            $roles = RolesConstant::ROLE_DESCRIPTIONS;
            foreach ($roles as $roleName => $roleDescription) {
                if (isset($alreadyCreatedRoles[$roleName])) {
                    $alreadyCreatedRole = $alreadyCreatedRoles[$roleName];
                    $alreadyCreatedRole->label = $roleDescription;
                    $alreadyCreatedRole->save();

                    unset($rolesLookup[$roleName]);
                } else {
                    $newRole = new Role();
                    $newRole->name = $roleName;
                    $newRole->label = $roleDescription;
                    $newRole->save();
                    $alreadyCreatedRoles[$roleName] = $newRole;
                }
            }

            foreach ($rolesLookup as $roleToBeDeleted) {
                $roleToBeDeleted->delete();
            }

            $this->info("Roles synchronization finished");
    }
}
