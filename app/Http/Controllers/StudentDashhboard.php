<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentDashhboard extends Controller
{
    public function index() {
        return view('students.dashboard'); 
    }

    public function profile(){ 
        return view('students.profile.index'); 
    }

    public function fee_list() {
        return view('students.fees.index'); 
    }

    public function update_password(Request $request) {
        $data = $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = Auth::user();
        if(!Hash::check($data['old_password'], $user->password)) {
            return back()->with('error', 'Old password does not match');
        }

        $user->password = Hash::make($data['password']); 
        $user->save(); 

        return back()->with('success', 'Password updated');
    }
}
