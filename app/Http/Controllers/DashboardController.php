<?php

namespace App\Http\Controllers;

use App\Models\Academic\Section;
use App\Models\Student\Student;
use App\Models\Academic\Group;
use App\Models\Academic\Classes;
use App\Models\Academic\Room;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;

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
}
