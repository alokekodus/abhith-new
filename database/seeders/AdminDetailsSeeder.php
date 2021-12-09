<?php

namespace Database\Seeders;

use App\Models\UserDetails;
use Illuminate\Database\Seeder;

class AdminDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetails::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'abhit@admin.com',
            'user_id' => 1,
        ]);
    }
}
