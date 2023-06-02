<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Academic\Section;
use App\Models\Examination\Exam;
use App\Models\Examination\Mark;
use App\Models\Examination\Grade;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ViewMarkcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
                
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
                
        if ($request->class_id) {
            if ($request->type == 'student') {
                if (!$request->student_id) {
                    return back()->with('warning','Please select Student');
                }
                $student = Student::where(['id'=>$request->student_id,'session_id' => $request->session_id])->first();
                
                return view('components.examination.view_mark',compact('section','student','student','group'));
            }else{
                if (!$request->subject_id) {
                    return back()->with('warning','Please select Subject');
                }
                $subject = Subject::find($request->subject_id);
                $students = Student::where(['students.class_id'=>$request->class_id,'students.session_id' => $request->session_id])
                    ->join('marks','marks.student_id','students.id')
                    ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                    ->where('exam_setups.subject_id',$request->subject_id)
                    ->select('students.id as id','students.name as name','exam_setups.mark as mark')
                    ->get();
                return view('components.examination.view_mark',compact('section','group','students','subject'));
            }
        }
        return view('components.examination.view_mark',compact('section','group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_result(Request $request)
    {
        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            
            $details = ['class_id'=>$request->class_id,'session_id'=>$request->session_id,'exam_id'=>$request->exam_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id];
            
            if ($request->student_id) {
                $student = Student::where(['id'=>$request->student_id,'session_id' => $details['session_id']])->first();
                
                return view('components.examination.view_result',compact('section','student','student','group','details'));
            }else{
                $students = Student::where(['class_id'=>$request->class_id,'session_id'=>$request->session_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id])->get();
                return view('components.examination.view_result_print2',compact('section','students','group','details'));
            }
        }
        return view('components.examination.view_result',compact('section','group'));
    }
    
    public function view_result_print(Request $request)
    {
        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }

        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
                
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
                
        if ($request->class_id) {
            
            $details = ['class_id'=>$request->class_id,'session_id'=>$request->session_id,'exam_id'=>$request->exam_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id];

            if ($request->student_id) {
                $student = Student::where(['id'=>$request->student_id,'session_id' => $details['session_id']])->first();                
                return view('components.examination.view_result',compact('section','student','student','group','details'));
            }else{
                $students = Student::where(['class_id'=>$request->class_id,'session_id'=>$request->session_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id])->get();
                return view('components.examination.view_result_print',compact('section','students','group','details'));
            }
        }
        
        return view('components.examination.view_result',compact('section','group'));
    }
    
    
    public function tabulation_sheet(Request $request)
    {
        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            $details = ['class_id'=>$request->class_id,'session_id'=>$request->session_id,'exam_id'=>$request->exam_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id];
            $students = Student::where(['class_id'=>$request->class_id,'session_id'=>$request->session_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id])->orderBy('id','asc')->get();
            return view('components.examination.tebulation_sheet_print',compact('section','students','group','details'));
        }
        return view('components.examination.tebulation_sheet',compact('section','group'));
    }
    public function merit_list(Request $request)
    {
        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            $details = ['class_id'=>$request->class_id,'session_id'=>$request->session_id,'exam_id'=>$request->exam_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id];
            $students = Student::where(['class_id'=>$request->class_id,'session_id'=>$request->session_id,
                'group_id'=>$request->group_id,'section_id'=>$request->section_id])->orderBy('id','asc')->get();
            $merit_list = [];
                foreach ($students as $key =>$student) {
                    // $details = Mark::where('student_id',$student->id)->sum('total_marks');

                    $mark_details = Mark::join('students','students.id','marks.student_id')
                    ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                    ->join('subjects','subjects.id','exam_setups.subject_id')
                    ->join('grades','grades.id','marks.grade_id')
                    ->where('students.id',$student->id)
                    ->select('exam_setups.subject_id as subject_id','marks.total_marks as mark','grades.gpa as gpa',
                        'grades.name as grade','subjects.type as type','subjects.subject_code as subject_code')
                    ->get();
                    $constant_gpa =  0;
                    $optional_gpa =  0;
                    $subject =  0;
                    $student_fail = false;
                    foreach ($mark_details as $key => $mark) {
                        if ($mark->type != '2' && $mark->type != '3') {
                            $constant_gpa += $mark->gpa;
                            $subject++;
                            if ($mark->gpa == 0) {
                                $student_fail = true;
                            }
                        }
                        if ($mark->type == '2') {
                            if ($mark->gpa > 2) {
                                $optional_gpa += $mark->gpa - 2;
                            }
                            
                        }
                    }
                    $total_gpa = ($constant_gpa + $optional_gpa) / ($subject == 0 ? 1:$subject);
                    $total_mark = $mark_details->sum('mark');

                    $marks['total_mark'] = $total_mark;
                    $marks['student_id'] = $student->id;
                    $marks['name'] = $student->name;
                    $marks['roll'] = $student->roll_number;
                    if ($student_fail) {
                        $marks['gpa'] = number_format(0.00,2);
                    }else {
                        $marks['gpa'] = $total_gpa > 5 ? number_format(5.00,2) : number_format($total_gpa,2);
                    }
                    
                    array_push($merit_list, $marks);
                }
            $final_result = collect($merit_list)->sortByDesc('total_mark')->sortByDesc('gpa')->all();
                
            
            // $final_result = collect($sort_array)->sortByDesc('total_mark')->all();
            return view('components.examination.merit_list_print',compact('final_result'));
        }
        return view('components.examination.merit_list',compact('section','group'));
    }
    public function mark_sheet(Request $request){
        if (!userHasPermission('examination-index')) {
            hasNotPermission();
        }
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
                
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
                
        if ($request->class_id) {

            $details = ['class_id'=>$request->class_id,'session_id'=>$request->session_id,'exam_id'=>$request->exam_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id];
            
            if ($request->student_id) {
                $students = Student::where(['id'=>$request->student_id,'session_id' => $details['session_id']])->get();
                
                return view('components.examination.mark_sheet_print2',compact('section','students','group','details'));
            }else{
                $students = Student::where(['class_id'=>$request->class_id,'session_id'=>$request->session_id,'group_id'=>$request->group_id,'section_id'=>$request->section_id])->get();
                return view('components.examination.mark_sheet_print2',compact('section','students','group','details'));
            }
        }
        
        return view('components.examination.mark_sheet',compact('section','group'));
    }

}
