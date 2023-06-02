<?php

namespace App\Http\Controllers;

use App\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
  public function studentDashboard()
  {
    return view('students.dashboard');
  }

  public function studentProfile()
  {
    return view('students.profile');
  }

  public function studentFees()
  {
    $student_id = Student::where('student_unique_id', auth()->user()->username)->first()->pluck('id');

    $allAssignedFees = DB::table('fee_allocations')->where('is_all_student', 1)->get();
    $particularFees = DB::table('fee_allocation_students')->where('fee_allocation_student_id', $student_id)->get();

    return view('students.fees');
  }
}
