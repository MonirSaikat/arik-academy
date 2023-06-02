<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Worker;

class SchoolWorkerController extends Controller
{
    public function index(){
        $workers=Worker::all();
        return view('containt.staff.index',compact('workers'));
    }

    public function cretae(Request $request){
          
        $newName='worker_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/workers',$newName);

        $inputs=[
            'name'=>$request->input('name'),
            'photo'=>$newName,
        ];
        Worker::create($inputs);
        return redirect()->route('school.worker');
    }

    public function delete($id){
        $workers=Worker::find($id);
        $workers->delete();
        return redirect()->route('school.worker');

     }
}
