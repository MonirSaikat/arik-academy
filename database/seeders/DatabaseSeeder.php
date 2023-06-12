<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting\Department;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(DepartmentSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserHasRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(BloodGroupSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(SubjectTypeSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(GeneralSettingSeeder::class);

        \DB::table('fee_schedules')->insert([
            ['name' => 'Registration Fee', 'time' => 1],
            ['name' => 'N/A', 'time' => 0],
        ]);

    }
}
