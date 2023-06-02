<?php

namespace App\Http\Controllers\Examination;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Subject\Subject;
use App\Models\Academic\Classes;
use App\Http\Controllers\Controller;
use App\Models\Examination\Exam;
use App\Models\Examination\ExamSetup;
use App\Models\Examination\ExamSetupTitle;
use App\Models\Subject\SubjectAssignClass;

class ExamSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
        ->select('class_assign_groups.*','groups.*')
        ->get();
        $class = Classes::all();
        $subject_class = SubjectAssignClass::all();
        $subject = Subject::all();
        $exam = Exam::orderBy('id','desc')->get();
        $exam_setup = ExamSetup::orderBy('id','desc')->get();
        return view('components.examination.examsetup',compact('class', 'group','exam','subject_class','subject','exam_setup'));
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
        $t_name = $request->title_name;
        $title_name = [];
        $marks = [];
        $pass_mark = [];
        
        foreach($t_name as $key=>$title){
            if(trim($title) !== '') {
                $title_name[] = $title;
                $marks[] = $request->mark[$key];
                $pass_mark[] = $request->pass_mark[$key];
            }
        }
        $subjects = $request->subject;
        
        foreach($subjects as $key=>$sub){
            $findExamSetup = ExamSetup::where(['subject_id'=>$sub,'class_id' => $request->class_id,'exam_id' => $request->exam_id])->first();
            if ($findExamSetup) {
                return redirect()->back()->with('warning','This is Already Setup Before');
            }
            $exam_setup = new ExamSetup();
            $exam_setup->exam_id = $request->exam_id;
            $exam_setup->class_id = $request->class_id;
            $exam_setup->is_converted = $request->is_converted == 'on' ? true:false;
            $exam_setup->subject_id = $sub;
            $exam_setup->group_id = $request->group_id;
            $exam_setup->exam_mark = $request->exam_mark;
            $exam_setup->title_name = implode(',',$title_name);
            $exam_setup->mark = implode(',',$marks);
            $exam_setup->pass_mark = implode(',',$pass_mark);
            $exam_setup->save();
        }

        return redirect()->route('backend.exam_setup.index')->with('success','Exam Setup Created Successfully');
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
        ExamSetup::find($id)->delete();
        return redirect()->back()->with('success','Exam Delated Successfully');
    }


    public function title_store(Request $request)
    {
        ExamSetupTitle::create([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success','Eaxm Setup Title Name Created Successfully');
    }

    public function title_edit($id)
    {
        $data = ExamSetupTitle::find($id);
        return response()->json($data);
    }

    public function title_update(Request $request)
    {
        ExamSetupTitle::find($request->update_id)->update([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success','Eaxm Setup Title Name Updated Successfully');
    }

    public function title_delete($id)
    {
        ExamSetupTitle::find($id)->delete();
        return redirect()->back()->with('success','Eaxm Setup Title Name Delated Successfully');
    }
}
