<?php

namespace App\Http\Controllers\Income;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income\Income_Category;
use App\Models\Income\Income;

class IncomeController extends Controller
{
  public function index(){
    $income=Income::all();
    $category=Income_Category::all();
    return view('components.Income.income',compact('income','category'));
  }

     //store
     public function store(Request $request){
        $data = $request->all();
        Income_Category::create($data);
        return redirect()->route('backend.income.index');
    }

       //delete
       public function destroy($id){
        Income_Category::where('id',$id)->delete();
        return redirect()->route('backend.income.index');
    }

    
          //edit
          public function edit($id){
            $data = Income_Category::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Income_Category::where('id',$request->update_id)->update([
                'income_title'  => $request->income_title,
                'amount'  => $request->amount,
                'title'  => $request->title,
                'date'  => $request->date,
                'note'  => $request->note,
         
            ]);
            
            return redirect()->route('backend.income.index');
        }


}
