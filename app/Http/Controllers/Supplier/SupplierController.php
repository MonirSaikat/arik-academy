<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Supplier;

class SupplierController extends Controller
{
    public function index(){

        $supplier=Supplier::all();
        return view('components.inventory.supplier.index',compact('supplier'));
    }

      //store
      public function store(Request $request){
        $data = $request->all();
        Supplier::create($data);
        return redirect()->route('backend.supplier.index');
    }

        
       //delete
        public function destroy($id){
        Supplier::where('id',$id)->delete();
        return redirect()->route('backend.supplier.index');
    }

        //edit
        public function edit($id){
            $data = Supplier::find($id);
            return response()->json($data);
        }
    
        public function update(Request $request){
    
            Supplier::where('id',$request->update_id)->update([
                'supplier_name'  => $request->supplier_name,
                'description'  => $request->description,
                'supplier_phone'=>$request->supplier_phone,
                'supplier_email'=>$request->supplier_email,
                'supplier_address'=>$request->supplier_address,
                'person_name'=>$request->person_name,
                'person_phone'=>$request->person_phone,
                'person_email'=>$request->person_email,
         
            ]);
            
            return redirect()->route('backend.supplier.index');
        }
}
