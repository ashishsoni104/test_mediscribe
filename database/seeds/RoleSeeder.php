<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles[0] = [
            'name'=>'superadmin',
            'label'=>'Super Admin',
            'description'=>"This is superadmin role"
        ];
        $roles[1] = [
            'name'=>'company',
            'label'=>'Company',
            'description'=>"This is Company role"
        ];
        DB::table('roles')->insert($roles);
    }
}
