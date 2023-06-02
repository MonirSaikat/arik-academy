<?php

namespace App\Http\Controllers\Transcation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounting\Bank;
use App\Models\Transcation;

class TranscationController extends Controller
{
    public function index(){

        $bank=Bank::all();
        $transcation=Transcation::all();
        return view('Components.Accounting.transcation.index',compact('bank','transcation'));
    }

    
       //store
       public function store(Request $request){
        $data = $request->all();
        Transcation::create($data);
        return redirect()->route('backend.transcation.index')->with('message', 'Bank Transcation Added Created successfully');
    }

         //delete
         public function destroy($id){
            Transcation::where('id',$id)->delete();
            return redirect()->route('backend.transcation.index')->with('message', 'Bank Deleted successfully');
        }

          //edit
          public function edit($id){
            $data = Transcation::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            Bank::where('id',$request->update_id)->update([
                'date'  => $request->date,
                'bank_name'  => $request->bank_name,
                'account_type'  => $request->account_type,
                'amount'=>$request->amount,
                'description'  => $request->description,
         
            ]);
            
            return redirect()->route('backend.transcation.index')->with('message', 'Bank Updated successfully');
        }
        
}
