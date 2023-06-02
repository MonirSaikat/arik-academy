<?php

namespace App\Http\Controllers\Examination;

use App\Http\Controllers\Controller;
use App\Models\Examination\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::orderBy('gpa','desc')->get();
        return view('components.examination.grade',compact('grades'));
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
        $request->validate([
            'name' => 'required|unique:grades',
            'gpa' => 'required|unique:grades',
            'persent_from' => 'required',
            'persent_upto' => 'required',
        ]);
        $data = $request->all();
        Grade::create($data);
        return redirect()->route('backend.grade.index')->with('success','Grade Inseted Successfully');
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
        $data = Grade::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'gpa' => 'required',
            'persent_from' => 'required',
            'persent_upto' => 'required',
        ]);
        $data = $request->all();
        Grade::find($request->update_id)->update([
            'name' => $request->name,
            'gpa' => $request->gpa,
            'persent_from' => $request->persent_from,
            'persent_upto' => $request->persent_upto,
            'details' => $request->details,

        ]);
        return redirect()->route('backend.grade.index')->with('success','Grade Updated Successfully');
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
