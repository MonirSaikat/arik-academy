<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = auth()->user();
        $isAdmin = $user->id == 1 || $user->user_type == 1 || $user->is_student != 1;
        $isStudent = $user->is_student == 1;
        
        if($isAdmin) {
            return $next($request);
        } else if($isStudent) {
            return redirect()->route('students.dashboard.index'); 
        } else {
            abort(403, 'You are not allowed to enter');
        }

    }
}
