<?php

namespace Database\Seeders;

use App\Models\Academic\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = ['Shapla','Tiger','Macpay','Jackfruit'];

        foreach ($section as $key => $section) {
            Section::create(['name'=>$section,'branch_id'=>1]);
        }
    }
}
