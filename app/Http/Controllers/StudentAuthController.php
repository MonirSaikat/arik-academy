<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentAuthController extends Controller
{
    public function get_login() {
        if(auth()->user() && auth()->user()->is_student) {
            return redirect()->route('students.dashboard.index'); 
        }
        
        return view('students.auth.login');
    }

    public function post_login(Request $request) {
        $this->validate($request, [
            'student_unique_id' => 'required',
            'password' => 'required'
        ]); 
 
        $credentials = $request->only(['email' => $request->email, 'password' => $request->password]);

        if(Auth::guard('student')->attempt($credentials)) {
            return redirect()->route('students.dashboard.index'); 
        }

        return redirect()->back()->withInput()->withErrors(['username' => 'Invalid username or password']);
    }
}
