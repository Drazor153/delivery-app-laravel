<?php

namespace Database\Seeders;

use App\Models\AdminModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin_user = new AdminModel();
        $admin_user->email = 'admin@marketfreak.cl';
        $admin_user->nombre = 'SuperMod';
        $admin_user->password = 'd0630163e27c19ee62e6d3163f629b9ff8b5d9c54a64062233551152c6cb02a6';

        $admin_user->save();
    }
}
