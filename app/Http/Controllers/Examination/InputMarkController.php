<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Student\Student;
use App\Models\Academic\Section;
use App\Models\Examination\Mark;
use App\Models\Examination\Grade;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Examination\ExamSetup;
use App\Models\Examination\ExamSetupTitle;

class InputMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        
        return view('components.examination.input_mark',compact('section','group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student = Student::where('class_id',$request->class_id)->orderBy('roll_number','ASC')->get();
        if ($request->section_id) {
            
            if ($request->group_id) {
                $student = Student::where(['session_id'=>$request->session_id,'class_id'=>$request->class_id,'group_id' => $request->group_id,'section_id' => $request->section_id])->orderBy('roll_number','ASC')->get();
            }else{
                $student = Student::where(['session_id'=>$request->session_id,'class_id'=>$request->class_id,'section_id' => $request->section_id])->orderBy('roll_number','ASC')->get();
            }
        }else if($request->group_id){
            $student = Student::where(['group_id'=>$request->group_id,'class_id'=>$request->class_id,'section_id' => $request->section_id])->get();
        }
        $exam_subject = ExamSetup::where('subject_id',$request->subject_id)
                ->where('class_id',$request->class_id)
                ->where('exam_id',$request->exam_id)
                ->first();
        
        if (!$exam_subject) {
            return redirect('examination/input-mark')->with('warning','Examination Not found');
        }
        $exam_subject->title_name =   explode(',',$exam_subject->title_name);
        $exam_subject->mark =   explode(',',$exam_subject->mark);
        
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();

        return view('components.examination.input_mark',compact('section','student','group','exam_subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marks = $request->marks;
        $exam_setup_id = $request -> exam_setup_id;
        $should_update = $request -> update;
        if ($request->student) {
            $exam_setup = ExamSetup::find($exam_setup_id);
            if(!$exam_setup){
                return back()->with('warning','Examination Not found');
            }
            $pass_marks = explode(',', $exam_setup->pass_mark);
            
            foreach ($request->student as $key => $student) {
                $student_id = $student;
                $mark = $marks[$student];

                $total = 0;
                $student_absent = false;
                $student_fail = false;
                $mark_string = '';
                $marksForGrade  = 0;
                
                if($exam_setup->is_converted == true){
                   for ($key = 0;$key < count($pass_marks) - 1; $key++) {
                        $pass_mark = intval($pass_marks[$key]);
                        $m = $mark[$key] ?? 0;
    
                        if($m == 0) {
                            $student_absent = true;
                        }
    
                        $mark_string .= $m . ',';    
                        $m = intval($m);
                        $total += $m;
    
                        if($m < $pass_mark) {
                            $student_fail = true;
                        } else {
                            $marksForGrade += $m;
                        }
                    } 
                    $total = ($total*80/100) + intval($mark[$key]);
                    $mark_string .= $mark[$key] . ',';
                }else{
                    for ($key = 0;$key < count($pass_marks); $key++) {
                        $pass_mark = intval($pass_marks[$key]);
                        $m = $mark[$key];
    
                        if(strtolower(trim($m)) == 'a') {
                            $student_absent = true;
                            $m = 0;
                        }
    
                        $mark_string .= $m . ',';    
                        $m = intval($m);
                        $total += $m;
    
                        if($m < $pass_mark) {
                            $student_fail = true;
                        } else {
                            $marksForGrade += $m;
                        }
                    } 
                }
                
                
                
                $exam_mark = intval($exam_setup->exam_mark);
                $percentage = intval($total * 100 / $exam_mark);

                if($student_fail == false){
                    $mark_grade = Grade::where('persent_from','<=', $percentage)->where('persent_upto','>=',$percentage)->first();
                }else{
                    $mark_grade = Grade::where('persent_from','>=', 0)->where('persent_upto','<=',32)->first();
                }
                
                $foundMark = Mark::where('student_id',$student_id)
                ->where('exam_setup_id',$exam_setup -> id)
                ->first();
                if($foundMark && $should_update != 'on'){
                    return back() -> with('warning', 'Mark already inserted!');
                } else if($foundMark && $should_update == 'on') {
                    $foundMark -> marks = $mark_string;
                    $foundMark -> total_marks = $total;
                    $foundMark -> grade_id = $mark_grade->id;
                    $foundMark -> student_absent = $student_absent;
                    $foundMark -> save();
                }else {
                    $newMark = new Mark([
                        'student_id' => $student_id,
                        'grade_id' => $mark_grade->id,
                        'exam_setup_id' => $exam_setup->id,
                        'marks' => $mark_string, 
                        'exam_id' => $request -> exam_type,
                        'total_marks' => $total,
                        'student_absent' => $student_absent,
                    ]);
                    $newMark->save();
                }
                
            }
            return redirect()->route('backend.input_mark.index')->with('success','Mark Inputed Successfully');
        }else {
            return back()->with('warning','Please Select Students');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seachStudent(Request $request)
    {
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->student_id) {
            $student = Student::findOrFail($request -> student_id);
            $findMarks = Mark::where('student_id',$student->id)->first();
            if (!$findMarks) {
                return redirect()->route('backend.edit_mark.seachStudent')-> with('warning', 'Student Not Found to Marks!');
            }
           $marks = Mark::join('grades', 'marks.grade_id','grades.id')
            ->where('marks.student_id', $request -> student_id)
            ->join('students','students.id', 'marks.student_id')
            ->join('exam_setups', 'exam_setups.id', 'marks.exam_setup_id')
            ->join('subjects', 'subjects.id', 'exam_setups.subject_id')
            ->join('exams', 'exams.id', 'marks.exam_id')
             ->select(
                "exam_setups.exam_mark", "exam_setups.title_name as titles",   "marks.*", 
                "exams.name as exam", "grades.gpa", "grades.name", 
                "students.name as student_name", 
                "subjects.name as subject_name", "subjects.id as subject_id")
            ->get();
            $titles = ExamSetupTitle::all(); 
            return view('components.examination.edit_mark',compact('section','group','student','marks','titles'));
        }
        return view('components.examination.edit_mark',compact('section','group'));
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
    public function updateMard(Request $request, $id)
    {
        $marksArr = $request -> marks; 
        foreach($marksArr as $key => $marks) {
            $mark_id = $key;
            $mark = Mark::findOrFail($mark_id); 
             
            $exam_setup = ExamSetup::where('id', $mark->exam_setup_id)->first(); 
    
            if(!$exam_setup){
                throw new \Exception('Exam setup not found');
            }
    
            $pass_marks = explode(',', $exam_setup -> pass_mark);
        
            $total = 0;
            $student_absent = false;
            $mark_string = '';
            $marksForGrade  = 0;
             
            $exam_mark = intval($exam_setup->exam_mark);
            if($exam_setup->is_converted == true){
                for ($key = 0;$key < count($pass_marks) - 1; $key++) {
                     $pass_mark = intval($pass_marks[$key]);
                     $m = $marks[$key];
                     if(strtolower(trim($m)) == 'a') {
                         $student_absent = true;
                         $m = 0;
                     }
 
                     $mark_string .= $m . ',';    
                     $m = intval($m);
                     $total += $m;
 
                     if($m < $pass_mark) {
                         $student_fail = true;
                     } else {
                         $marksForGrade += $m;
                     }
                 } 
                 $total = ($total*80/100) + intval($marks[$key]);
                 $mark_string .= $marks[$key] . ',';
             }else{
                 for ($key = 0;$key < count($pass_marks); $key++) {
                     $pass_mark = intval($pass_marks[$key]);
                     $m = $marks[$key];
 
                     if(strtolower(trim($m)) == 'a') {
                         $student_absent = true;
                         $m = 0;
                     }
 
                     $mark_string .= $m . ',';    
                     $m = intval($m);
                     $total += $m;
 
                     if($m < $pass_mark) {
                         $student_fail = true;
                     } else {
                         $marksForGrade += $m;
                     }
                 } 
             }
             
            $percentage = intval($total * 100 / $exam_mark);
            $mark_grade = Grade::where('persent_from','<=', $percentage)->where('persent_upto','>=',$percentage)->first();
            $mark->grade_id = $mark_grade -> id;
            $mark->marks = $mark_string;
            $mark->total_marks = $total;
            $mark->student_absent = $student_absent;
            $mark->save();
        } 
        return redirect()->route('backend.edit_mark.seachStudent')->with('success','Student Mark Updated Successfully');
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
