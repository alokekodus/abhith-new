<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserDbSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@abhit.com',
            'password' => Hash::make('P@55w0rd123') ,
            'role_id' => 1,
        ]);
    }
}
