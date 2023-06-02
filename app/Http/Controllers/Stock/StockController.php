<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\Itemcoding;
use App\Models\Inventory\Store;
use App\Models\Inventory\Supplier;
use App\Models\Stock\Stock;


class StockController extends Controller
{
    public function index(){

        $category=InventoryCategory::all();
        $item=Itemcoding::all();
        $store=Store::all();
        $supplier=Supplier::all();
        $stock=Stock::all();
        return view('components.inventory.stock.index',compact('category','item','store','supplier','stock'));
    }

      //store
      public function store(Request $request){

        $newName='stocks_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/stock',$newName);

        $inputs=[
            'reference_number'=>$request->input('reference_number'),
            'title'=>$request->input('title'),
            'item_title'=>$request->input('item_title'),
            'store_title'=>$request->input('store_title'),
            'supplier_name'=>$request->input('supplier_name'),
            'quantity'=>$request->input('quantity'),
            'date'=>$request->input('date'),
            'description'=>$request->input('description'),
            'photo'=>$newName,

        ];

        Stock::create($inputs);
        return redirect()->route('backend.stock.index');
    }

       //delete
       public function destroy($id){
        Stock::where('id',$id)->delete();
        return redirect()->route('backend.stock.index');
    }

        //edit
        public function edit($id){
            $data = Stock::find($id);
            return response()->json($data);
        }
    
        public function update(Request $request){
    
            Stock::where('id',$request->update_id)->update([
                'reference_number'=>$request->input('reference_number'),
                'title'=>$request->input('title'),
                'item_title'=>$request->input('item_title'),
                'store_title'=>$request->input('store_title'),
                'supplier_name'=>$request->input('supplier_name'),
                'quantity'=>$request->input('quantity'),
                'date'=>$request->input('date'),
                'description'=>$request->input('description'),
         
            ]);
            
            return redirect()->route('backend.stock.index');
        }
}
