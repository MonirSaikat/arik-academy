<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryCategory;

class InventoryCategoryController extends Controller
{
    public function index(){
        $category=InventoryCategory::all();
        return view('components.inventory.category.index',compact('category'));
    }

          //store
          public function store(Request $request){
            $data = $request->all();
            InventoryCategory::create($data);
            return redirect()->route('backend.inventory_category.index');
        }

       //delete
       public function destroy($id){
        InventoryCategory::where('id',$id)->delete();
        return redirect()->route('backend.inventory_category.index');
    }
    
         //edit
         public function edit($id){
            $data = InventoryCategory::find($id);
            return response()->json($data);
        }

        public function update(Request $request){

            InventoryCategory::where('id',$request->update_id)->update([
                'title'  => $request->title,
                'description'  => $request->description,
         
            ]);
            
            return redirect()->route('backend.inventory_category.index');
        }
    
}
