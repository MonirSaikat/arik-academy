<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admissionform;

class OnlineapplyController extends Controller
{
    public function onlineapply(){
        return view('layouts.frontend.testonline');
    }

    public function transection(Request $request){
        return view('layouts.frontend.tnx');
      }

    public function onlineapply_create(Request $request){

        if($request->photo){
            $file= $request->file('photo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Images'), $filename);
            $request->photo = $filename;
        }
        return view('layouts.frontend.tnx',compact('request'));

    }


    public function transectionPost(Request $request){

        $data = $request->all();
        if($request->photo){

            $inputs['photo']= $request->photo;
        }
       
 
        Admissionform::create($data);
        return redirect()->back();

      }

}
