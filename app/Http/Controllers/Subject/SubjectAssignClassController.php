<?php

namespace App\Http\Controllers\Subject;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Academic\Classes;
use App\Models\Academic\Section;
use App\Http\Controllers\Controller;
use App\Models\Subject\OptionalSubjectAssign;
use App\Models\Subject\SubjectAssignClass;

class SubjectAssignClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userHasPermission('subject-advance')) {
            hasNotPermission();
        }
        $classes = Classes::all();
        return view('components.subject.subjectassigntoclass',compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!userHasPermission('subject-advance')) {
            hasNotPermission();
        }
        if ($request->group_id) {
            
            SubjectAssignClass::where('class_id',$request->class_id)->where('group_id',$request->group_id)->delete();
            foreach ($request->subject_id as $item) {
                SubjectAssignClass::create([
                    'class_id' => $request->class_id,
                    'group_id' => $request->group_id,
                    'subject_id' => $item,
                ]);
            }
        }else{
            SubjectAssignClass::where('class_id',$request->class_id)->delete();
            foreach ($request->subject_id as $item) {
                SubjectAssignClass::create([
                    'class_id' => $request->class_id,
                    'group_id' => $request->group_id,
                    'subject_id' => $item,
                ]);
            }
        }
        
        
        return redirect()->route('backend.subjectassign.index')->with('success','Subject Assign Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function optionalassign(Request $request)
    {
        if (!userHasPermission('student-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            $student = Student::where(['class_id' => $request->class_id,'section_id' => $request->section_id,'is_active' => 1,'group_id' => $request->group_id])->orderBy('roll_number','asc')->get();
            return view('components.subject.optionalsubjectassign',compact('section','student','group'));
        }
        return view('components.subject.optionalsubjectassign',compact('section','group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function optionalassignstore(Request $request)
    {
        foreach ($request->student as $key => $value) {
            OptionalSubjectAssign::where('student_id',$value)->delete();
            OptionalSubjectAssign::create([
                'student_id' => $value,
                'subject_id' => $request->subject,
            ]);
        }
        return redirect()->route('backend.subjectassignstudent.optionalassign')->with('success','Optional Subject Assign Success');
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
        SubjectAssignClass::where('class_id',$id)->delete();
        return back();
    }
}
