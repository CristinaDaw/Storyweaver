<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ROLE ADMIN
        $admin = new Role();
        $admin-> name = 'Admin';
        $admin->save();

        //ROLE USER
        $user = new Role();
        $user-> name = 'User';
        $user->save();
    }
}
