<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $branch = new Branch();
        $branch->name = "test";
        $branch->address = 'test';
        $branch->phone_number = '01478896542';
        $branch->save();
    }
}
