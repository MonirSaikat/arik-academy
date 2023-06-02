<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\GeneralSetting;
use DB;
class GeneralSettingController extends Controller
{
    //
    public function language($lang){

        session()->put('language', $lang);
        return redirect()->back();
    }
    
    public function index()
    {
        $general_setting = DB::table('general_settings')->where('id',1)->first();
        return view('components.Setting.general_setting',compact('general_setting'));
    }
    public function store(Request $request)
    {
        $general_setting = GeneralSetting::find(1);
        $logo = '';
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $des = 'Image/Setting/';
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $logo = $name;
        }
        $general_setting->update([
            'name' => $request->name,
            'eiin_no' => $request->eiin_no,
            'code' => $request->code,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'logo' => $logo,
        ]);
        return redirect()->back();
    }
}
