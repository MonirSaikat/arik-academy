<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Models\Academic\Classes;
use App\Http\Controllers\Controller;
use App\Models\Academic\ClassAssignGroup;
use App\Models\Academic\ClassSectionAssign;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(userHasPermission('class-index')){
            $classes = Classes::all();
            return view('components.academic.class',compact('classes'));
        }else{
            hasNotPermission();
        }
        $classes = Classes::orderBy('id','desc')->get();
        return view('components.academic.class',compact('classes'));
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
        
        if(!userHasPermission('class-store')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required',
        ]);
        
        $data = $request->all();
        $data['branch_id'] = branchName();
        $class = Classes::create($data);

        if ($request->section) {
            foreach ($request->section as $item) {
                ClassSectionAssign::create([
                    'class_id' => $class->id,
                    'section_id' => $item,
                ]);
            }
        }
        if ($request->group) {
            foreach ($request->group as $item) {
                ClassAssignGroup::create([
                    'class_id' => $class->id,
                    'group_id' => $item,
                ]);
            }
        }
        
        return redirect()->route('backend.class.index')->with('success','Class Created Successfull');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Classes::find($id);
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
        if(!userHasPermission('class-update')){
           hasNotPermission();
        }
        $request->validate([
            'name' => 'required|unique:classes'
        ]);
        Classes::find($request->update_id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('backend.class.index')->with('success','Class Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(userHasPermission('session-delete')){
            Classes::find($id)->delete();
            return redirect()->route('backend.class.index')->with('success','Class Deleted Successfull');

        }else{
            hasNotPermission();

        }
        Classes::find($id)->delete();
        ClassAssignGroup::where('class_id',$id)->delete();
        ClassSectionAssign::where('class_id',$id)->delete();
        return redirect()->route('backend.class.index')->with('success','Class Deleted Successfull');
    }
}
