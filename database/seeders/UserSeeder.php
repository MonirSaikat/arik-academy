<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user2 = new User();
        $user2->username = 'saikat';
        $user2->password = Hash::make('saikat');
        $user2->is_active = true;
        $user2->save(); 

    }
}
