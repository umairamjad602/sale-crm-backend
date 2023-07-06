<?php

namespace Database\Seeders;

use App\Models\User;
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
       $user = User::create([
           'first_name' => 'CRM',
           'last_name' => 'Administrator',
           'email' => 'admin@sale-crm.com',
           'password' => Hash::make('123456'),
           'confirm_password' => Hash::make('123456'),
           'phone' => '+00000000000',

        ]);

    }
}
