<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Role::create(['role_name' => 'Sekretaris Desa']);
        Role::create(['role_name' => 'Kaur Umum dan Perencanaan']);
        Role::create(['role_name' => 'Kepala Desa']);
        Role::create(['role_name' => 'Staf']);
        Role::create(['role_name' => 'Administrator']);
    }
}
