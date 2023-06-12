<?php

namespace App\Http\Controllers;

use App\Models\Academic\Group;
use App\Models\Academic\Section;
use App\Models\Homework;
use App\Models\Subject\Subject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
            ->select('class_section_assigns.*', 'sections.*')
            ->get();
        $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
            ->select('class_assign_groups.*', 'groups.*')
            ->get();

        $homework = Homework::when(request()->class_id, function ($q) {
            $q->where('class_id', request()->class_id);
        })->when(request()->section_id, function ($q) {
            $q->where('section_id', request()->section_id);
        })->when(request()->group_id, function ($q) {
            $q->where('group_id', request()->group_id);
        })
            ->orderBy('id', 'desc')->get();

        $active = $homework->where('is_active', 1);
        foreach ($active as $key => $value) {
            if ($value->submission_date < date('Y-m-d')) {
                $value->is_active = false;
                $value->save();
            }
        }

        return view('components.home_work.index', compact('homework', 'section', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
            ->select('class_section_assigns.*', 'sections.*')
            ->get();
        $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
            ->select('class_assign_groups.*', 'groups.*')
            ->get();
        return view('components.home_work.create', compact('section', 'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $des = "upload/homework";
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move($des, $name);
                $data['file'] = $name;
            }
            $data['user_id'] = auth()->user()->id;
            Homework::create($data);

            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
        return redirect()->route('backend.home_work.index')->with('success', 'Homework Created Successfully');
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
        $section = Section::join('class_section_assigns', 'class_section_assigns.section_id', 'sections.id')
            ->select('class_section_assigns.*', 'sections.*')
            ->get();
        $group = Group::join('class_assign_groups', 'class_assign_groups.group_id', 'groups.id')
            ->select('class_assign_groups.*', 'groups.*')
            ->get();
        $homework = Homework::findOrFail($id);
        $subject = Subject::join('subject_assign_classes', 'subject_assign_classes.subject_id', 'subjects.id')
            ->where('subject_assign_classes.class_id',$homework->class_id)
            ->select('subjects.*')
            ->get();
        return view('components.home_work.edit', compact('section', 'group', 'homework', 'subject'));
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
        $homework = Homework::findOrFail($id);
        $data = $request->all();
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $des = "upload/homework";
                $name = time() . '.' . $file->getClientOriginalExtension();
                $file->move($des, $name);
                $data['file'] = $name;
            }
            $data['user_id'] = auth()->user()->id;
            $homework->update($data);

            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
        return redirect()->route('backend.home_work.index')->with('success', 'Homework Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Homework::findOrFail($id)->delete();
        return redirect()->route('backend.home_work.index')->with('success', 'Homework Deleted Successfully');
    }

    function fileOpen($file)
    {
        $path = public_path('/upload/homework/' . $file);

        if (file_exists($path)) {
            return response()->file($path);
        } else {
            abort(404, 'File not found');
        }
    }
}
