@extends('layouts.backend.main')
@section('title','Subject')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Subject
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Subject</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
          @if (userHasPermission('subject-store'))
            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Subject
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Subject Code</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subjects as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->subject_code}}</td>
                      <td>{{ $item->subject_type->name }}</td>
                      <td>
                        <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                        
                          <div class="dropdown-menu">
                            @if (userHasPermission('subject-update'))
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $item->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                            @endif
                            @if (userHasPermission('subject-delete'))
                            <a class="dropdown-item text-danger" href="{{ route('backend.subject.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        <form action="{{ route('backend.subject.store') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="subject_code">Subject Code</label>
                    <input type="text" name="subject_code" class="form-control" id="subject_code" required>
                </div>
                <div class="mb-3">
                    <label for="type">Subject Type</label>
                    <select name="type" id="type" class="form-control selectpicker" data-live-search="true" title="Select Subject type">
                        @foreach (App\Models\SubjectType::where('is_active',1)->get() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
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
        <h5 class="modal-title" id="exampleModalLabel">Update Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.subject.update') }}" method="POST">
          @csrf
          <div class="form-group">
                <input type="hidden" name="update_id" id="update_id" />
                <div class="mb-3">
                    <label for="update_name">Name</label>
                    <input type="text" name="name" class="form-control" id="update_name" required>
                </div>
                <div class="mb-3">
                    <label for="subject_code">Subject Code</label>
                    <input type="text" name="subject_code" class="form-control" id="update_subject_code" required>
                </div>
                <div class="mb-3">
                    <label for="type">Subject Type</label>
                    <select name="type" id="update_type" class="form-control selectpicker" data-live-search="true" title="Select Subject type">
                        <option value="1">Constant</option>
                        <option value="0">Optional</option>
                    </select>
                </div>
                {{-- <div class="mb-3">
                    <label for="group_id">Group</label>
                    <select name="group_id" id="update_group_id" class="form-control selectpicker" data-live-search="true" title="Select Subject Group">
                        @foreach (App\Models\Academic\Group::all() as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
          </div>
          <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>





@endsection

@push('js')

    <script>

        function editbutton(Id){
            $('#editModal').modal('show');
            var url = '{{ Route("backend.subject.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                $('#update_name').val(data.name);
                $('#update_subject_code').val(data.subject_code);
                $('#update_type').val(data.type).change();
                $('#update_id').val(data.id);
              }
            );
        }

    </script>
@endpush
