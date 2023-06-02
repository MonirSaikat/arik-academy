<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use App\Models\Containt\Gallery;
use App\Models\Containt\History;
use Illuminate\Http\Request;
use App\Models\Containt\Info;
use App\Models\Containt\Staff;
use App\Models\Containt\Principal;
use App\Models\Containt\Worker;
use App\Models\Containt\Phone;
use App\Models\Containt\Logo;
use App\Models\Containt\Slider;
use App\Models\Containt\Chairman;
use App\Models\Containt\Notice;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        $datas=Info::all();
        $data=History::all();
        $phones=Phone::all();
        $logos=Logo::all();
        $principals=Principal::all();
        $chairmans=Chairman::all();
        $sliders=Slider::all();
        $notices=Notice::all();
        return view('containt.partisal.index',compact('datas','data','phones','logos','principals','chairmans','sliders','notices'));
    }
    
    public function applyOnline() {
        $staff = Staff::all();
        $phones = Phone::all();
        $logos = Logo::all();
        $notices = Notice::all();
        $classes = DB::table('classes')->get();
        
        return view('containt.pages.apply-online',compact('staff','phones','logos','notices', 'classes'));
    }
    
    public function postApplyOnline(Request $request) {
        $data = $this->validate($request, [
            'class_id' => 'required',
            'student_name_english' => 'required',
            'student_name_bangla' => 'required',
            'father_name_english' => 'required',
            'father_name_bangla' => 'required',
            'mother_name_english' => 'required',
            'mother_name_bangla' => 'required',
            'father_mobile_no' => 'required',
            'nid_or_birth_cert' => 'required',
            'date_of_birth' => 'required',
            'present_address' => 'required',
            'parmanent_address' => 'required',
            'gender' => 'required',
            'blood_group' => 'required'
        ]);
        
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalExtension(); 
            $file->move(public_path('students'), $name);
            $data['image'] = $name;
        }
        
        $data['previous_school'] = $request->previous_school;
        DB::table('student_admissions')->insert($data);
        
        return back()->with('success', 'Form submitted, we will inform you soon. Thank you');
    }

    //principal message page view
    public function principal(){
        $principals=Principal::all();
        $logos=Logo::all();
        $phones=Phone::all();
        $notices=Notice::all();
        return view('containt.principal.index',compact('principals','phones','logos','notices'));
    }

    //admission information page view
    public function worker(){
        $workers=Worker::all();
        $logos=Logo::all();
        $phones=Phone::all();
        $notices=Notice::all();
        return view('containt.staff.frontend.staff',compact('workers','phones','logos','notices'));
    }

    //faculity and staff
    public function staffs(){
        $staff=Staff::all();
        $phones=Phone::all();
        $logos=Logo::all();
        $notices=Notice::all();
        return view('containt.faculity.index',compact('staff','phones','logos','notices'));
    }

    //result page view
    public function result(){
        $phones=Phone::all();
        $logos=Logo::all();
        $notices=Notice::all();
        return view('containt.result.index',compact('phones','logos','notices'));
    }

    //alumni page view
    public function alumni(){
        $phones=Phone::all();
        $logos=Logo::all();
        $notices=Notice::all();
        return view('containt.alumni.index',compact('phones','logos','notices'));
    }

    //gallery
    public function gallery(){
        $gallerys=Gallery::all();
        $phones=Phone::all();
        $logos=Logo::all();
        $notices=Notice::all();
        return view('containt.Gallery.backend.index',compact('gallerys','phones','logos','notices'));
    }
}
