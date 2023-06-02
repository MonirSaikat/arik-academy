<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religions = ['Islam','Hinduism','Christianity','Buddhism','Others'];
        foreach($religions as $religion)
        {
            Religion::create(['name'=>$religion]);
        }


    }
}
