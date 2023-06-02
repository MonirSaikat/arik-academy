<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Slider;

class SliderController extends Controller
{
    public function index(){
        $sliders=Slider::all();
        // $sliders=Slider::where('status','0')->get();
        return view('containt.slider.index',compact('sliders'));
    }
    
    public function create(Request $request){
        
         $newName = 'slider_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
         $request->file('photo')->move('uploads/sliders', $newName);

         $inputs=[
            // 'school_name'=>$request->input('school_name'),
            'photo'=>$newName,
         ];
         Slider::create($inputs);
         return redirect()->route('school.slider');
    }

    public function delete($id)
    {
        $sliders = Slider::find($id);
        $sliders->delete();
        return redirect()->route('school.slider');
    }

}
