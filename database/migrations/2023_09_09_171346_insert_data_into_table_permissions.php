<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertDataIntoTablePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Create User',
                'key' => 'create-user'
            ],
            [
                'name' => 'View Users',
                'key' => 'view-users'
            ],
            [
                'name' => 'Update User',
                'key' => 'update-user'
            ],
            [
                'name' => 'Delete User',
                'key' => 'delete-user'
            ],
            [
                'name' => 'View Deleted User',
                'key' => 'view-deleted-user'
            ],
            [
                'name' => 'Create Role',
                'key' => 'create-role'
            ],
            [
                'name' => 'View Roles',
                'key' => 'view-roles'
            ],
            [
                'name' => 'Update Role',
                'key' => 'update-role'
            ],
            [
                'name' => 'Delete Role',
                'key' => 'delete-role'
            ],
            [
                'name' => 'View Repository',
                'key' => 'view-repository'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->whereIn('key', ['create-user', 'view-users', 'update-user', 'delete-user',
             'view-deleted-user', 'create-role', 'view-roles', 'update-role',
              'delete-role', 'view-repository']
        )->delete();
    }
}
