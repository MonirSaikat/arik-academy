<?php

namespace Database\Seeders;

use App\Models\Academic\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classes::create([
            'branch_id' => 1,
            'name' => 'Six',
            'is_active' => 1
        ]);
    }
}
