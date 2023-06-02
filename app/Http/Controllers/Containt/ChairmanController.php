<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Chairman;

class ChairmanController extends Controller
{
    public function index(){
        $chairmans = Chairman::all();
        return view('containt.chairman.index',compact('chairmans'));
    }

    public function create(Request $request){
        $newName='chairman_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/chairmans',$newName);

        $inputs=[
            'chairman_name'=>$request->input('chairman_name'),
            'photo'=>$newName,
        ];
        Chairman::create($inputs);
        
        return redirect()->route('school.chairman.photo');
    }
    
    public function update_data(Request $request, $id) {
        try {
            $chairman = Chairman::findOrFail($id);
            $chairman->chairman_name = $request->name;
            $chairman->save();
            return back()->with('success', 'Information updated');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }

       
    public function delete($id){
        $chairmans=Chairman::find($id);
        $chairmans->delete();
        return redirect()->route('school.chairman.photo');

     }
}
