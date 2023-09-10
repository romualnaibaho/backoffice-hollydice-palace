<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertDataIntoTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@hollydice.com',
            'password' => bcrypt('Admin123'),
            'role_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@hollydice.com')->delete();
    }
}
