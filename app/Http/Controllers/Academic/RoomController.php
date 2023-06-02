<?php

namespace App\Http\Controllers\Academic;

use Illuminate\Http\Request;
use App\Models\Academic\Room;
use App\Http\Controllers\Controller;
use App\Models\Academic\Group;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!userHasPermission('room-index')){
           hasNotPermission();
        }
        $room = Room::orderBy('id','desc')->get();
        return view('components.academic.room',compact('room'));
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
        if(!userHasPermission('room-store')){
            hasNotPermission();
        }
        $request->validate([
            'room_number' => 'required'
        ]);
        $data = $request->all();
        $data['branch_id'] = Auth::user()->branch_id;
        $data['code'] = rand(0,9999);
        Room::create($data);
        return redirect()->route('backend.room.index')->with('success','Room Created Successfull');
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
        $data = Room::find($id);
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
        if(!userHasPermission('room-update')){
            hasNotPermission();
        }
        $request->validate([
            'room_number' => 'required'
        ]);
        Room::find($request->update_id)->update([
            'room_number' => $request->room_number,
        ]);
        return redirect()->route('backend.room.index')->with('success','Room Updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!userHasPermission('room-delete')){
           hasNotPermission();
        } 
        Room::find($id)->delete();
        return redirect()->route('backend.room.index')->with('success','Room Deleted Successfull');
    }
}