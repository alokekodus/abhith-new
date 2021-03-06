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
            'phone' => '7896541230',
            'otp' => '123456',
            'verify_otp' => 1,
            'password' => Hash::make('P@55w0rd123') ,
            'type_id' => 1,
            'is_activate' => 1
        ]);
    }
}
