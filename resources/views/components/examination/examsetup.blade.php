@extends('layouts.backend.main')
@section('title','Exam Setup')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Exam Setup
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
           <i class="fa fa-plus"></i> Exam Setup Title Name
        </button>
        <a href="javascript:void(0)" id="ShowExamSetupTitle" class="btn btn-warning">Show</a>
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Exam Setup</li>
      </ol>
    </div>
    <div class="row py-3" id="exam_setup_title" style="display: none">
        <div class="col-md-12">
            <div class="card w-50 m-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th style="width: 120px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Examination\ExamSetupTitle::all() as $title)
                            <tr>
                                <td>{{ $title->name }}</td>
                                <td class="d-flex justify-content-around">
                                    <div>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="editbutton({{ $title->id }})"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </div>
                                    <div>
                                        <form action="{{ route('backend.exam_setup.title_delete',$title->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger show_confirm"   data-toggle="tooltip" title='Delete' ><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <form action="{{ route('backend.exam_setup.store') }}" method="POST">
        @csrf
    <div class="row mt-3">
        <div class="col-md-12 mb-3 pr-5">
            <div class="row">
                <div class="col-md-3">
                    <label for="exam_id">Exam Name</label>
                    <select name="exam_id" id="exam_id" class="form-control selectpicker" data-live-search="true" title="Select Exam" required>
                        @foreach (App\Models\Examination\Exam::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="class_id">Class</label>
                    <select name="class_id" id="class_id" class="form-control selectpicker class_id" data-live-search="true" title="Select Class" onchange="getSection(this.value)" required>
                        @foreach (App\Models\Academic\Classes::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" id="group" style="display: none">
                    <label for="group_id">Group</label><span class="ml-2">*</span>
                    <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group" onchange="getSubject(this.value)">
                        
                    </select>
                    <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-12 mt-5" id="subjects_section">
                    
                </div>
                <div class="col-md-12 mb-3 mt-3">
                    <label for="exam_mark">Exam Mark</label>
                    <input type="text" class="form-control" name="exam_mark" id="exam_mark" placeholder="Enter Exam Total Mark" required>
                </div>
                
            </div>
        </div>
        <div class="col-md-12 mb-3 pr-5">
            <div class="card mt-2">
                <div class="card-body">
                    <h4 class="header-title">
                        Add Mark Distributions 
                        <span onclick="AddRow()" class="float-right btn btn-success btn-sm bordered-circle"><i class="fas fa-plus"></i></span>
                    </h4>
                    <span class="text-danger">Plese Checked if this Exam Need to be converted into 80%</span>
                    <span class=""><input name="is_converted" class="ml-3" type="checkbox" /></span>
                    <div class="responsive-table" style="margin-top:60px">
                        <table id="Table" class="table">
                            <tbody id="root">
    
                            </tbody>
                        </table>
                    </div>
    
                    <button class="btn btn-success" type="submit">Setup</button>
                </div>
            </div>
        </div>   
    </div>  
    </form>
    <div class="row">
        <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Exam List</h4>
                        <div class="table-responsive">
                            <table id="dataTableHover" class="table table-striped">
                                <thead class="bg-primary text-light">
                                    <th>Sl</th>
                                    <th>Exam Type</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Total Mark</th>
                                    <th>Title</th>
                                    <th>Exam Mark</th>
                                    <th>Pass mark</th>
                                    <th>Action</th>
                                </thead>
    
                                <tbody>
                                    @foreach($exam_setup as $key=>$setup)
                                    
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$setup->exam->name}}</td>
                                        <td>{{$setup->class->name}}</td>
                                        <td>{{$setup->subject->name ?? null}}</td>
                                        <td>{{$setup->exam_mark}}</td>
                                        @php 

                                                $titles = explode(',',$setup->title_name);
                                                $marks = explode(',',$setup->mark);
                                                $pass_marks = explode(',',$setup->pass_mark);

                                        @endphp
                                        <td>
                                                @foreach($titles as $title)
                                                    @php
                                                        $title_name = App\Models\Examination\ExamSetupTitle::find($title);
                                                    @endphp
                                                <div>
                                                        <span class="text-success">{{$title_name->name}}</span>
                                                        <hr>
                                                </div>
                                                @endforeach
                                        </td>

                                        <td>
                                            @foreach($marks as $mark)
                                                <div>
                                                        <span class="text-primary">{{$mark}}</span>
                                                        <hr>
                                                </div>
                                                @endforeach
                                        </td>

                                        <td>
                                                @foreach($pass_marks as $pass)
                                                <div>
                                                        <span class="text-danger">{{$pass}}</span>
                                                        <hr>
                                                </div>
                                                @endforeach
                                        </td>

                                        <td class="d-flex justify-content-around">
                                            <div>
                                                <a href="" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div>
                                                <form action="{{ route('backend.exam_setup.delete',$setup->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger show_confirm"   data-toggle="tooltip" title='Delete' ><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div> 
