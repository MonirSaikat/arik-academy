@extends('layouts.backend.main')
@section('title','Subject Assign')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Subject Assign Class
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Subject assign class</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Class</th>
                      <th style="width: 150px;text-align:center">Group</th>
                      <th>Subject</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $key = 1;
                    @endphp
                    @foreach ($classes as $item)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->name}}</td>
                       
                        @if ($item->hasClasses($item->id))

                        <td colspan="2">
                          @php
                            $group = App\Models\Academic\ClassAssignGroup::join('groups','groups.id','class_assign_groups.group_id')
                                  ->where('class_id',$item->id)->select('groups.*')
                                  ->get();
                          @endphp
                          <table class="w-100">
                          @foreach ($group as $group)
                                <tr>
                                  <td style="width: 120px">{{ $group->name }}</td>
                                  <td>
                                    @php
                                      $subjects = App\Models\Subject\SubjectAssignClass::join('subjects','subjects.id','subject_assign_classes.subject_id')
                                            ->where(['subject_assign_classes.class_id'=>$item->id,'subject_assign_classes.group_id' => $group->id])->select('subjects.name as name')
                                            ->get();
                                    @endphp
                                    @foreach ($subjects as $subjects)
                                      <span class="badge badge-primary">{{ $subjects->name }}</span>
                                    @endforeach
                                  </td>
                                </tr>
                          @endforeach
                          </table>
                        </td>
                        @else
                        <td></td>
                        <td>
                          @foreach ($item->subject as $subject)
                            <span class="badge badge-primary">{{ $subject->name }}</span>
                          @endforeach
                        </td>
                        @endif
                        <td>
                          <div class="dropdown">
                            <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                              Action
                            </a>
                          
                            <div class="dropdown-menu">
                              @if (userHasPermission('subject-delete'))
                              <a href="javascript:void(0)" class="dropdown-item" onclick="assign({{ $item->id }})">Assign Subject</a>
                              @endif
                              @if (userHasPermission('subject-delete'))
                              <a class="dropdown-item text-danger" href="{{ route('backend.subjectassign.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
                              @endif
                            </div>
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



{{-- <div class="modal fade" id="AddModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.subjectassign.store') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="class_id">Class Name</label>
                    <select name="class_id" id="class_id" class="form-control selectpicker" data-live-search="true" title="Select Class Name">
                        @foreach (App\Models\Academic\Classes::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="group_id">Group</label>
                    <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group">
                        @foreach (App\Models\Academic\Group::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id[]" multiple id="subject_id" class="form-control selectpicker" data-live-search="true" title="Select Subject">
                        @foreach (App\Models\Subject\Subject::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
      </div>
    </div>
  </div>
</div> --}}

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.subjectassign.store') }}" method="post">
          @csrf
          <input type="hidden" name="class_id" id="class_id">
          <div class="form-group">
            <div class="mb-3" id="demo">

              <label for="group_id">Group</label>
              <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group">
                  
              </select>
            </div>
            <div class="mb-3">
                <label for="subject_id">Subject</label>
                <select name="subject_id[]" multiple id="subject_id" class="form-control selectpicker" data-live-search="true" title="Select Subject">
                    @foreach (App\Models\Subject\Subject::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <button type="submit" class="btn btn-success mt-2">Save</button>
      </form>
      </div>
    </div>
  </div>
</div>


@php
  $classes = DB::table('classes')->join('class_assign_groups','class_assign_groups.class_id','classes.id')
      ->join('groups','groups.id','class_assign_groups.group_id')
      ->select('classes.*','groups.name as group_name','groups.id as group_id')
      ->get();

  
@endphp


@endsection

@push('js')

    <script>
      const group = @json($classes);
        
console.log(group);
        function assign(id){
            $('#editModal').modal('show');
            $('#class_id').val(id);
            var yes = 0;
            if(id){
              $('#group_id').html(null);
              $('#group_id').append('<option value="" hidden>Select group</option>');
              group.filter(function(item){
                  if((item.id == id)) {
                      return item;
                  }
              }).map(function(item){
                  $('#group_id').append(`<option value="${item.group_id}">${item.group_name}</option>`);
                  yes++;
              });
              if (yes != 0) {
                $('#demo').css('display','block');
              }else{
                $('#demo').css('display','none');
              }
              $('#group_id').val(0);
              $('#group_id').selectpicker("refresh");
            }
        }
    </script>
@endpush
