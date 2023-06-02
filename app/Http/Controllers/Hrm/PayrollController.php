<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hrm\Payroll;
use App\Models\Hrm\Designation;

class PayrollController extends Controller
{
    public function index(){

        $designation=Designation::all();
        $payroll=Payroll::all();
        return view('components.hrm.payroll.index',compact('designation','payroll'));
    }

     //store
     public function store(Request $request){
        $data = $request->all();
        Payroll::create($data);
        return redirect()->route('backend.payroll.index');
    }

      //delete
      public function destroy($id){
        Payroll::where('id',$id)->delete();
        return redirect()->route('backend.payroll.index');
    }

      //edit
      public function edit($id){
        $data= Payroll::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Payroll::where('id',$request->update_id)->update([
            'employee_name'=>$request->input('employee_name'),
            'account'=>$request->input('account'),
            'amount'=>$request->input('amount'),
            'method'=>$request->input('method'),
            'description'=>$request->input('description'),
     
        ]);
        
        return redirect()->route('backend.payroll.index');
    }
}