</div>




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="staticBackdropLabel">Add Exam Setup Title Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('backend.exam_setup.title_store') }}" method="POST">
              @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <button class="btn btn-success mt-2" type="submit">Save</button>
            </form>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Exam Setup Title Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('backend.exam_setup.title_update') }}" method="POST">
              @csrf
              <input type="hidden" id="update_id" name="update_id">
              <div class="form-group">
                  <label for="update_name">Name</label>
                  <input type="text" name="name" class="form-control" id="update_name" required>
              </div>
              <button class="btn btn-success mt-2" type="submit">Save</button>
            </form>
        </div>
      </div>
    </div>
</div>
<select name="title[]" id="title" class="form-control">
    <option value=""></option>
</select>
@php
    $subject = App\Models\Academic\Classes::join('subject_assign_classes','subject_assign_classes.class_id','classes.id')
        ->join('subjects','subjects.id','subject_assign_classes.subject_id')
        ->select('subjects.name as name','subjects.id as id','subject_assign_classes.*')
        ->get();
    $examsetuptitle = App\Models\Examination\ExamSetupTitle::all();
@endphp
@endsection

@push('js')

    <script>
        
        const group = @json($group);
        const subjects = @json($subject);
        const examsetuptitle = @json($examsetuptitle);
        function getSection(id){
            if(id){
                $('#subjects_section').html(null);
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
                    $('#subjects_section').append('<p>Subjects</p>');
                    subjects.filter(function(item){
                        if((item.class_id == id)) {
                            return item;
                        }
                    }).map(function(item){
                        $('#subjects_section').append(`<input type="checkbox" class="mr-1" name="subject[]" value="${item.subject_id}"><label for="" class="mr-2">${item.name}</label>`);
                    });
                }
                $('#group_id').val(0);
                $('#group_id').selectpicker("refresh");
            }
        }
        function getSubject(id){
            
            
            var class_id = $('#class_id').val();
            if(id){
                
                $('#subjects_section').html(null);
                $('#subjects_section').append('<p>Subjects</p>');
                subjects.filter(function(item){
                    if((item.class_id == class_id && item.group_id == id )) {
                        return item;
                    }
                }).map(function(item){
                    
                    $('#subjects_section').append(`<input type="checkbox" class="mr-1" name="subject[]" value="${item.subject_id}"><label for="" class="mr-2">${item.name}</label>`);
                    
                });
            }
        }

        let row = `
            <tr>
                <td>
                    <select name="title_name[]" id="title" class="form-control">
                        <option value="">Select Exam Setup Title</option>
                            ${
                                examsetuptitle.map((item)=> `<option value=${item.id}>${item.name}</option>`)
                            }
                    </select>   
                </td>
                <td><input type="number" class="form-control mark" name="mark[]" placeholder="Mark" required></td>
                <td><input type="number" class="form-control pass_mark" name="pass_mark[]" placeholder="Pass mark" required></td>
                <td><span  class="btn btn-danger delete_row"><i class="fa-solid fa-trash text-danger"></i></span></td>
            </tr>
            `;

        function AddRow(){
            $("#Table").append(row);
        }
        $("#Table").on('click','.delete_row',function(){
            $(this).parent().parent().remove();
        });
        
        function editbutton(Id){
            $('#editModel').modal('show');
            var url = '{{ Route("backend.exam_setup.title_edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                console.log(data);
                $('#update_name').val(data.name);
                $('#update_id').val(data.id);
              }
            );
        }

        $('#ShowExamSetupTitle').on('click', function (e) {
            $('#exam_setup_title').toggle('slow');
            if (e.target.textContent === "Show") {
                e.target.textContent = "Hide";
            } else {
                e.target.textContent = "Show";
            }
        });
    </script>
@endpush
