<?php

namespace Database\Seeders;

use App\Models\UserHasRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHasRole::create([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
