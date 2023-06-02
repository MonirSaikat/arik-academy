<?php

namespace Database\Seeders;

use App\Models\Academic\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = ['2022','2023','2024','2025','2026'];

        foreach ($section as $key => $section) {
            Session::create(['name'=>$section,'branch_id'=>1]);
        }
    }
}
