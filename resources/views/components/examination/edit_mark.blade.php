@extends('layouts.backend.main')
@section('title','Edit Mark')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Edit Mark
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Edit Mark</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <form action="{{ route('backend.edit_mark.seachStudent') }}" method="get">
              @csrf
                <div class="row">
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
                      <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group" onchange="getStudents()">
                          
                      </select>
                      <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3" id="section" style="display: none">
                      <label for="section_id">Section</label><span class="ml-2">*</span>
                      <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section" onchange="getStudents()">
                          
                      </select>
                      <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3 mb-3">
                      <label for="student_id">Student</label><span class="ml-2">*</span>
                      <select name="student_id" id="student_id" class="form-control selectpicker" data-live-search="true" title="Select Student" required>
                          
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
                  <div class="col-md-3">
                      <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
                  </div>
                </div>
            </form>
        </div>
        @if(isset($marks) && count($marks) > 0)
          <div class="container mt-4">
              <div class="card card-body">
                  <div class="row">
                      <div class="col-md-12 mx-auto">
                          
                          <form action="{{ route('backend.edit_mark.updateMark',$student->id) }}" method="POST">
                              @csrf 
                              
                              <div class="responsive-table mt-3">
                                  <table class="table m-0 table-bordered">
                                      <thead>
                                          <th>Sl</th>
                                          <th>Subject</th> 
                                          @foreach($titles as $title)
                                            <th>{{$title->name}}</th>
                                          @endforeach
                                      </thead>

                                      <tbody>
                                          @foreach($marks as $key=>$mark)  
                                              @php 
                                                  $marks = explode(',', trim($mark -> marks, ','));
                                                  $exam_titles = explode(',', trim($mark -> titles, ','));
                                              @endphp
                                              <input type="hidden" name="subject_id[]" value="{{$mark->subject_id}}" />
                                          
                                              <tr>
                                                  <td>{{$key + 1}}</td>
                                                  <td>{{$mark -> subject_name}}</td> 
                                                  {{-- @foreach($titles as $key=> $title)
                                                  <td> 
                                                      @if(array_key_exists($key, $marks))
                                                          <input class="form-control form-control-sm" name="marks[{{$mark->id}}][]" type="text" value="{{ $marks[$key]}}" required/>
                                                      @else
                                                          <p class="text-center">
                                                              <span>------------</span>
                                                          </p>
                                                      @endif
                                                  </td>
                                                  @endforeach --}}
                                                  @php
                                                    $count = 0;
                                                    $array_length = count($exam_titles);
                                                  @endphp
                                                  @foreach ($titles as $key=>$title)
                                                    @php
                                                        $second = true;
                                                        $count2 = 0;
                                                    @endphp
                                                    @if ($count < $array_length)
                                                        @if ($title->id == $exam_titles[$count])
                                                            <td><input class="form-control form-control-sm" name="marks[{{$mark->id}}][]" type="text" value="{{ $marks[$count] }}" required/></td>
                                                            @php
                                                                $count++;
                                                            @endphp
                                                        @else
                                                            @foreach ($exam_titles as $exam_title)
                                                                
                                                                @if ($title->id == $exam_title)
                                                                    <td><input class="form-control form-control-sm" name="marks[{{$mark->id}}][]" type="text" value="{{ $marks[$count2] }}" required/></td>
                                                                    @php
                                                                        $second = false;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $count2++;
                                                                @endphp
                                                            @endforeach
                                                            @if ($second == true)
                                                                <td>........</td>
                                                            @endif
                                                        @endif
                                                    @else
                                                    <td>.........</td>
                                                    @endif

                                                   @endforeach
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                              <button type="submit" class="btn btn-primary mt-3">Submit</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        @else 
          <div class="container mt-4">
              <div class="card card-body">
                  <h2 class="text-center">
                      No data found
                  </h2>
              </div>
          </div>
        @endif
    </div>
    
</div>


@php
    $student = App\Models\Student\Student::get();
    $classes = App\Models\Academic\Classes::all();
@endphp

@endsection

@push('js')

    <script>
        const section = @json($section);
        const group = @json($group);
        const student = @json($student);
        const classes = @json($classes);
        console.log(student);
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
                    $('#student_id').html('');
                    $('#student_id').selectpicker("refresh");
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
                    $('#student_id').html('');
                    $('#student_id').selectpicker("refresh");
                }else{
                    $('#group').css('display','none');
                }
                $('#group_id').val(0);
                $('#group_id').selectpicker("refresh");

                if (i == 0 & j == 0) {
                  getStudents();
                }
            }
        }

        function getStudents(){
          const class_id = $('#class_id').val();
          const group_id = $('#group_id').val();
          const section_id = $('#section_id').val();
          if (!group_id && !section_id) {
            var filteredStudents = student.filter(stu => stu.class_id == class_id && stu.group_id == null && stu.section_id == null);
          }else if(!group_id && section_id){
            var filteredStudents = student.filter(stu => stu.class_id == class_id && stu.section_id == section_id && stu.group_id == null);
          }else if(group_id && !section_id){
            var filteredStudents = student.filter(stu => stu.class_id == class_id && stu.group_id == group_id && stu.section_id == null);
          }else{
            var filteredStudents = student.filter(stu => stu.class_id == class_id && stu.section_id == section_id && stu.group_id == group_id );
          }
          
          $('#student_id').html(null);
          $('#student_id').append('<option value="" hidden>Select Section</option>');
          filteredStudents.map(function(item){
            $('#student_id').append(`<option value="${item.id}">${item.name}</option>`);
          });
          $('#student_id').val(0);
          $('#student_id').selectpicker("refresh");

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
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
