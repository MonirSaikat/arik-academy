<?php

namespace App\Http\Controllers\Attendance;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Student\Student;
use App\Models\Academic\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!userHasPermission('attendance-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            $class = $request->class_id;
            $session = $request->session_id;
            $student = Student::where(['class_id' => $request->class_id,'section_id' => $request->section_id,'is_active' => 1,'group_id' => $request->group_id,'session_id' => $request->session_id])->orderBy('roll_number','asc')->get();
            return view('components.Attendance.attendance',compact('section','student','group','class','session'));
        }
        return view('components.Attendance.attendance',compact('section','group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!userHasPermission('attendance-store')){
            hasNotPermission();
        }
        $students = $request->student;
        $notes = $request->note;
        $attendance_type = $request->type;
        $date = $request->date;
        if (!$students) {
            return back()->with('warning','Please Check Students');
        }

        foreach ($students as $key => $student) {
            $check = Attendance::where(['student_id'=>$student,'attendance_date' => $date])->first();

            if (!$check) {
                Attendance::create([
                    'attendance_type' => $attendance_type,
                    'notes' => $notes[$student],
                    'attendance_date' => $date,
                    'student_id' => $student,
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id,
                ]);
            }else{
               $check->update([
                    'attendance_type' => $attendance_type
               ]);
            }
        }
        return redirect()->route('backend.attendance.index')->with('success','Attendance Inserted Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
