<?php

namespace App\Http\Controllers\Setting;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch = Branch::all();
        return view('components.Setting.branch',compact('branch'));
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
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|min:11',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $des = "images/branch";
            $name = 'branch.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['image'] = $name;
        }
        Branch::create($data);
        return redirect()->route('backend.branch.index')->with('success','Branch Created Successfully');
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
        $data = Branch::find($id);
        return response()->json($data);
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
        $branch = Branch::find($request->update_id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|min:11',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $des = "images/branch";
            if (File::Exists($des,$branch->image)) {
                File::delete($des,$branch->image);
            }
            $file = $request->file('image');
            $des = "images/branch";
            $name = 'branch.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['image'] = $name;
        }
        $branch->update($data);
        return redirect()->route('backend.branch.index')->with('success','Branch Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->delete();
        return redirect()->route('backend.branch.index')->with('success','Branch Deleted Successfully');
    }

    public function activedeactive($id)
    {
        $branch = Branch::find($id);
        if ($branch->is_active == true) {
            $branch->update(['is_active' => false]);
        }else{
            $branch->update(['is_active' => true]);
        }
        return back();
    }
}
