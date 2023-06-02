<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Phone;

class PhoneController extends Controller
{
    public function index()
    {

        $phones = Phone::all();
        return view('containt.school_phone.index', compact('phones'));
    }

    public function create(Request $request)
    {

        // $newName = 'school_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
        // $request->file('photo')->move('uploads/schools', $newName);

        $input = [
            'school_name' => $request->input('school_name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'teacher'=>$request->input('teacher'),
            'student'=>$request->input('student'),
            'year'=>$request->input('year'),
            'buliding'=>$request->input('buliding'),    
        ];

        Phone::create($input);
        return redirect()->route('school.phone');
    }

    public function delete($id)
    {
        $phones = Phone::find($id);
        $phones->delete();
        return redirect()->route('school.phone');
    }

    public function edit($id)
    {
        $phones = Phone::find($id);
        return view('containt.school_phone.edit', compact('phones'));
    }
    public function update(Request $request, $id)
    {
        $inputs = [
            'school_name' => $request->input('school_name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'teacher'=>$request->input('teacher'),
            'student'=>$request->input('student'),
            'year'=>$request->input('year'),
            'buliding'=>$request->input('buliding'),   
        ];
        $phones = Phone::find($id);
        $phones->update($inputs);
        // if (!empty($request->file('photo'))) {
        //     if (file_exists('uploads/schools/' . $phones->photo)) {
        //         unlink('uploads/schools/' . $phones->photo);
        //     }
        //     $newName = 'school_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();

        //     $request->file('photo')->move('uploads/schools', $newName);
        //     $phones->update(['photo' => $newName]);
        // }
        return redirect()->route('school.phone');
    }
}
