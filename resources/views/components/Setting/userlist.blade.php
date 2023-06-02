@extends('layouts.backend.main')
@section('title','User List')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        User List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User List</li>
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
                      <th>Name</th>
                      <th>Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->username}}</td>
                      <td>{{$item->role->role_name->name ?? null}}</td>
                      <td>
                        <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                        
                          <div class="dropdown-menu">
                            @if (userHasPermission('user-advance'))
                            <a class="dropdown-item" href="">{{ $item->is_active == 1 ? 'Deactive':'Active' }}</a>
                            @endif
                            @if (userHasPermission('user-advance'))
                            <a class="dropdown-item" href="javascript:void(0)" onclick="roleassign({{ $item->id }})">Assign Role</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.branch.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" required>
            </div>
            <div class="form-group">
                <label for="image">Address</label>
                <input type="file" name="image" class="form-control" id="image" required>
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
        <h5 class="modal-title" id="exampleModalLabel">User Role Assign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.user_list.store') }}" method="POST">
          @csrf
            <div class="form-group">
                <input type="hidden" name="update_id" id="update_id" />
                <label for="update_name">Role</label>
                <select name="role_id" id="role_id" class="form-control selectpicker" data-live-search="true" title="Select Role" required>
                  @foreach (App\Models\Role::all() as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
            </div>
          <button class="btn btn-success mt-2" type="submit">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>





@endsection

@push('js')

    <script>

        function roleassign(Id){
            $('#editModal').modal('show');
            $('#update_id').val(Id);
        }

    </script>
@endpush
