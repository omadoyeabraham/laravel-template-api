<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\Enums\UserPermissions;
use App\Models\Enums\UserRoles;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRegularUserRolesAndPermissions();
        $this->createAdminRolesAndPermissions();
    }

    /**
     * Create the roles and permissions for admin users
     */
    private function createAdminRolesAndPermissions()
    {
        $adminUser = Role::create(['name' => UserRoles::ADMIN_USER]);

//        $canCrudUsers = Permission::create(['name' => UserPermissions::CAN_CRUD_USERS]);
//        $adminUser->syncPermissions([$canCrudUsers]);
    }

    /**
     * Create the roles and permissions for regular users
     */
    private function createRegularUserRolesAndPermissions()
    {
        $regularUser = Role::create(['name' => UserRoles::REGULAR_CUSTOMER]);
    }
}
