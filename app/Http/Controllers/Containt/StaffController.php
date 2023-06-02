<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Staff;

class StaffController extends Controller
{
    public function index(){

        $staff=Staff::all();
        return view('containt.faculity.backend.index',compact('staff'));
    }

    public function create(Request $request){

        $newName='staff_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/staffs',$newName);

        $inputs=[
            'name'=>$request->input('name'),
             'photo'=>$newName,
        ];

        Staff::create($inputs);
        return redirect()->route('school.staff');
    }

    public function delete($id){
        $staff=Staff::find($id);
        $staff->delete();
        return redirect()->route('school.staff');

     }


}
