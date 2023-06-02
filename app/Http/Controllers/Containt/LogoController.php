<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Logo;

class LogoController extends Controller
{
    public function index(){
        $logos=Logo::all();
        return view('containt.school_logo.index',compact('logos'));
    }

    public function cretae(Request $request){
        $newName='logo_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/logos',$newName);

        $inputs=[
            'photo'=>$newName,
        ];
         Logo::create($inputs);
         return redirect()->route('school.log');
    }

      
    public function delete($id){
        $logos=Logo::find($id);
        $logos->delete();
        return redirect()->route('school.log');

     }
}
