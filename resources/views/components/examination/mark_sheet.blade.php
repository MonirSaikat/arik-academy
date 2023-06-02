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
            <form action="{{ route('backend.mark_sheet.index') }}" method="GET" target="_blank">
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
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group" onchange="getStudent()">
                          
                      </select>
                      <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="section" style="display: none">
                      <label for="section_id">Section</label><span class="ml-2">*</span>
                      <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section"  onchange="getStudent()">
                          
                      </select>
                      <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="Student">
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

        function getStudent(){
            var class_id = $('#class_id').val();
            var group_id = $('#group_id').val() == '' ? null:$('#group_id').val();
            var section_id = $('#section_id').val() == ' ' ? null:$('#section_id').val();
                $('#student_id').html(null);
                $('#student_id').append('<option value="" hidden>Select Section</option>');
                student.filter(function(item){
                    if((item.class_id == class_id && item.group_id == group_id && item.section_id == section_id)) {
                        return item;
                    }
                }).map(function(item){
                    $('#student_id').append(`<option value="${item.id}">${item.name}[${item.roll_number}]</option>`);
                });
                $('#student_id').val(0);
                $('#student_id').selectpicker("refresh");
        }
        
    </script>
@endpush
