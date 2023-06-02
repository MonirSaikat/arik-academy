<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fee\FeeGroup;
use App\Models\Fee\FeeType;
use App\Models\Academic\Classes;
use App\Models\Fee\FeeAllocation;
use App\Models\Fee\FeeAllocationStudent;

class FeeAllocationController extends Controller
{
    //
    public function index()
    {
        $fee_groups = FeeGroup::all();
        $fee_types = FeeType::all();
        $classes = Classes::all();
        return view('components.fee.fee_allocation', compact('fee_groups', 'fee_types', 'classes'));
    }

    public function store(Request $request)
    {

        $allocate = new FeeAllocation();
        $allocate->fee_title = $request->fee_title;
        $allocate->fee_group_id = $request->fee_group_title_id;
        $allocate->fee_type_id = $request->fee_type_id;
        $allocate->allocated_type = $request->allocated_type;

        $allocate->is_active = $request->is_active == 'on' ? true : false;

        if ($request->allocated_type === 'all-student') {
            $allocate->is_all_student = true;
        }
        if ($request->allocated_only_class_id) {
            $allocate->allocated_class_id = $request->allocated_only_class_id;
        }
        if ($request->allocated_class_id) {
            $allocate->allocated_class_id = $request->allocated_class_id;
        }
        if ($request->allocated_group_id) {
            $allocate->allocated_group_id = $request->allocated_group_id;
        }

        $allocate->save();


        if ($request->allocated_type === 'specafic-student') {

            $students = $request->allocated_student_id;
            $lastId = FeeAllocation::orderBy('id', 'desc')->first()->id;

            foreach ($students as $student) {
                $allStu = new FeeAllocationStudent();
                $allStu->fee_allocation_id = $lastId;
                $allStu->fee_allocation_student_id = $student;
                $allStu->save();
            }

            
        }

        return redirect()->back()->with('success', 'Allocation successfull');

    }

    public function getFeeType($id)
    {
        $data = FeeType::where('fee_group_title_id', $id)->get();
        return response()->json($data);
    }

    public function getFeeTypeInfo($id)
    {
        $data = FeeType::find($id);
        return response()->json($data);
    }


}
