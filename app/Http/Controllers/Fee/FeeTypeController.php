<?php

namespace App\Http\Controllers\Fee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fee\FeeGroup;
use App\Models\Fee\FeeSchedule;
use App\Models\Fee\FeeType;
use App\Models\Fee\FeeDate;

class FeeTypeController extends Controller
{
    //
    public function index()
    {
        $groups = FeeGroup::orderBy('group_title','asc')->get();
        $schedule = FeeSchedule::all();
        return view('components.fee.fee_type',compact('groups','schedule'));
    }

    public function store(Request $request)
    {

        $fee = new FeeType();
        $fee->fee_type_title = $request->fee_type_title;
        $fee->fee_group_title_id = $request->fee_group_title_id;
        $fee->fee_code = $request->fee_code;
        $fee->fee_description = $request->fee_description;
        $fee->fee_amount = $request->fee_amount;
        $fee->save();

        $id = FeeType::orderBy('id','desc')->first()->id;

        if($request->fee_schedule == 1)
        {
            $d = new FeeDate();
            $d->fee_type_id = $id;
            $d->start_date = $request->start_date;
            $d->end_date = $request->end_date;
            $d->save();
        }

        if($request->fee_schedule > 1)
        {
            $dates = $request->start_date;

            foreach ($dates as $key => $start) {

                $d = new FeeDate();
                $d->fee_type_id = $id;
                $d->start_date = $start;
                $d->end_date = $request->end_date[$key];
                $d->save();
            }
        }

        return redirect()->route('backend.fee.type.index')->with('success','Fee type created');
    }
}
