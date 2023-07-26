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
            'name' => 'Arief Agung Purwanto, S.Kom.',
            'email' => 'sekdes@gmail.com',
            'nip' => '192199900297262',
            'alamat' => 'Jl. Ahmad Yani',
            'password' => Hash::make('tes'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Tunggono',
            'email' => 'kaurumum@gmail.com',
            'nip' => '',
            'alamat' => 'Jl. Mangga',
            'password' => Hash::make('tes'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'H. Warso',
            'email' => 'kepdes@gmail.com',
            'nip' => '',
            'alamat' => 'Jl. Jeruk Manis',
            'password' => Hash::make('tes'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Staf Umum',
            'email' => 'staf@gmail.com',
            'nip' => '',
            'alamat' => 'Kroya',
            'password' => Hash::make('tes'),
            'role_id' => 4,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nip' => '',
            'alamat' => 'Perum Karangmangu',
            'password' => Hash::make('tes'),
            'role_id' => 5,
        ]);
    }
}
