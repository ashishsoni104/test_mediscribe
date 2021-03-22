<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Roles;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = "Super Admin";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('password');
        $user->save();

        //get superadmin role
        $role = Roles::where('name','superadmin')->first();
        if($role && $role->count()>0){
            $user->assignRole($role);
        }
    }
}
