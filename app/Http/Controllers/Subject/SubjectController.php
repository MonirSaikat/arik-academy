<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Subject\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(!userHasPermission('subject-store')){
            hasNotPermission();
        }
        $subjects = Subject::all();
        return view('components.subject.subject',compact('subjects'));
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
        
        if(!userHasPermission('subject-store')){
            hasNotPermission() ;
        }
        $validated = $request->validate([
            'name' => 'required|unique:subjects',
            'subject_code' => 'required|unique:subjects',
            'type' => 'required',
        ]);
        $data = $request->all();
        $data['branch_id'] = branchName();
        Subject::create($data);
        return redirect()->route('backend.subject.index')->with('success','Subject Created Successfull');
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
        $data = Subject::find($id);
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
        if(!userHasPermission('subject-update')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required'
        ]);
        Subject::find($request->update_id)->update([
            'name' => $request->name,
            'subject_code' => $request->subject_code,
            'type' => $request->type,
            'group_id' => $request->group_id,
        ]);
        return redirect()->route('backend.subject.index')->with('success','Subject Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!userHasPermission('subject-delete')){
           hasNotPermission();
        }
        Subject::find($id)->delete();
        return redirect()->route('backend.subject.index')->with('success','Subject Deleted Successfull');
        
    }
}
