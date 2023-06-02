<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hrm\Department;

class DepartmentController extends Controller
{
    public function index(){

        $department=Department::all();
        return view('components.hrm.department.index',compact('department'));
    }

       //store
       public function store(Request $request){
        $data = $request->all();
        Department::create($data);
        return redirect()->route('backend.department.index');
    }

      //delete
      public function destroy($id){
        Department::where('id',$id)->delete();
        return redirect()->route('backend.department.index');
    }

      //edit
      public function edit($id){
        $data= Department::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Department::where('id',$request->update_id)->update([
            'name'=>$request->input('name'),
     
        ]);
        
        return redirect()->route('backend.department.index');
    }
}
