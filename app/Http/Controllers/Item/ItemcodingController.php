<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\Itemcoding;

class ItemcodingController extends Controller
{
    public function index(){
        $category=InventoryCategory::all();
        $item=Itemcoding::all();
        return view('components.inventory.itemcoding.index',compact('category','item'));
    }

       //store
       public function store(Request $request){
        $data = $request->all();
        Itemcoding::create($data);
        return redirect()->route('backend.item.index');
    }

         //delete
         public function destroy($id){
            Itemcoding::where('id',$id)->delete();
            return redirect()->route('backend.item.index');
        }

            //edit
            public function edit($id){
                $data = Itemcoding::find($id);
                return response()->json($data);
            }
    
            public function update(Request $request){
    
                Itemcoding::where('id',$request->update_id)->update([
                    'item_title'  => $request->item_title,
                    'description'  => $request->description,
                    'title'  => $request->title,
                    'code'  => $request->code,
                    'part_number'  => $request->part_number,
             
                ]);
                
                return redirect()->route('backend.item.index');
            }
    

}
