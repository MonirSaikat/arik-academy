<?php

namespace App\Http\Controllers\Hrm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hrm\Stuff;
use App\Models\Hrm\Department;

class StuffController extends Controller
{
    public function index(){
      
        $department=Department::all();
        $stuff=Stuff::all();
        return view('components.hrm.stuff.index',compact('department','stuff'));
    }

    public function store(Request $request){
        $newName='stuffs_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/stuff',$newName);

        $inputs = [
            'stuff_name'=> $request->input('stuff_name'),
            'phone' => $request->input('phone'),
            'name'=>$request->input('name'),
            'photo' => $newName,

        ];

        Stuff::create($inputs);
        return redirect()->route('backend.stuff.index');
    }

    
     //delete
     public function destroy($id){
        Stuff::where('id',$id)->delete();
        return redirect()->route('backend.stuff.index');
    }

    
      //edit
      public function edit($id){
        $data= Stuff::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Stuff::where('id',$request->update_id)->update([
            'stuff_name'=>$request->input('stuff_name'),
            'phone'=>$request->input('phone'),
            'name'=>$request->input('name'), 
     
        ]); 
        return redirect()->route('backend.stuff.index');
    }
}
