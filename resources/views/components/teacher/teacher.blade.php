@extends('layouts.backend.main')
@section('title','Teacher')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Teacher
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Teacher</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
          @if (userHasPermission('teacher-store'))
            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Teacher
            </button>
          @endif
            <div class="card mb-4">
                
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($teacher as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->department->name}}</td>
                      <td>
                        <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                        
                          <div class="dropdown-menu">
                            @if (userHasPermission('teacher-update'))
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $item->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                            @endif
                            @if (userHasPermission('teacher-delete'))
                            <a class="dropdown-item text-danger" href="{{ route('backend.teacher.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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


<div class="modal fade" id="AddModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.teacher.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @php
                  $branch = App\Models\Branch::all();
                @endphp
                @if (count($branch) > 1)
                <div class="col-md-6 mb-3">
                  <label for="branch_id">Branch</label>
                  <select name="branch_id" id="branch_id" class="form-control selectpicker" data-live-search="true" title="Select Branch Name">
                    @foreach ($branch as $item)
                    <option value="{{ $item->id }}" {{ count($branch) == 1 ? 'selected':'' }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                @endif
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="department">Department</label>
                    <select name="department_id" id="department_id" class="selectpicker form-control" data-live-search="true" title="Select Department" required>
                      @foreach (App\Models\Setting\Department::all() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="salary">Salary</label>
                    <input type="text" name="salary" id="salary" class="form-control" placeholder="Enter salary" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="joining_date">Joining Date</label>
                    <input type="date" name="joining_date" id="joining_date" class="form-control" placeholder="Enter joining date" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="file">Document</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success mt-2">Save</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.teacher.update') }}" method="POST">
          @csrf
          <div class="row">
            <input type="hidden" name="update_id" id="update_id">
            <div class="col-md-6 mb-3">
                <label for="branch_id">Branch</label>
                <select name="branch_id" id="update_branch_id" class="form-control selectpicker" data-live-search="true" title="Select Branch Name">
                  @foreach (App\Models\Branch::all() as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="update_name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="update_phone" class="form-control" placeholder="Enter phone" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">email</label>
                <input type="email" name="email" id="update_email" class="form-control" placeholder="Enter email">
            </div>
            <div class="col-md-6 mb-3">
              <label for="department_id">Department</label>
              <select name="department_id" id="update_department_id" class="form-control selectpicker" data-live-search="true" title="Select Department">
                @foreach (App\Models\Setting\Department::all() as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="update_salary" class="form-control" placeholder="Enter salary" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="update_address" class="form-control" placeholder="Enter address" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="joining_date">Joining Date</label>
                <input type="date" name="joining_date" id="update_joining_date" class="form-control" placeholder="Enter joining date" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="file">Document</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success mt-2">Update</button>
            </div>
        </div>
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
            var url = '{{ Route("backend.teacher.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                console.log(data);
                $('#update_id').val(data.id);
                $('#update_branch_id').val(data.branch_id);
                $('#update_name').val(data.name);
                $('#update_phone').val(data.phone);
                $('#update_email').val(data.email);
                $('#update_department_id').val(data.department_id).change();
                $('#update_salary').val(data.salary);
                $('#update_address').val(data.address);
                $('#update_joining_date').val(data.joining_date);
                $('#update_branch_id').val(data.branch_id).change();
              }
            );
        }

    </script>
@endpush
