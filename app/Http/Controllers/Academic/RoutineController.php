<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Models\Academic\Routine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(userHasPermission('routine-index')){
            $routine = Routine::all();
            return view('components.academic.routine',compact('routine'));
        }else{
            hasNotPermission();
        }
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
        if(userHasPermission('routine-store')){
            $request->validate([
                'name' => 'required'
            ]);
            $data = $request->all();
            $data['branch_id'] = Auth::user()->branch_id;
            $data['code'] = rand(0,9999);
            Routine::create($data);
            return redirect()->route('backend.routine.index')->with('success','Routine Created Successfull');
        }else{
            hasNotPermission();
        }
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
        $data = Routine::find($id);
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
        if(userHasPermission('routine-update')){
            $request->validate([
                'name' => 'required'
            ]);
            Routine::find($request->update_id)->update([
                'name' => $request->name,
            ]);
            return redirect()->route('backend.routine.index')->with('success','Routine Updated Successfull');
        }else{
            hasNotPermission();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(userHasPermission('routine-delete')){
            Routine::find($id)->delete();
            return redirect()->route('backend.routine.index')->with('success','Routine Deleted Successfull');
            
        }else{
            hasNotPermission();
        }
    }
}