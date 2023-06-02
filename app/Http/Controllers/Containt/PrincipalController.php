<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Principal;

class PrincipalController extends Controller
{
    public function index(){

        $principals=Principal::all();
        return view('containt.principal.backend.index',compact('principals'));
    }

    public function create(Request $request){

          $newName='principal_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/prinsipals',$newName);

        $inputs=[
            'description'=>$request->input('description'),
            'principal_name'=>$request->input('principal_name'),
            'photo'=>$newName,
        ];
        Principal::create($inputs);
        return redirect()->route('school.principal');
    }

    public function update(Request $request,$id){
                $inputs=[
                 'description'=>$request->input('description'),
                 'principal_name'=>$request->input('principal_name'),
                ];
                $principals=Principal::find($id);
                $principals->update($inputs);
                return redirect()->route('school.principal');
  
           }

    

    public function delete($id){
        $principals=Principal::find($id);
        $principals->delete();
        return redirect()->route('school.principal');

     }
    
}
