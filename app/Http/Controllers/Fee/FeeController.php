<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fee\FeeGroup;

class FeeController extends Controller
{
    //

    public function index()
    {
        $data = FeeGroup::orderBy('id','desc')->get();
        return view('components.fee.fee_group',compact('data'));
    }

    public function store(Request $request)
    {
        FeeGroup::create($request->all());
        return redirect()->route('backend.fee.group.index')->with('success','Fee group created');
    }
}
