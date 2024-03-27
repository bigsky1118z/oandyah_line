<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Role;
use App\Models\User\Subdirectory;
use App\Models\User\SubdirectoryRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSubdirectoryRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subdirectories =   Subdirectory::all();
        $roles          =   Role::all();
        foreach($subdirectories as $subdirectory){
            foreach($roles as $role){
                SubdirectoryRole::Create(array(
                    "subdirectory_id"   =>  $subdirectory->id,
                    "role_id"           =>  $role->id,
                ));
            }
        }

        $user   =   User::whereEmail("bigsky1118@gmail.com")->first();
        $user->set_subdirectory_role("website","all");
        $user->set_subdirectory_role("gluten_free","all");
        $user->set_subdirectory_role("jinguji_ozora","all");
        $user->set_subdirectory_role("kbox","all");
        $user->set_subdirectory_role("pokemon","all");

        $user   =   User::whereEmail("bigsky1118z@gmail.com")->first();
        $user->set_subdirectory_role("website","admin");
        $user->set_subdirectory_role("website","client");
        $user->set_subdirectory_role("kbox","all");
        $user->set_subdirectory_role("gluten_free");
        $user->set_subdirectory_role("jinguji_ozora");
        $user->set_subdirectory_role("pokemon");


    }
}
