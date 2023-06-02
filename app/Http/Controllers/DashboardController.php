<?php

namespace App\Http\Controllers;

use App\Models\Academic\Section;
use App\Models\Student\Student;
use App\Models\Academic\Group;
use App\Models\Academic\Classes;
use App\Models\Academic\Room;
use App\Models\Subject\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
  public function dashboard()
  {
    $total_students = Student::count();
    $total_subjects = Subject::count();
    $total_groups = Group::count();
    $total_sections = Section::count();
    $total_classes = Classes::count();
    $total_rooms = Room::count();

    $data = compact('total_students', 'total_groups', 'total_subjects', 'total_sections', 'total_rooms', 'total_classes');

    return view('components.dashboard', $data);
  }

  public function profile($id)
  {
    $user = User::findOrFail($id);

    return view('components.profile', compact('user'));
  }
  public function profile_update(Request $request, $id)
  {
    $request->validate([
      'old_password' => 'required',
      'new_password' => 'required',
    ]);
    $user = User::findOrFail($id);
    
    if (!Hash::check($request->old_password, $user->password)) {
      return back()->with('error', 'Old password does not match!');
    }

    
    $user->update([
      'password' => Hash::make($request->new_password),
    ]);
    return back()->with('success','Password Update Successfully');
  }
}
