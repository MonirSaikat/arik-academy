<?php

namespace App\Http\Controllers\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory\InventoryCategory;
use App\Models\Inventory\Itemcoding;
use App\Models\Inventory\Issue;

class IssueController extends Controller
{
    public function index(){
        $category=InventoryCategory::all();
        $item=Itemcoding::all();
        $issue=Issue::all();
        return view('components.inventory.issue.index',compact('category','item','issue'));
    }

      //store
      public function store(Request $request){

        $newName='issue_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/issues',$newName);

        $inputs=[
            'reference_number'=>$request->input('reference_number'),
            'title'=>$request->input('title'),
            'item_title'=>$request->input('item_title'),
            'issue_name'=>$request->input('issue_name'),
            'quantity'=>$request->input('quantity'),
            'issue_date'=>$request->input('issue_date'),
            'return_date'=>$request->input('return_date'),
            'description'=>$request->input('description'),
            'photo'=>$newName,

        ];

        Issue::create($inputs);
        return redirect()->route('backend.issue.index');
    }
    

     //delete
     public function destroy($id){
        Issue::where('id',$id)->delete();
        return redirect()->route('backend.issue.index');
    }

      //edit
      public function edit($id){
        $data= issue::find($id);
        return response()->json($data);
    }

    public function update(Request $request){

        Issue::where('id',$request->update_id)->update([
            'reference_number'=>$request->input('reference_number'),
            'title'=>$request->input('title'),
            'item_title'=>$request->input('item_title'),
            'issue_name'=>$request->input('issue_name'),
            'quantity'=>$request->input('quantity'),
            'issue_date'=>$request->input('issue_date'),
            'return_date'=>$request->input('return_date'),
            'description'=>$request->input('description'),
     
        ]);
        
        return redirect()->route('backend.issue.index');
    }


}
