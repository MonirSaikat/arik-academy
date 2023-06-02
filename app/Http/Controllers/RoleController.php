<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\PermissionGroup;
use App\Models\RoleHasPermission;

class RoleController extends Controller
{
    //
    public function index()
    {

    }

    public function create()
    {
        $roles = Role::all();

        return view('components.role.role',compact('roles'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        Role::create(['name'=>$request->name]);
        return redirect()->route('backend.role.create')->with('success','Role created successfully');

    }

    public function edit($id)
    {
        $data = Role::find($id);
        return response()->json($data);
    }

    public function update(Request $request,$id)
    {
        $update =  Role::find($id)->update(['name'=>$request->name]);
        if($update){
            return response()->json('Data update successfully');
        }
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect()->route('backend.role.create')->with('success','Data deleted successfully');
    }


    public function assign_create($id)
    {

        $role = Role::where('id',$id)->first();
        if($role){
            $groups = PermissionGroup::all();
            return view('components.role.role_assign',compact('role','groups'));
        }

        return abort(500, 'Sorry no data find');


    }

    public function assign_store(Request $request,$id)
    {
        $permissions = $request->permissions;

        RoleHasPermission::where('role_id',$id)->delete();
        foreach($permissions as $permission){
            $assign = new RoleHasPermission();
            $assign->role_id = $id;
            $assign->permission_id = $permission;
            $assign->save();
        }

        return redirect()->route('backend.role.create')->with('success','Permssion assign successfully');
    }
}
