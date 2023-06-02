@extends('layouts.backend.main')
@section('title','Subject Assign Teacher')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Subject Assign Teacher
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Subject Assign</li>
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
                      <th>Teacher</th>
                      <th>Subject</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teacher as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>
                        @foreach ($item->subject as $items)
                            <span class="bg-primary p-1 text-light rounded">{{ $items->name }}</span>
                        @endforeach
                      </td>
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
                            <a class="dropdown-item text-danger" href="{{ route('backend.subjectassignteacher.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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



<div class="modal fade" id="AddModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.subjectassignteacher.store') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="teacher_id">Teacher Name</label>
                    <select name="teacher_id" id="teacher_id" class="form-control selectpicker" data-live-search="true" title="Select Class Name">
                        @foreach (App\Models\Teacher\Teacher::all() as $item)
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
</div>

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
        <form action="{{ route('backend.subjectassignteacher.store') }}" method="post">
          @csrf
          <input type="hidden" name="teacher_id" id="teacher_id" class="teacher_id">
          <div class="form-group">
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





@endsection

@push('js')

    <script>

        function assign(id){
            $('#editModal').modal('show');
            $('.teacher_id').val(id);
        }
    </script>
@endpush
