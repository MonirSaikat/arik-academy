<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mark sheet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

  

        .page {
            width: 210mm;
            height: 297mm;
            padding: 20px 20px;
            /* border:1px solid black; */
            position: relative;
            margin: auto;
        }
        #footer{
            /* position: absolute; */
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2.5rem; 
            display: flex;
            justify-content: space-between;
            bottom: 0;
            left: 0;
            padding:0px 10px;
        }
        #footer p{
            
            display: inline-block;
            border-top: 1px solid black;
            padding-top: 5px;
            font-size: 13px;
            font-weight: bold;

        }

        .school_title {
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .school_title span {
            font-size: 18px;
            font-weight: 400;
            text-transform: capitalize;
        }

        #page_header {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
        }

        .page_header p {
            font-size: 18px;
        }
        .school_title p{
            font-size: 12px;
        }
        table{
            font-size: 13px;
            border-collapse: collapse;
        }
         table th{
            padding:4px;
        }
         table td{
            padding:4px;
        }

        .footer_one{
            display: flex;
        }
        .final_gpa{
            text-align: center;
            font-weight: bold;
        }
        .row{
            width: 100%;
            display: block;
        }
        .col-md-3{
            width: 25%;
            float: left;
            display: block;
        }
        .col-md-6{
            width: 50%;
            float: left;
            display: block;
        }
        .col-md-4{
            width: 33%;
            float: left;
            display: block;
        }
        .text-center{
            text-align: center;
        }
        .page {
            width: 210mm;
            height: 275mm;
            padding: 20px 20px;
            /* border:1px solid black; */
            position: relative;
            background:#fff4db;
            border: 15px solid transparent;
            padding: 15px;
            border-image: url({{ URL::asset('backend/img/logo/border.png') }}) 30 stretch;
        }
        @page {
                size: A4;
                page-break-before:always;
            }

        @media print {
            html, body .page{
                width: 210mm;
                height: 297mm;
                padding: 20px 20px;
                page-break-before:always;
                overflow: hidden;
                background:#fff4db;
                -webkit-print-color-adjust: exact;
            }
            div.divFooter {
                display:block;
                position: fixed;
                bottom: 60px;
                right: 0px;
            }
        }


        .heading_sector{
            width: 100%;
            display: inline-block;
        }
        .main_table, .main_table td, .main_table th {
            border: 1px solid;
        }

        .main_table {
        width: 100%;
        border-collapse: collapse;
        }  
        div.divFooter {
            display:none;
          }                                         
    </style>
    
</head>

