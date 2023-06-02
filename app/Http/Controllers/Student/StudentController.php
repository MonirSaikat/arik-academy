<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Models\Academic\Classes;
use App\Models\Academic\Group;
use App\Models\Academic\Section;
use App\Models\Academic\Session;
use App\Models\Religion;
use App\Models\Student\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
  public function index(Request $request)
  {
    if (!userHasPermission('student-index')) {
      hasNotPermission();
    }

    $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
      ->select('class_section_assigns.*', 'sections.*')
      ->get();
    $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
      ->select('class_assign_groups.*', 'groups.*')
      ->get();
    if ($request->class_id) {
      $student = Student::where(['class_id' => $request->class_id, 'section_id' => $request->section_id, 'is_active' => 1, 'group_id' => $request->group_id])->orderBy('roll_number', 'asc')->get();
      return view('components.student.index', compact('section', 'student', 'group'));
    }
    return view('components.student.index', compact('section', 'group'));
  }

  public function getPendingStudents(Request $request)
  {
    $pendingStudents = DB::table('student_admissions')
      ->join('classes', 'student_admissions.class_id', 'classes.id')
      ->select('student_admissions.*', 'classes.name as class_name')
      ->get();

    return view('components.student.pending', compact('pendingStudents'));
  }

  public function create()
  {
    $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
      ->select('class_section_assigns.*', 'sections.*')
      ->get();
    $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
      ->select('class_assign_groups.*', 'groups.*')
      ->get();

    return view('components.student.create', compact('section', 'group'));
  }
  public function store(Request $request)
  {

    if (!userHasPermission('student-store')) {
      hasNotPermission();
    }


    $request->validate([
      'roll_number' => 'required',
      'name' => 'required',
      'father_name' => 'required',
      'mother_name' => 'required',
      'student_phone' => 'min:11',
      'parent_phone' => 'required|min:11|unique:students',
      'class_id' => 'required',
      'session_id' => 'required',
      'gender' => 'required',
      'religion' => 'required',
      'date_of_birth' => 'required',
      'birth_certificate_number' => 'required|unique:students',
      'village' => 'required',
      'post' => 'required',
      'upozila' => 'required',
      'district' => 'required',
      'photo' => 'required|max:2048|mimes:jpeg,png,jpg',
    ]);

    DB::beginTransaction();
    try {
      $data = $request->all();
      $unique_id = Student::orderBy('id', 'desc')->first();
      if ($unique_id) {
        // $data['student_unique_id'] = date('Y') . '000' . '1';
        $data['student_unique_id'] = (int) $unique_id->student_unique_id + 1;
      } else {
        $data['student_unique_id'] = date('Y') . '000' . '1';
      }

      if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $des = "images\students";
        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->move($des, $name);
        $data['photo'] = $name;
      }

      if ($request->same_address == true) {
        $data['parmanent_village'] = $request->village;
        $data['parmanent_post'] = $request->post;
        $data['parmanent_upozila'] = $request->upozila;
        $data['parmanent_district'] = $request->district;
      }

      // store password
      $student = new Student($data);
      // dd($student->toArray());
      $user = new User();
      $user->username = $data['student_unique_id'];
      $user->password = Hash::make('12345678');
      $user->branch_id = 1;
      $user->is_student = true;
      $user->save();
      $u_id = User::orderBy('id', 'desc')->first()->id;
      $student->user_id = $u_id;
      $student->save();
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      dd($e->getMessage());
    }

    return redirect()->back()->with('success', 'Student Inserted Successfully');
  }

  public function edit($id)
  {
    $student = Student::find($id);
    $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
      ->select('class_section_assigns.*', 'sections.*')
      ->get();
    $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
      ->select('class_assign_groups.*', 'groups.*')
      ->get();
    return view('components.student.edit', compact('student', 'section', 'group'));
  }

  public function update(Request $request, $id)
  {
    if (!userHasPermission('student-update')) {
      hasNotPermission();
    }
    $student = Student::find($id);
    $request->validate([
      'roll_number' => 'required',
      'name' => 'required',
      'father_name' => 'required',
      'mother_name' => 'required',
      'student_phone' => 'min:11',
      'parent_phone' => 'required|min:11',
      'class_id' => 'required',
      'session_id' => 'required',
      'gender' => 'required',
      'religion' => 'required',
      'date_of_birth' => 'required',
      'birth_certificate_number' => 'required',
      'village' => 'required',
      'post' => 'required',
      'upozila' => 'required',
      'district' => 'required',
    ]);
    $data = $request->all();
    if ($request->hasFile('photo')) {
      $des = "images\students";
      if (File::Exists($des, $student->photo)) {
        File::delete($des, $student->photo);
      }
      $file = $request->file('photo');

      $name = time() . '.' . $file->getClientOriginalExtension();
      $file->move($des, $name);
      $data['photo'] = $name;
    }
    if ($request->same_address == true) {
      $data['parmanent_village'] = $request->village;
      $data['parmanent_post'] = $request->post;
      $data['parmanent_upozila'] = $request->upozila;
      $data['parmanent_district'] = $request->district;
    }
    $student->update($data);
    return redirect()->route('backend.student.index')->with('success', 'Student Updated Successfully');
  }

  public function destroy($id)
  {
    Student::find($id)->delete();
    return redirect()->back()->with('success', 'Student Deleted Successfully');
  }

  public function activedeactive($id)
  {
    $student = Student::find($id);
    if ($student->is_active == true) {
      $student->update(['is_active' => false]);
    } else {
      $student->update(['is_active' => true]);
    }
    return back();
  }

  public function deactive(Request $request)
  {
    if (!userHasPermission('student-index')) {
      hasNotPermission();
    }

    $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
      ->select('class_section_assigns.*', 'sections.*')
      ->get();
    $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
      ->select('class_assign_groups.*', 'groups.*')
      ->get();
    if ($request->class_id) {
      $student = Student::where(['class_id' => $request->class_id, 'section_id' => $request->section_id, 'is_active' => 0, 'group_id' => $request->group_id])->orderBy('roll_number', 'asc')->get();
      return view('components.student.deactive', compact('section', 'student', 'group'));
    }
    return view('components.student.deactive', compact('section', 'group'));
  }

  public function import(Request $request)
  {
    if (!userHasPermission('student-store')) {
      hasNotPermission();
    }

    $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
      ->select('class_section_assigns.*', 'sections.*')
      ->get();
    $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
      ->select('class_assign_groups.*', 'groups.*')
      ->get();

    if ($request->filter == 1) {
      $info = array('class' => $request->class_id, 'session' => $request->session_id, 'group' => $request->group_id, 'section' => $request->section_id);
      return view('components.student.import', compact('section', 'info', 'group'));
    }
    return view('components.student.import', compact('section', 'group'));

  }

  public function download()
  {
    $filePath = public_path("download/student.xlsx");
    return Response::download($filePath);
  }

  public function import_store(Request $request)
  {
    $this->validate($request, [
      'file' => 'required|mimes:xls,xlsx',
    ]);

    $file = $request->file('file');

    $post_students = Excel::toArray(new StudentImport, $file)[0];
    $inserted = 0;
    $index = 1;

    DB::beginTransaction();
    try {
      foreach ($post_students as $item) {
        if (empty($item) || !$item) {
          continue;
        }

        $index++;

        $class_name = $item['class'];
        $group_name = $item['group'];
        $session_name = $item['session'];
        $section_name = $item['section'];
        $religion = $item['religion'];

        try {
          $class = Classes::firstOrCreate(['name' => trim($class_name)]);

          $group = null;
          if ($group_name) {
            $group = Group::firstOrCreate(['name' => trim($group_name)]);
          }
          $session = Session::firstOrCreate(['name' => trim($session_name)]);

          $section = null;
          if ($section_name) {
            $section = Section::firstOrCreate(['name' => trim($section_name)]);
          }

          $religion = Religion::firstOrCreate(['name' => trim($religion)]);

          $data = [
            'student_unique_id' => $item['student_unique_id'],
            'roll_number' => $item['roll_number'],
            'name' => $item['name'],
            'father_name' => $item['father_name'],
            'mother_name' => $item['mother_name'],
            'parent_phone' => $item['parent_phone'] ?? null,
            'student_phone' => $item['student_phone'],
            'class_id' => $class->id,
            'group_id' => $group->id ?? null,
            'session_id' => $session->id,
            'section_id' => $section->id ?? null,
            'gender' => $item['gender'],
            'religion' => $religion->id,
            'blood_group' => $item['blood_group'] ?? null,
            'date_of_birth' => $item['date_of_birth'] ? date('Y-m-d', strtotime($item['date_of_birth'])) : null,
            'birth_certificate_number' => $item['birth_certificate_number'],
            'photo' => $item['photo'],
            'village' => $item['village'],
            'post' => $item['post'],
            'upozila' => $item['upozila'],
            'district' => $item['district'],
            'parmanent_village' => $item['parmanent_village'],
            'parmanent_post' => $item['parmanent_post'],
            'parmanent_upozila' => $item['parmanent_upozila'],
            'parmanent_district' => $item['parmanent_district'],
            'password' => bcrypt('password'),
            'user_id' => auth()->id(),
          ];

          if (strtolower($data['gender']) == strtolower('Male')) {
            $data['gender'] = 1;
          }

          if (strtolower($data['gender']) == strtolower('Male')) {
            $data['gender'] = 2;
          }

          if (strtolower($data['gender']) == (strtolower('other') or strtolower('others'))) {
            $data['gender'] = 3;
          }

          $student = new Student($data);
          $student->save();

          $inserted++;
        } catch (\Exception $e) {
          dd($e);
          return back()->with('error', $e->getMessage());
        }
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
    }

    $index = 1;

    $student = Student::latest()->first();
    return redirect()->to('/authority/student/index?class_id=' . $student->class_id . '&group_id=' . $student->group_id . '&section_id=' . $student->section_id);
    // return back()->with('success', $index . ' ' . str('student')->plural($index) . ' imported');
  }

  public function search_student($key)
  {
    $data = Student::where('student_unique_id', $key)->with('class')->first();
    return response()->json($data);
  }

}
