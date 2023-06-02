<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubjectType;

class SubjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $types = ['Compulsory','Optional','Additional','Eclectic'];
        foreach ($types as $key => $type) {
            SubjectType::create(['name'=>$type]);
        }
    }
}
