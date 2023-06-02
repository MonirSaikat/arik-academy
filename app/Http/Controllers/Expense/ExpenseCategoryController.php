<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseCategoryController extends Controller
{
    public function index(){
        $expense=Expense::all();
        return view('components.Accounting.expense_category.index',compact('expense'));
    }

        //store
        public function store(Request $request){
            $data = $request->all();
            Expense::create($data);
            return redirect()->route('backend.expense_category.index')->with('message', 'Bank Transcation Added Created successfully');
        }

        //delete
        public function destroy($id){
            Expense::where('id',$id)->delete();
            return redirect()->route('backend.expense_category.index')->with('message', 'Bank Deleted successfully');
        }


           //edit
           public function edit($id){
            $data = Expense::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Expense::where('id',$request->update_id)->update([
                'title'  => $request->title,
                'description'  => $request->description,
         
            ]);
            
            return redirect()->route('backend.expense_category.index')->with('message', 'Bank Updated successfully');
        }


}
