<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\History;
// use App\Models\Containt\History as ContaintHistory;

class HistoryController extends Controller
{
    public function index(){

        $data=History::all();
        return view('containt.school_history.index', compact('data'));
    }

    public function create(Request $request){

        $data=[
            'history'=>$request->input('history'),
        ];
        
        History::create($data);
        return redirect()->route('school.history');
    }

    public function delete($id){
        $data=History::find($id);
        $data->delete();
        return redirect()->route('school.history');

     }

    //edit page show
    public function edit($id){
        $data=History::find($id);
        return view('containt.school_history.edit',compact('data'));
    }

     public function update(Request $request,$id){

    $inputs=[

        'history'=>$request->input('history'),

          ];
          $data=History::find($id);
          $data->update($inputs);
          return redirect()->route('school.history');

     }



}