<body>
    
    @foreach ($students as $student)
    <div class="page">
            @php
            $marks = App\Models\Examination\Mark::where('student_id',$student->id)
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->where('subjects.type','!=',3)
                ->select('marks.*','exam_setups.title_name as title','subjects.type as subject_type')
                ->get();
            $constant_gpa = App\Models\Examination\Mark::where('student_id',$student->id)
                ->join('grades','grades.id','marks.grade_id')
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->where('subjects.type','!=',3)
                ->where('subjects.type','!=',2)
                ->select('grades.gpa as constant_gpa')
                ->sum('gpa');
            $optional_gpa = App\Models\Examination\Mark::where('student_id',$student->id)
                ->join('grades','grades.id','marks.grade_id')
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->where('subjects.type',2)
                ->select('grades.gpa as constant_gpa')
                ->sum('gpa');
            
            $optional_subject = App\Models\Examination\Mark::where('student_id',$student->id)
                ->join('grades','grades.id','marks.grade_id')
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->where('subjects.type',2)
                ->select('grades.gpa as constant_gpa')
                ->count();
            if($optional_gpa > 2){
                $optional_gpa -= ($optional_subject * 2);
            }
            $final_gpa = $constant_gpa + $optional_gpa;
            
            $aditional_subjects = App\Models\Examination\Mark::where('student_id',$student->id)
                ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                ->join('subjects','subjects.id','exam_setups.subject_id')
                ->where('subjects.type',3)
                ->select('marks.*','exam_setups.title_name as title')
                ->get();
            $total_subject = 0;
            $total_subject -= $optional_subject;
            $student_fail = false;
            $general_setting = DB::table('general_settings')->where('id',1)->first();
        @endphp
        <div class="heading_sector">
            <div class="" style="width:25%;float:left">
                <img src="{{asset('backend/img/logo/main_logo.png')}}" alt="logo" style="width:70%"/>
            </div>
            <div class=""  style="width:50%;float:left; text-align:center">
                <h3 class="style-font font-weight-bold font-22">{{$general_setting->name}}</h3>
                <h5 class="font-weight-bold">{{$general_setting->address}}</h5>
                <h5 class="font-weight-bold">{{ examination($details['exam_id']) }}</h5>
                <p class="font-weight-bold" style="margin-bottom:0px">School Code : {{$general_setting->code}}</p>
                <p class="font-weight-bold" style="margin-bottom:0px">EIIN No : {{$general_setting->eiin_no}}</p>
            </div>
            <div class=""  style="width:25%;float:left">
                <p class="font-weight-bold float-right" style="margin-bottom:0px">Date : {{ date('d-M-Y') }}</p>
            </div>
        </div>
        <div style="display:inline-block;width:100%">
            <div class="" style="width:40%;float:left">
            
            </div>
            <div class="">
                
            </div>
            <div class="" style="width:25%;float:right">
                <table class="main_table">
                    <tbody>
                        <tr>
                            <th class="p-n">Class Interval</th>
                            <th class="p-n">Letter Grade</th>
                            <th class="p-n">Grade Point</th>
                        </tr>
                        @foreach (App\Models\Examination\Grade::orderBy('gpa','desc')->get() as $examtitle)
                            <tr>
                                <th class="text-center" style="padding: 2px 5px">{{ $examtitle->persent_from }} - {{ $examtitle->persent_upto }}</th>
                                <th class="text-center" style="padding: 2px 5px">{{ $examtitle->name }}</th>
                                <th class="text-center" style="padding: 2px 5px">{{ number_format($examtitle->gpa,2) }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div style="width:100%;display:inline-block">
            <div style="width: 40%; display:inline-block;float:left">
                <table>
                    <tr>
                        <td>Name of Student</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->class->name }}</td>
                    </tr>
                    <tr>
                        <td>Section</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->section->name ?? null }}</td>
                    </tr>
                    <tr>
                        <td>Academic Roll</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->roll_number }}</td>
                    </tr>
                    <tr>
                        <td>Group</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->group->name ?? null }}</td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->student_unique_id }}</td>
                    </tr>
                    <tr>
                        <td>Session</td>
                        <td>:</td>
                        <td class="font-weight-bold">{{ $student->session->name }}</td>
                    </tr>
                </table>
            </div>
            <div style="width: 20%; display:inline-block;float:left">
                <p class="style-font text-center font-18"><u>Academic Transcript</u></p>
            </div>
            <div style="width: 40%; display:inline-block;float:left">

            </div>
        </div>
        <div style="width: 100%;display:inline-block">
            <table class="main_table">
                <thead>
                    @php
                        $titles = examsetuptitle();
                    @endphp
                    <tr class="bg-normal">
                        <th>Subject Name & Code</th>
                        @foreach ($titles as $title)
                            <th>{{ $title->name }}</th>    
                        @endforeach
                        <th>Total</th>
                        <th>Grade</th>
                        <th>GPA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marks as $mark)
                        @php
                            $subject_mark = explode(',', trim($mark -> marks, ','));
                            $exam_titles = explode(',', trim($mark -> title, ','));
                            $array_length = count($exam_titles);
                            $total_subject++;
                            if($mark->subject_type != 2){
                                if($mark->grade->gpa == 0){
                                    $student_fail = true;
                                }
                            }
                        @endphp
                        <tr>
                            <td>{{ $mark->subject->subject->name }}</td>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($titles as $key=>$title)
                                @php
                                    $second = true;
                                    $count2 = 0;
                                @endphp
                                @if ($count < $array_length)
                                    @if ($title->id == $exam_titles[$count])
                                        <td>{{ $subject_mark[$count] == 0 ? 'A':$subject_mark[$count] }}</td>
                                        @php
                                            $count++;
                                        @endphp
                                    @else
                                        @foreach ($exam_titles as $exam_title)
                                            
                                            @if ($title->id == $exam_title)
                                                <td>{{ $subject_mark[$count2] == 0 ? 'A':$subject_mark[$count2] }}</td>
                                                @php
                                                    $second = false;
                                                @endphp
                                            @endif
                                            @php
                                                $count2++;
                                            @endphp
                                        @endforeach
                                        @if ($second == true)
                                            <td></td>
                                        @endif
                                    @endif
                                @else
                                <td></td>
                                @endif

                            @endforeach
                            <td>{{ $mark->total_marks }}</td>
                            <td>{{ $mark->grade->name }}</td>
                            <td>{{ number_format($mark->grade->gpa,2) }}</td>
                        </tr>
                    @endforeach
                    @php
                        $final_result = $final_gpa / ($total_subject <= 0 ? 1: $total_subject);
                    @endphp
                    <tr>
                        <td colspan="9" class="text-center font-weight-bold"><span class="style-font">GPA :</span>
                        @if ($student_fail == true)
                            0.00
                        @elseif($final_result > 5)
                            5.00
                        @else
                            {{number_format($final_result , 2)}}
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">Comment </td>
                    </tr>
                    <tr class="bg-normal text-dark">
                        <td colspan="9" class="text-center font-weight-bold">Additional Subject </td>
                    </tr>
                    @foreach ($aditional_subjects as $mark)
                        @php
                            $subject_mark = explode(',', trim($mark -> marks, ','));
                            $exam_titles = explode(',', trim($mark -> title, ','));
                            $array_length = count($exam_titles);
                        @endphp
                        <tr>
                            <td>{{ $mark->subject->subject->name }}</td>
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($titles as $key=>$title)
                                @php
                                    $second = true;
                                    $count2 = 0;
                                @endphp
                                @if ($count < $array_length)
                                    @if ($title->id == $exam_titles[$count])
                                        <td>{{ $subject_mark[$count] == 0 ? 'A':$subject_mark[$count] }}</td>
                                        @php
                                            $count++;
                                        @endphp
                                    @else
                                        @foreach ($exam_titles as $exam_title)
                                            
                                            @if ($title->id == $exam_title)
                                                <td>{{ $subject_mark[$count2] == 0 ? 'A':$subject_mark[$count2] }}</td>
                                                @php
                                                    $second = false;
                                                @endphp
                                            @endif
                                            @php
                                                $count2++;
                                            @endphp
                                        @endforeach
                                        @if ($second == true)
                                            <td></td>
                                        @endif
                                    @endif
                                @else
                                <td></td>
                                @endif

                            @endforeach
                            <td>{{ $mark->total_marks }}</td>
                            <td>{{ $mark->grade->name }}</td>
                            <td>{{ number_format($mark->grade->gpa,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="divFooter" style="width: 100%;display:inline-block">
            <div style="float: left;width:33%;text-align:center">
                <hr style="width: 50%;margin:auto">
                <h6 class="font-weight-bold">Head Teacher</h6>
            </div>
            <div style="float: left;width:33%;text-align:center">
                <hr style="width: 50%;margin:auto">
                <h6 class="font-weight-bold">Class Teacher</h6>
            </div>
            <div style="float: left;width:33%;text-align:center">
                <hr style="width: 50%;margin:auto">
                <h6 class="font-weight-bold">Guardian</h6>
            </div>
        </div>
    </div> 
    
    @endforeach
</body>

</html>