<?php

namespace App\Http\Controllers\Stores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\Store;

class StoreController extends Controller
{
    public function index(){
        $store=Store::all();
        return view('components.inventory.store.index',compact('store'));
    }

    
          //store
          public function store(Request $request){
            $data = $request->all();
            Store::create($data);
            return redirect()->route('backend.store.index');
        }
        
       //delete
       public function destroy($id){
        Store::where('id',$id)->delete();
        return redirect()->route('backend.store.index');
    }

       //edit
       public function edit($id){
        $data = Store::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Store::where('id',$request->update_id)->update([
            'store_title'  => $request->store_title,
            'description'  => $request->description,
     
        ]);
        
        return redirect()->route('backend.store.index');
    }
}
