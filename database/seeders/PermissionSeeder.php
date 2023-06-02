<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = [
                        'session',
                        'section',
                        'group',
                        'class',
                        'room',
                        'routine',
                        'subject',
                         'student',
                         'studentreport',
                         'accountreport',
                         'feereport',
                         'inventoryreport',
                         'attendance',
                         'homeworke',
                         'examination',
                         'setting',
                         'fees',
                         'cashbook',
                         'bank',
                         'income',
                         'expense',
                         'designation',
                         'department',
                         'payroll',
                         'sms',
                         'notice',
                         'event',
                         'email',
                         'category',
                         'purchase',
                         'supplier',
                         'sale',
                         'book',
                         'member',
                         'user',
                         'role',
                         'permission',
                         'backup',
                         'template',
                         'teacher'
                    ];
        $permissions = ['module','index','store','update','delete','advance'];


        for($i=0;$i<count($groups);$i++){
            $g = PermissionGroup::create(['name'=>$groups[$i]]);
            for($j=0;$j<count($permissions);$j++)
            {
                $p = new Permission();
                $p->group_id = $g->id;
                $p->name = $groups[$i].'-'.$permissions[$j];
                $p->save();
            }
        }
    }
}
