@extends('layouts.backend.main')
@section('title','Input Mark')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Exam Mark Input
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Mark Input</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <form action="{{ route('backend.input_mark.create') }}" method="get">
              @csrf
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="session_id">Session</label><span class="ml-2 text-danger">*</span>
                    <select name="session_id" id="session_id" class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                        @foreach (App\Models\Academic\Session::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="class_id">Class</label><span class="ml-2 text-danger">*</span>
                    <select name="class_id" id="class_id" class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                        @foreach (App\Models\Academic\Classes::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="group" style="display: none">
                      <label for="group_id">Group</label><span class="ml-2">*</span>
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group" onchange="getSubject(this.value)">
                          
                      </select>
                      <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="section" style="display: none">
                      <label for="section_id">Section</label><span class="ml-2">*</span>
                      <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section">
                          
                      </select>
                      <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="exam_id">Exam Name</label><span class="ml-2 text-danger">*</span>
                    <select name="exam_id" id="exam_id" class="form-control selectpicker" data-live-search="true" title="Select Class" required>
                        @foreach (App\Models\Examination\Exam::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="subject_id">Subjects</label><span class="ml-2 text-danger">*</span>
                    <select name="subject_id" id="subject_id" class="form-control selectpicker" data-live-search="true" title="Select Class" required>
                        {{-- @foreach (App\Models\Subject\Subject::all() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach --}}
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3">
                      <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
                  </div>
                </div>
            </form>
        </div>
        @if (isset($student))
            
        
        <div class="col-md-12 mt-3">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                <form action="{{ route('backend.input_mark.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$exam_subject -> subject_id}}">
                    <input type="hidden" name="class_id" value="{{$exam_subject -> class_id }}">
                    <input type="hidden" name="exam_setup_id" value="{{$exam_subject -> id }}">
                    <input type="hidden" name="exam_type" value="{{$exam_subject -> exam_id}}">
                    <label for="update">Shoude Update Previous Data</label><input type="checkbox" name="update" id="update" class="ml-3">
                  <table class="table align-items-center table-flush table-hover table-striped mt-3">
                    <thead class="bg-primary text-light">
                      <tr>
                        <th><input type="checkbox" name="all" id="all_permission" class="mr-2"><label for="all_permission">All Check</label></th>
                        
                        <th>Name</th>
                        <th>Roll</th>
                        @foreach ($exam_subject->title_name as $title_name)
                          @php
                              $title = App\Models\Examination\ExamSetupTitle::find($title_name);
                          @endphp
                            <th class="text-center">{{ $title->name }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($student as $key=>$item)
                        @php
                            $skil_row = App\Models\Examination\Mark::where(['student_id'=>$item->id,'exam_setup_id' => $exam_subject->id])->first();
                        @endphp
                        @if (!$skil_row)
                          <tr>
                            <td style="width: 150px">
                              <input type="checkbox" name="student[]" id="sms" value="{{ $item->id }}" class="mr-2">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->roll_number }}</td>
                            
                            @foreach ($exam_subject->mark as $mark)
                              <td>
                                <input type="hidden" name="hidden_mark" id="hidden_mark" value="{{ $mark }}" class="hidden_mark">
                                <input type="number" name="marks[{{$item->id}}][]" placeholder="Mark {{ $mark }}" class="form-control" oninput="markvalid(this.value)">
                              </td>
                            @endforeach
                          </tr>
                        @endif
                      @endforeach
                          
                    </tbody>
                    <tfoot class="bg-light text-dark">
                      <tr>
                        <td colspan="1">
                          <input type="submit" value="Submit" class="btn btn-primary float-left">
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    
</div>

@php
    $subject = App\Models\Academic\Classes::join('subject_assign_classes','subject_assign_classes.class_id','classes.id')
        ->join('subjects','subjects.id','subject_assign_classes.subject_id')
        ->select('subjects.name as name','subjects.id as id','subject_assign_classes.*')
        ->get();

    // $subject = App\Models\Subject\Subject::leftJoin('subject_assign_classes','subject_assign_classes.subject_id','subjects.id')
    //   ->select('subjects.*')
    //   ->get();
@endphp

@endsection

@push('js')

    <script>
        const section = @json($section);
        const group = @json($group);
        const subjects = @json($subject);
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
            }
        }
        function getSubject(id){
          var class_id = $('#class_id').val();
          if(id){
              
            $('#subject_id').html(null);
            $('#subject_id').append('<option value="" hidden>Select Section</option>');
            subjects.filter(function(item){
                if((item.class_id == class_id && item.group_id == id)) {
                    return item;
                }
            }).map(function(item){
              $('#subject_id').append(`<option value="${item.subject_id}">${item.name}</option>`);
            });
            $('#subject_id').val(0);
            $('#subject_id').selectpicker("refresh");
          }
        }

        $('#markValidation').on('click keyup', function () {
          var values = $(this).val();
          alert(values);
        });

        function markvalid(id){
          if (id > mark) {
            alert("You Can't insert more than Mark");
          }
        }

        $("#all_permission").click(function(){
            $('tbody').find(':checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
