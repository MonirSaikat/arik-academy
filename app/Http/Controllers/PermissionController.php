<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use App\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {

    }

    public function create()
    {
        $groups = PermissionGroup::all();
        return view('components.permission.permission',compact('groups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required | unique:permission_groups'
        ]);


        $group_name =  str_replace(' ','',strtolower($request->permission_category));

        $group = PermissionGroup::create(['name'=>$request->permission_category]);

        $permissions = explode(',',$request->name);
        foreach($permissions as $permission)
        {
            Permission::create(['group_id'=>$group->id,'name'=>$group_name.'-'.$permission]);
        }

        return redirect()->route('admin.permission.create')->with('success','Permission created successfully');


    }

    public function edit($id)
    {

    }

    public function update(Request $request,$id)
    {

    }

    public function destroy($id)
    {

    }
}
