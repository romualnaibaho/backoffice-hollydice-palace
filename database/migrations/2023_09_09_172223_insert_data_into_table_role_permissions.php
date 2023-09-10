<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertDataIntoTableRolePermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permission_role')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1
            ],
            [
                'role_id' => 1,
                'permission_id' => 2
            ],
            [
                'role_id' => 1,
                'permission_id' => 3
            ],
            [
                'role_id' => 1,
                'permission_id' => 4
            ],
            [
                'role_id' => 1,
                'permission_id' => 5
            ],
            [
                'role_id' => 1,
                'permission_id' => 6
            ],
            [
                'role_id' => 1,
                'permission_id' => 7
            ],
            [
                'role_id' => 1,
                'permission_id' => 8
            ],
            [
                'role_id' => 1,
                'permission_id' => 9
            ],
            [
                'role_id' => 1,
                'permission_id' => 10
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permission_role')->where('id', 1)->delete();
    }
}
