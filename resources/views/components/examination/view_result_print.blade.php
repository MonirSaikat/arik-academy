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
            height: 275mm;
            padding: 20px 20px;
            /* border:1px solid black; */
            position: relative;
            background:#fff4db;
            border: 15px solid transparent;
            padding: 15px;
            border-image: url({{ URL::asset('backend/img/logo/border.png') }}) 30 stretch;
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

        @page {
                size: A4;
                margin: 20px;
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
        }}
    </style>
</head>

<body>

    @foreach($students as $student)

            @php
                $marks = App\Models\Examination\Mark::where('student_id',$student->id)
                    ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                    ->join('subjects','subjects.id','exam_setups.subject_id')
                    ->where('subjects.type','!=',3)
                    ->select('marks.*','exam_setups.title_name as title','exam_setups.exam_mark as exam_mark','subjects.type as subject_type')
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
                    $titles = examsetuptitle();
            @endphp
    <div class="page">
        <h3 class="school_title">Afanullah High Schoool </br> <span>Mahigonj, Rangpur</span></h3>
        <div id="page_header">
            <div class="student_image">
                
            </div>
            <div class="school_title">
                    <img src="{{asset('backend/img/logo/main_logo.png')}}"  style="height: 100px; width:100px; object-fit:cover" alt="">
                    <p>academic transcription</p>
            </div>
            <div class="mark_table">
                <table border="1">
                    <thead>
                        <th>Grade</th>
                        <th>Marks(%)</th>
                        <th>Gpa</th>
                    </thead>
                    <tbody>
                        @foreach(grade() as $grade)
                        <tr>
                            <td>{{$grade->name}}</td>
                            <td>{{$grade->persent_from}}-{{$grade->persent_upto}}</td>
                            <td>{{number_format($grade->gpa,2)}}</td>
                        </tr>
                        @endforeach 
                        

                    </tbody>
                </table>
            </div>
        </div>

        <div class="student_information">
            <table style="width: 100%; margin:5px 0px" border="1">
                    <tr>
                        <td>Student Name</td>
                        <td colspan="3">{{$student->name}}</td>
                        <td>Class</td>
                        <td>{{$student->class->name}}</td>
                    </tr>
                    <tr>
                        <td>Student Id</td>
                        <td>{{$student->student_unique_id}}</td>
                        <td>Examinition</td>
                        <td>{{examination($details['exam_id'])}}</td>
                        <td>Roll Number</td>
                        <td>{{$student->roll_number}}</td>
                    </tr>
                    <tr>
                        <td colspan="">Section</td>
                        <td colspan="2">{{$student->section->name ?? 'N/A'}}</td>
                        <td>Group</td>
                        <td colspan="2">{{$student->group->name ?? 'N/A'}}</td>
                        
                    </tr>
            </table>
        </div>


        <div class="result_sheet">
            <table style="width: 100%; margin:8px 0px;" border="1">
                    <thead>
                            <th style="width:25%">Name</th>
                            <th>Full Marks</th>
                            @foreach ($titles as $title)
                                <th>{{ $title->name }}</th>    
                            @endforeach
                            <th>Total_marks</th>
                            <th>Grade</th>
                            <th>GPA</th>
                    </thead>
                    <tbody>
                        
                        
                        
                        @foreach($marks as $mark)
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
                            <td>{{$mark->subject->subject->name}}</td>
                            <td>{{$mark->exam_mark}}</td>
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
                                            @php
                                                $count++;
                                            @endphp
                                        @endif
                                    @else
                                        @foreach ($exam_titles as $exam_title)
                                            
                                            @if ($title->id == $exam_title)
                                                @if($count2 < count($subject_mark))
                                                    <td>{{ $subject_mark[$count2] == 0 ? 'A':$subject_mark[$count2] }}</td>
                                                    @php
                                                        $second = false;
                                                    @endphp
                                                @endif
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
                            <td colspan="10" class="final_gpa"><span class="style-font">GPA :</span>
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
                            <td colspan="10" class="text-center font-weight-bold">Additional Subject </td>
                        </tr>
                        @foreach($aditional_subjects as $mark)
                            @php
                                $subject_mark = explode(',', trim($mark -> marks, ','));
                                $exam_titles = explode(',', trim($mark -> title, ','));
                                $array_length = count($exam_titles);
                            @endphp
                        <tr>
                            <td>{{$mark->subject->subject->name}}</td>
                            <td>{{$mark->exam_mark}}</td>
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
                    
                    
                    {{-- <tfoot>
                            <tr>
                                @if($student->class_code == 9)
                                    <td></td>
                                    <td></td>
                                @elseif($student->class_code == 10)
                                    <td></td>
                                @endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- start here  -->
                                <td style="text-align:right">Total Marks</td>
                                <td>{{$total_marks}}</td>
                                <td>Total GP</td>
                                @php 
                                        $avg_gpa = $total_gpa_point / $total_subject_count;
                                        if($avg_gpa >= 5){
                                            $gpa = '5.00';
                                        }else{
                                            $gpa = $avg_gpa;
                                        }
                                @endphp
                                <td colspan="2">
                                        {{$total_gpa_point}}
                                    </td>
                            </tr>
                            <tr>
                                 @if($student->class_code == 9)
                                    <td></td>
                                    <td></td>
                                @elseif($student->class_code == 10)
                                    <td></td>
                                @endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- start here  -->
                                <td style="text-align:right">GPA</td>
                                
                                @if(!$failed)
                                
                                <td>
                                        {{round($gpa,2)}}
                                </td>
                                @else
                                
                                <td>
                                    Fail
                                </td>
                                @endif 

                             
                                <td>Working days : </td>
                            </tr>
                            <tr>
                                 @if($student->class_code == 9)
                                    <td></td>
                                    <td></td>
                                @elseif($student->class_code == 10)
                                    <td></td>
                                @endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- start here  -->
                                <td style="text-align:right">Position in section</td>
                                <td></td>
                                <td>PRESENCE: </td>
                            </tr>
                            <tr>
                                @if($student->class_code == 9)
                                    <td></td>
                                    <td></td>
                                @elseif($student->class_code == 10)
                                    <td></td>
                                @endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <!-- start here  -->
                                <td style="text-align:right">Position in shift</td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                    </tfoot> --}}
            </table>
        </div>
        
         
        
        
    
  
        {{-- <div class="footer_one">
            <div class="footer_one_part" style="width: 48%;">
                <table style="width: 100%;" border="1">
                        <thead>
                            <th colspan="4">Student Behaviour</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Execelnt</td>
                                <td></td>
                                <td>Very Good</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Improvment Needed</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="footer_one_part" style="width: 48%; margin-left:30px;">
                <table style="width: 100%;" border="1" >
                        <thead>
                            <th colspan="4">Co-curricular Activities</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Cultural Activity</td>
                                <td></td>
                                <td>Debate</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Red Crescent</td>
                                <td></td>
                                <td>BNCC</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">Others</td>
                            </tr>
                        </tbody>
                </table>
            </div>
        </div> --}}
        
        
       

        {{-- <div class="remarks">
            <table style="width:100%; margin:4px 0px;" border="1">
                    <thead>
                        <th colspan="8" style="text-align: center;">REMARKS</th>
                    </thead>
                    <tbody>
                            <tr>
                                <td></td>
                                <td>Excellent</td>
                                <td></td>
                                <td>Very good</td>
                                <td></td>
                                <td>good</td>
                                <td></td>
                                <td>Fair</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>Poor</td>
                                <td></td>
                                <td>Very poor</td>
                                <td></td>
                                <td>Fail</td>
                                <td></td>
                                <td></td>
                            </tr>
                    </tbody>
            </table>
        </div> --}}

        <footer id="footer">
            <p>GUARDIAN'S SIGNATURE</p>
            <p>CLASS TEACHER SIGNATURE</p>
            <p>HEAD TEACHER SIGNATURE</p>
        </footer>
    </div>
    @endforeach


    
</body>

</html>