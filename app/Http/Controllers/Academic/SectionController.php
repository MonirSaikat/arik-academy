<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Models\Academic\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userHasPermission('section-index')){
            hasNotPermission();
        }
        $section = Section::orderBy('id','desc')->get();
        return view('components.academic.section',compact('section'));
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
        if(!userHasPermission('section-store')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        $data['branch_id'] = Auth::user()->branch_id;
        $data['code'] = rand(0,9999);
        Section::create($data);
        return redirect()->route('backend.section.index')->with('success','Section Created Successfull');
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
        $data = Section::find($id);
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
        if(!userHasPermission('section-update')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required'
        ]);
        Section::find($request->update_id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('backend.section.index')->with('success','Section Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!userHasPermission('section-delete')){
            hasNotPermission();
        }
        Section::find($id)->delete();
        return redirect()->route('backend.section.index')->with('success','Section Deleted Successfull');
    }
}