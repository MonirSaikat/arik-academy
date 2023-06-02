<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hrm\Department;
use App\Models\Hrm\Designation;

class DesignationController extends Controller
{
    public function index(){
        $department=Department::all();
        $designation=Designation::all();
        return view('components.hrm.designation.index',compact('department','designation'));
    }
       //store
       public function store(Request $request){
        $data = $request->all();
        Designation::create($data);
        return redirect()->route('backend.designation.index');
    }

       //delete
       public function destroy($id){
        Designation::where('id',$id)->delete();
        return redirect()->route('backend.designation.index');
    }

      //edit
      public function edit($id){
        $data= Designation::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Designation::where('id',$request->update_id)->update([
            'employee_name'=>$request->input('employee_name'),
            'name'=>$request->input('name'),
            'designation'=>$request->input('designation'),
     
        ]);
        
        return redirect()->route('backend.designation.index');
    }


}
