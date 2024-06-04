<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN
        $admin = new User();
        $admin-> name = 'admin';
        $admin-> nickname = 'admin';
        $admin-> email = 'admin@admin.com';
        $admin-> password = bcrypt('admin1234');        
        $admin->save();

        $roles = Role::all();     
        $adminRole = $roles->where('id',1)->first();

        $admin->roles()->attach($adminRole);

        
    }
}
