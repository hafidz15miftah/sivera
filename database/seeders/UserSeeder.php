<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Warso',
            'email' => 'kepdes@gmail.com',
            'password' => Hash::make('tes'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Tunggono',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('tes'),
            'role_id' => 2,
        ]);
    }
}
