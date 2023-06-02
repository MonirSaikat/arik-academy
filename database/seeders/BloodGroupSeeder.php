<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        $bloods = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];

        foreach ($bloods as $blood) {
            BloodGroup::create(['name'=>$blood]);
        }




    }
}
