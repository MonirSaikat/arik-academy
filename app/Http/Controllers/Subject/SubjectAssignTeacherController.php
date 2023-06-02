<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject\SubjectAssignTeacher;
use App\Models\Teacher\Teacher;
use Illuminate\Http\Request;

class SubjectAssignTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::all();
        return view('components.subject.subjectassigntoteacher',compact('teacher'));
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
        SubjectAssignTeacher::where('teacher_id',$request->teacher_id)->delete();
        foreach ($request->subject_id as $item) {
            SubjectAssignTeacher::create([
                'teacher_id' => $request->teacher_id,
                'subject_id' => $item,
            ]);
        }
        return redirect()->route('backend.subjectassignteacher.index')->with('success','Subject assign to teacher success');
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
        SubjectAssignTeacher::where('teacher_id',$id)->delete();
        return back();
    }
}
