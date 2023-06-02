<?php

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\Controller;
use App\Models\Academic\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function index()
    {
        if(!userHasPermission('session-index')){
            hasNotPermission();
        }
        $session = Session::orderBy('id','desc')->get();
        return view('components.academic.session',compact('session'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(!userHasPermission('session-store')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required'
        ]);
        $data = $request->all();
        $data['branch_id'] = Auth::user()->branch_id ?? 1;
        $data['code'] = rand(0,9999);
        Session::create($data);
        return redirect()->route('backend.session.index')->with('success','Session Created Successfull');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = Session::find($id);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        if(!userHasPermission('session-update')){
            hasNotPermission();
        }
        $request->validate([
            'name' => 'required'
        ]);
        Session::find($request->update_id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('backend.session.index')->with('success','Session Updated Successfull');
    }
    
    public function destroy($id)
    {
        if(!userHasPermission('session-delete')){
            hasNotPermission();
        }
        Session::find($id)->delete();
        return redirect()->route('backend.session.index')->with('success','Session Deleted Successfull');
    }
}
