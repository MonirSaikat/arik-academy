<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::create([
            'name' => 'School Management',
            'phone' => '01000000000',
            'email' => 'school@gmail.com',
            'eiin_no' => '0000',
            'code' => '0000',
            'address' => 'Dhap Rangpur',
        ]);
    }
}
