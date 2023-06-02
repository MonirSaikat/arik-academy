<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Expense_Category;

class ExpenseController extends Controller
{
    public function index(){
        $expense=Expense::all();
        $category=Expense_Category::all();
        return view('components.Accounting.expense.index',compact('expense','category'));
    }
    
        //store
        public function store(Request $request){
            $data = $request->all();
            Expense_Category::create($data);
            return redirect()->route('backend.expense.index');
        }
        

         //delete
         public function destroy($id){
            Expense_Category::where('id',$id)->delete();
            return redirect()->route('backend.expense.index');
        }

        
           //edit
           public function edit($id){
            $data = Expense_Category::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Expense_Category::where('id',$request->update_id)->update([
                'categori_title'  => $request->categori_title,
                'amount'  => $request->amount,
                'date'=>$request->date,
                'title'=>$request->title,
                'note'=>$request->note,
         
            ]);
            
            return redirect()->route('backend.expense.index');
        }
}
