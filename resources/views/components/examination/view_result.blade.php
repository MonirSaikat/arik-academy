@extends('layouts.backend.main')
@section('title','Mark Sheet')
@section('content')
<style>
    .style-font{
        font-family: 'Sofia';
    }
    .font-22{
        font-size: 32px;
    }
    .p-n{
        padding: 0 !important;
        text-align: center
    }
    .font-18{
        font-size:22px;
        color:black;
    }
    .hr-margin{
        margin: 10px auto;
    }
    .bg-normal{
        background:#ddd;
    }
    
    @page {
        size: A4;
        margin: 20px;
        page-break-before:always;
    }

    @media print {   
        #p_logo {
            width: 100px;
        }
       
        body * {
            visibility: hidden;
            margin:0;
            padding:0;
        }
        
        #print_div *{
            visibility: visible;
            width: 210mm;
            height: 297mm;
            padding: 20px 20px;
            page-break-before:always;
            overflow: hidden;
        }
        
        td{
            padding:1px !important;
            font-size:14px;
        }
        
        #print_div {
            /*position: absolute;*/
            /*left: 0;*/
            /*top: 0;*/
        }
        
        .footer-div {
            page-break-after: always;
        }
        .page_break{
            background:#fff4db;
            -webkit-print-color-adjust: exact;
        }
        td{
            font-size:17px !important;
        }
    }
    .ionicon{
        width:25px;
        height:auto;
    }
    .tm_invoice_btn{
        float:right;
    }
    table tr td{
        color:black;
    }
    table.table-bordered{
        border:1px solid black;
        margin-top:20px;
        font-size:14px !important;
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
        color: black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
        padding: 5px 1.5rem !important;
    }
    .page_break{
        background:#fff4db;
        border: 15px solid transparent;
        padding: 15px;
        border-image: url({{ URL::asset('public/backend/img/logo/border.png') }}) 30 stretch;
    }
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Result Sheet
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Mark Sheet</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <form action="{{ route('backend.view_result.index') }}" method="GET" target="_blank">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="session_id">Session</label><span class="ml-2">*</span>
                        <select name="session_id" id="session_id" required class="form-control selectpicker" data-live-search="true" title="Select Class"">
                            @foreach (App\Models\Academic\Session::where('is_active',1)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="exam_id">Exam</label><span class="ml-2">*</span>
                        <select name="exam_id" id="exam_id" required class="form-control selectpicker" data-live-search="true" title="Select Class">
                            @foreach (App\Models\Examination\Exam::where('is_active',1)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                    </div>
                  <div class="col-md-3 mb-3">
                    <label for="class_id">Class</label><span class="ml-2">*</span>
                    <select name="class_id" id="class_id" required class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                        @foreach (App\Models\Academic\Classes::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="group" style="display: none">
                      <label for="group_id">Group</label><span class="ml-2">*</span>
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group" onchange="getStudent()">
                          
                      </select>
                      <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="section" style="display: none">
                      <label for="section_id">Section</label><span class="ml-2">*</span>
                      <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section" onchange="getStudent()">
                          
                      </select>
                      <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="Student">
                    <label for="Student_id">Student</label><span class="ml-2">*</span>
                    <select name="student_id" id="student_id" class="form-control selectpicker" data-live-search="true" title="Select Student">
                        
                    </select>
                  </div>
                  <div class="col-md-3">
                      <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
                  </div>
                </div>
            </form>
        </div>
        <div class="tm_invoice_btns tm_hide_print">
            <a href="#" onclick="javascript:window.print()" class="tm_invoice_btn tm_color1">
              <span class="tm_btn_icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
              </span>
              <span class="tm_btn_text">Print</span>
            </a>
        </div>
        @if (isset($student))
            <div class="col-md-12" id="print_div">
                <div class="card">
                    
                    <div class="card-body">
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
                        @endphp
                        <div class="row py-5 mb-3 page_break">
                            <div class="col-md-3">
                                <img src="{{asset('/uploads/logos/logo_1684308996.jpg')}}" alt="logo" style="width:70%" id="p_logo" />
                            </div>
                            <div class="col-md-6 text-center">
                                <h3 class="style-font font-weight-bold font-22">{{ settings()->school_name }}</h3>
                                <h5 class="font-weight-bold">{{ settings()->address }}</h5>
                                <h5 class="font-weight-bold">{{ examination($details['exam_id']) }}</h5>
                                <p class="font-weight-bold" style="margin-bottom:0px">School Code : 5256</p>
                                <p class="font-weight-bold" style="margin-bottom:0px">EIIN No : 127365</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold float-right" style="margin-bottom:0px">Date : {{ date('d-M-Y') }}</p>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-3">
                                <table class="table table-bordered">
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
                            <div class="col-md-4">
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
                            <div class="col-md-4" style="margin-top:-60px">
                                <p class="style-font text-center font-18"><u>Academic Transcript</u></p>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-12 my-3">
                                <table class="table table-bordered">
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
                            <div class="col-md-4 text-center mt-3">
                                <hr class="w-50 hr-margin" style="color:black">
                                <h6 class="font-weight-bold">Head Teacher</h6>
                            </div>
                            <div class="col-md-4 text-center mt-3">
                                <hr class="w-50 hr-margin">
                                <h6 class="font-weight-bold">Class Teacher</h6>
                            </div>
                            <div class="col-md-4 text-center mt-3">
                                <hr class="w-50 hr-margin">
                                <h6 class="font-weight-bold">Guardian</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (isset($students))
            <div class="col-md-12 mt-3" id="print_div">
                <div class="card py-3">
                    <div class="card-body">
                    @foreach ($students as $student)
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
                        @endphp
                        @if($marks)
                        <div class="row py-5 mb-3 page_break">
                            <div class="col-md-3">
                                <img src="{{asset('public/backend/img/logo/main_logo.png')}}" alt="logo" style="width:70%"/>
                            </div>
                            <div class="col-md-6 text-center">
                                <h3 class="style-font font-weight-bold font-22">Afanullah High School</h3>
                                <h5 class="font-weight-bold">Mahigonj, Rangpur, Bangladesh</h5>
                                <h5 class="font-weight-bold">{{ examination($details['exam_id']) }}</h5>
                                <p class="font-weight-bold" style="margin-bottom:0px">School Code : 5256</p>
                                <p class="font-weight-bold" style="margin-bottom:0px">EIIN No : 127365</p>
                            </div>
                            <div class="col-md-3">
                                <p class="font-weight-bold float-right" style="margin-bottom:0px">Date : {{ date('d-M-Y') }}</p>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="p-n">Class Interval</th>
                                            <th class="p-n">Letter Grade</th>
                                            <th class="p-n">Grade Point</th>
                                        </tr>
                                        @foreach (App\Models\Examination\Grade::orderBy('id','desc')->get() as $examtitle)
                                            <tr>
                                                <th class="text-center" style="padding: 2px 5px">{{ $examtitle->persent_from }} - {{ $examtitle->persent_upto }}</th>
                                                <th class="text-center" style="padding: 2px 5px">{{ $examtitle->name }}</th>
                                                <th class="text-center" style="padding: 2px 5px">{{ number_format($examtitle->gpa,2) }}</th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4" style="margin-top:-60px">
                                <p class="style-font text-center font-18"><u>Academic Transcript</u></p>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                            <div class="col-md-12 my-3">
                                <table class="table table-bordered">
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
                                                            @if($count < count($subject_mark))
                                                            <td>{{ $subject_mark[$count] == 0 ? 'A':$subject_mark[$count] }}</td>
                                                            @endif
                                                            @php
                                                            if($count > 1){
                                                            }
                                                                $count++;
                                                            @endphp
                                                        @else
                                                            @foreach ($exam_titles as $exam_title)
                                                                
                                                                @if ($title->id == $exam_title)
                                                                    @if($count2 < count($subject_mark))
                                                                    <td>{{ $subject_mark[$count2] == 0 ? 'A':$subject_mark[$count2] }}</td>
                                                                    @endif
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
                                            <td colspan="9" class="text-center">Additional Subject </td>
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
                            <div class="col-md-4 text-center mt-5">
                                <hr class="w-50 hr-margin">
                                <h6 class="font-weight-bold">Head Teacher</h6>
                            </div>
                            <div class="col-md-4 text-center mt-5">
                                <hr class="w-50 hr-margin">
                                <h6 class="font-weight-bold">Class Teacher</h6>
                            </div>
                            <div class="col-md-4 text-center mt-5 footer-div">
                                <hr class="w-50 hr-margin">
                                <h6 class="font-weight-bold">Guardian</h6>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    
</div>

@php
    $students_all = App\Models\Student\Student::orderBy('roll_number')->get();
    $subject = App\Models\Academic\Classes::join('subject_assign_classes','subject_assign_classes.class_id','classes.id')
        ->join('subjects','subjects.id','subject_assign_classes.subject_id')
        ->select('subjects.name as name','subjects.id as id','subject_assign_classes.*')
        ->get();
@endphp

@endsection

@push('js')

    <script>
       
        const section = @json($section);
        const group = @json($group);
        const subjects = @json($subject);
        const student = @json($students_all);

        function getSection(id){
            if(id){
                $('#section_id').html(null);
                $('#section_id').append('<option value="" hidden>Select Section</option>');
                var i = 0;
                section.filter(function(item){
                    if((item.class_id == id)) {
                        return item;
                        
                    }
                }).map(function(item){
                    $('#section_id').append(`<option value="${item.id}">${item.name}</option>`);
                    i++;
                });
                
                if (i != 0) {
                    $('#section').css('display','block');
                }else{
                    $('#section').css('display','none');
                }
                $('#section_id').val(0);
                $('#section_id').selectpicker("refresh");


                $('#group_id').html(null);
                $('#group_id').append('<option value="" hidden>Select Group</option>');
                var j = 0;
                group.filter(function(item){
                    if((item.class_id == id)) {
                        return item;
                    }
                }).map(function(item){
                    $('#group_id').append(`<option value="${item.id}">${item.name}</option>`);
                    j++;
                });
                if (j != 0) {
                    $('#group').css('display','block');
                    $('#subject_id').html(null);
                    $('#subject_id').selectpicker("refresh");
                }else{
                    $('#group').css('display','none');
                    $('#subject_id').html(null);
                    $('#subject_id').append('<option value="" hidden>Select Section</option>');
                    subjects.filter(function(item){
                        if((item.class_id == id)) {
                            return item;
                        }
                    }).map(function(item){
                      $('#subject_id').append(`<option value="${item.subject_id}">${item.name}</option>`);
                    });
                    $('#subject_id').val(0);
                    $('#subject_id').selectpicker("refresh");
                }
                $('#group_id').val(0);
                $('#group_id').selectpicker("refresh");

                getStudent();
            }
        }

        function getStudent(){
            var class_id = $('#class_id').val();
            var group_id = $('#group_id').val() == '' ? null :$('#group_id').val();
            var section_id = $('#section_id').val() == '' ? null :$('#section_id').val();
            if (class_id) {

                $('#student_id').html(null);
                $('#student_id').append('<option value="" hidden>Select Student</option>');
                student.filter(function(item){
                    if((item.class_id == class_id && item.group_id == group_id && item.section_id == section_id)) {
                        return item;
                    }
                }).map(function(item){
                    $('#student_id').append(`<option value="${item.id}">${item.name}</option>`);
                });
                $('#student_id').val(0);
                $('#student_id').selectpicker("refresh");

            }
        }
        
    </script>
@endpush
