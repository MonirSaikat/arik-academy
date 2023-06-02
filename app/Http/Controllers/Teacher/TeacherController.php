<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Teacher\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::orderBy('id','desc')->get();
        return view('components.teacher.teacher',compact('teacher'));
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
            'photo' => 'required|max:2048|mimes:jpeg,png,jpg',
            'file' => 'required',
            'department_id' => 'required',
            'salary' => 'required',
            'phone' => 'required|unique:teachers',
            'email' => 'required|email',
            'address' => 'required',
            'joining_date' => 'required'
        ]);
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $des = 'images/teacher/photo';
            $name = 'photo.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['photo'] = $name;
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $des = 'images/teacher/documents';
            $name = 'document.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['file'] = $name;
        }
        if (!$request->branch_id) {
            $data['branch_id'] = branchName();
        }
        
        User::create([
            'username' => $request->phone,
            'password' => Hash::make($request->phone),
            'branch_id' => $data['branch_id'],
        ]);

        Teacher::create($data);

        // user create 
        
        return redirect()->route('backend.teacher.index')->with('success','Teacher Created Successfylly');
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
        $data = Teacher::find($id);
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
        $teacher = Teacher::find($request->update_id);
        $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'salary' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'joining_date' => 'required'
        ]);
        $data = $request->all();
        $data['photo'] = $teacher->photo;
        $data['file'] = $teacher->file;
        if ($request->hasFile('photo')) {
            $des = 'images/teacher/photo';
            if (File::Exists($des,$teacher->photo)) {
                File::delete($des,$teacher->photo);
            }
            $file = $request->file('photo');
            $name = 'photo.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['photo'] = $name;
        }
        if ($request->hasFile('file')) {
            $des = 'images/teacher/documents';
            if (File::Exists($des,$teacher->file)) {
                File::delete($des,$teacher->file);
            }
            $file = $request->file('file');
            $name = 'document.' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($des,$name);
            $data['file'] = $name;
        }
        
        $teacher->update($data);
        return redirect()->route('backend.teacher.index')->with('success','Teacher Updated Successfully');
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
