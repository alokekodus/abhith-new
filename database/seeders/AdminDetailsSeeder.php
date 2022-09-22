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
        $user=UserDetails::create([
            'name' => 'Admin',
            'email' => 'abhit@admin.com',
            'type_id' => 1,
        ]);
        $roles = 1;
        $user->assignRole($roles);
    }
}
