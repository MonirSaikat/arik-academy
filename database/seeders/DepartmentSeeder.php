<?php

namespace Database\Seeders;

use App\Models\Setting\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = ['Academic','Teacher','HRM'];

        foreach ($group as $key => $group) {
            Department::create(['name'=>$group]);
        }
    }
}
