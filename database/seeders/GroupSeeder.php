<?php

namespace Database\Seeders;

use App\Models\Academic\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = ['Science','Humanities','Bussiness'];

        foreach ($group as $key => $group) {
            Group::create(['name'=>$group,'branch_id'=>1]);
        }
    }
}
