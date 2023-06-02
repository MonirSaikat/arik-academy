<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Info;
use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function index(){

        $data=Info::all();
        return view('containt.backend.message',compact('data'));
    }

    public function message(Request $request){

        // $newName='principal_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        // $request->file('photo')->move('uploads/prinsipals',$newName);

        $data = [
            'principal'=>$request->input('principal'),
            'chairman'=>$request->input('chairman'),
            'message'=>$request->input('message'),
            // 'photo'=>$newName,
        ];
        Info::create($data);
        return redirect()->route('school.principal.index');

    }

    public function delete($id){
        $data=Info::find($id);
        $data->delete();
        return redirect()->route('school.principal.index');

     }

     //edit
     public function edit($id){
        $value=Info::find($id);
        return view('containt.backend.edit',compact('value'));
     }

     public function update(Request $request,$id){
        $inputs=[
            'principal'=>$request->input('principal'),
            'chairman'=>$request->input('chairman'),
            'message'=>$request->input('message'),

          ];
              $value=Info::find($id);
              $value->update($inputs);
              return redirect()->route('school.principal.index');
     }
}
