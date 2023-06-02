@extends('layouts.backend.main')
@section('title','Mark Sheet')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Mark Sheet
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Mark Sheet</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <form action="{{ route('backend.view_mark.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="session_id">Session</label><span class="ml-2">*</span>
                        <select name="session_id" id="session_id" required class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                            @foreach (App\Models\Academic\Session::where('is_active',1)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="exam_id">Exam</label><span class="ml-2">*</span>
                        <select name="exam_id" id="exam_id" required class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
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
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group">
                          
                      </select>
                      <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="section" style="display: none">
                      <label for="section_id">Section</label><span class="ml-2">*</span>
                      <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section">
                          
                      </select>
                      <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="type">
                      <label for="type">Select Type</label><span class="ml-2">*</span>
                      <select name="type" id="type" required class="form-control selectpicker" data-live-search="true" title="Select Type" onchange="subjectStudent(this.value)">
                          <option value="student">Student</option>
                          <option value="subject">Subject</option>
                      </select>
                      <span class="text-light">@error('type'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="Subject" style="display: none">
                    <label for="Subject_id">Subject</label><span class="ml-2">*</span>
                    <select name="subject_id" id="subject_id" class="form-control selectpicker" data-live-search="true" title="Select Subject">
                        @foreach (App\Models\Subject\Subject::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('subject_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="Student" style="display: none">
                    <label for="Student_id">Student</label><span class="ml-2">*</span>
                    <select name="student_id" id="student_id" class="form-control selectpicker" data-live-search="true" title="Select Student">
                        
                    </select>
                    <span class="text-light">@error('subject_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3">
                      <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
                  </div>
                </div>
            </form>
        </div>
        @if (isset($student))
            <div class="col-md-12 mt-3">
                <div class="card py-5">
                    <div class="card-header">
                        <u class="d-block text-center"><b><h4>Result Details</h4></b></u>
                        <table>
                            <tr>
                                <td>Students Name </td>
                                <td style="width: 50px" class="text-center">:</td>
                                <td>{{ $student->name }}</td>
                            </tr>
                            <tr>
                                <td>Class </td>
                                <td class="text-center">:</td>
                                <td>{{ $student->class->name }}</td>
                            </tr>
                            <tr>
                                <td>Session </td>
                                <td class="text-center">:</td>
                                <td>{{ $student->session->name }}</td>
                            </tr>
                            <tr>
                                <td>Roll </td>
                                <td class="text-center">:</td>
                                <td>{{ $student->roll_number }}</td>
                            </tr>
                            <tr>
                                <td>ID </td>
                                <td class="text-center">:</td>
                                <td>{{ $student->student_unique_id }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            @php
                                $marks = App\Models\Examination\Mark::where('student_id',$student->id)
                                    ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                                    ->select('marks.*','exam_setups.title_name as title')
                                    ->get();
                                $titles = App\Models\Examination\ExamSetupTitle::all();
                                
                            @endphp
                            <tr>
                                <th>Subject Name</th>
                                @foreach ($titles as $title_name)
                                    <th class="">{{ $title_name->name }}</th>
                                @endforeach
                                <th>Total</th>
                                <th>Grade</th>
                                <th>GPA</th>
                            </tr>
                            @foreach ($marks as $mark)
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
                        </table>
                    </div>
                </div>
            </div>
        @endif
        @if (isset($students))
            <div class="col-md-12 mt-3">
                <div class="card py-5">
                    <div class="card-header m-auto">
                        <h4 class="text-dark font-weight-bold">{{ $subject->name }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            @foreach ($students as $student)
                                @php
                                    $marks = App\Models\Examination\Mark::where('student_id',$student->id)
                                    ->join('exam_setups','exam_setups.id','marks.exam_setup_id')
                                    ->where('exam_setups.subject_id',$subject->id)
                                    ->select('marks.*','exam_setups.title_name as title','exam_setups.is_converted as is_converted')
                                    ->first();
                                    $title = explode(',',$marks -> title);
                                    $subject_mark = explode(',', trim($marks -> marks, ','));
                                @endphp
                                <tr>
                                    <td class="text-dark font-weight-bold">{{ $student->name }}</td>
                                    <td>
                                        <div class="row py-2" style="border-bottom: 1px solid #ddd">
                                            <div class="col-md-4 text-center">
                                                <span class="text-dark font-weight-bold">Title</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-dark font-weight-bold">Marks</span>
                                            </div>
                                            
                                            @if ($marks->is_converted == true)
                                            <div class="col-md-5 text-center">
                                                <span class="text-dark font-weight-bold">Converted Mark</span>
                                            </div>
                                            @endif
                                            
                                        </div>
                                        @foreach ($title as $key=>$title_name)
                                            @php
                                                $title = App\Models\Examination\ExamSetupTitle::find($title_name);
                                            @endphp
                                        <div class="row py-2" style="border-bottom: 1px solid #ddd">
                                            <div class="col-md-4 text-center">
                                                <span class="text-success">{{$title->name}}</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span class="text-success">{{$subject_mark[$key] == 0 ? 'A':$subject_mark[$key]}}</span>
                                            </div>
                                            @if ($marks->is_converted == true && $key < count($subject_mark)-1)
                                            <div class="col-md-5 text-center">
                                                <span class="text-success">{{ intval($subject_mark[$key]) * 80 / 100 }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div>
                                            <span class="text-dark font-weight-bold">Total</span>
                                            <hr>
                                            <span class="text-success">{{ $marks->total_marks }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="text-dark font-weight-bold">Grade</span>
                                            <hr>
                                            <span class="text-success">{{ $marks->grade->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="text-dark font-weight-bold">GPA</span>
                                            <hr>
                                            <span class="text-success">{{ number_format($marks->grade->gpa ,2)}}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
</div>

@php
    $students_all = App\Models\Student\Student::orderBy('roll_number')->get();
@endphp

@endsection

@push('js')

    <script>
       
        const section = @json($section);
        const group = @json($group);
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
                }else{
                    $('#group').css('display','none');
                }
                $('#group_id').val(0);
                $('#group_id').selectpicker("refresh");
            }
        }

        function subjectStudent(id){
            var class_id = $('#class_id').val();
            if (id == "student") {
                $('#Student').css('display','block');
                $('#Subject').css('display','none');

                $('#student_id').html(null);
                $('#student_id').append('<option value="" hidden>Select Student</option>');
                student.filter(function(item){
                    if((item.class_id == class_id)) {
                        return item;
                    }
                }).map(function(item){
                    $('#student_id').append(`<option value="${item.id}">${item.name}</option>`);
                });
                $('#student_id').val(0);
                $('#student_id').selectpicker("refresh");

            }else{
                $('#student_id').html(null);
                $('#Subject').css('display','block');
                $('#Student').css('display','none');
            }
        }
        
    </script>
@endpush
