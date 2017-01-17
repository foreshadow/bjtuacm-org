<?php

use Illuminate\Database\Migrations\Migration;
use Ultraware\Roles\Models\Role;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Role::create(['name' => 'Super Admin', 'slug' => 'superadmin']);
        Role::create(['name' => 'Admin', 'slug' => 'admin']);
        Role::create(['name' => 'Coach', 'slug' => 'coach']);
        Role::create(['name' => 'Bjtu Acm', 'slug' => 'bjtuacm']);
        Role::create(['name' => 'Bjtu Student', 'slug' => 'bjtustudent']);
        Role::create(['name' => 'Registered User', 'slug' => 'registereduser']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Role::where('slug', '=', 'superadmin')->delete();
        Role::where('slug', '=', 'admin')->delete();
        Role::where('slug', '=', 'coach')->delete();
        Role::where('slug', '=', 'bjtuacm')->delete();
        Role::where('slug', '=', 'bjtustudent')->delete();
        Role::where('slug', '=', 'registereduser')->delete();
    }
}