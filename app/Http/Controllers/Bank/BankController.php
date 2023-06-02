<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounting\Bank;


class BankController extends Controller
{
    public function index(){
        $bank=Bank::all();
        return view('components.Accounting.bank.index',compact('bank'));
    }

       //store
       public function store(Request $request){
        $data = $request->all();
        Bank::create($data);
        return redirect()->route('backend.bank.index')->with('message', 'Bank Added Created successfully');
    }

       //delete
       public function destroy($id){
        Bank::where('id',$id)->delete();
        return redirect()->route('backend.bank.index')->with('message', 'Bank Deleted successfully');
    }

        //edit
        public function edit($id){
            $data = Bank::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Bank::where('id',$request->update_id)->update([
                'bank_name'  => $request->bank_name,
                'account_name'  => $request->account_name,
                'account_number'=>$request->account_number,
                'branch'  => $request->branch,
                'opening_due'  => $request->opening_due,
            ]);
            
            return redirect()->route('backend.bank.index')->with('message', 'Bank Updated successfully');
        }
        
    


}
