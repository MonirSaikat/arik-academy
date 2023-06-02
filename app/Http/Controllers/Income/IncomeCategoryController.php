<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income\Income;

class IncomeCategoryController extends Controller
{
    public function index(){
        $income=Income::all();
        return view('components.Income.income_category',compact('income'));
    }
      //store
      public function store(Request $request){
        $data = $request->all();
        Income::create($data);
        return redirect()->route('backend.income_category.index');
    }

    
         //delete
         public function destroy($id){
            Income::where('id',$id)->delete();
            return redirect()->route('backend.income_category.index');
        }

          //edit
          public function edit($id){
            $data = Income::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Income::where('id',$request->update_id)->update([
                'title'  => $request->title,
                'description'  => $request->description,
         
            ]);
            
            return redirect()->route('backend.income_category.index');
        }
}
