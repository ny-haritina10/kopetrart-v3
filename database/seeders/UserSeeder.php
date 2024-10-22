<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'koto',
        //     'email' => 'koto@gmail.com',
        //     'password' => Hash::make('koto'),
        //     'id_role' => 1 
        // ]);

        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'id_role' => 4
        // ]);

        // User::create([
        //     'name' => 'manager',
        //     'email' => 'manager@gmail.com',
        //     'password' => Hash::make('manager'),
        //     'id_role' => 5
        // ]);


        User::create([
            'name' => 'secretaire',
            'email' => 'secretaire@gmail.com',
            'password' => Hash::make('secretaire'),
            'id_role' => 5
        ]);
    }
}