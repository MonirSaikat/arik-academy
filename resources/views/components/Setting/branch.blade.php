@extends('layouts.backend.main')
@section('title','Branch')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Branch
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Branch</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
          @if (userHasPermission('class-store'))
            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Branch
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($branch as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->address}}</td>
                      <td><span class="text-light bg-primary p-1 rounded">{{ $item->is_active == 1 ? 'Active':'Inactive' }}</span></td>
                      <td>
                        <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                        
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('backend.branch.deactive',$item->id) }}">{{ $item->is_active == 1 ? 'Deactive':'Active' }}</a>
                            
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $item->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                            
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
                <label for="image">Logo</label>
                <input type="file" name="image" class="form-control" id="image">
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
        <h5 class="modal-title" id="exampleModalLabel">Update Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.class.update') }}" method="POST">
          @csrf
            <div class="form-group">
                <input type="hidden" name="update_id" id="update_id" />
                <label for="update_name">Name</label>
                <input type="text" name="name" class="form-control" id="update_name" required>
            </div>
            <div class="form-group">
                <label for="update_phone_number">Phone</label>
                <input type="text" name="phone_number" class="form-control" id="update_phone_number" required>
            </div>
            <div class="form-group">
                <label for="update_address">Address</label>
                <input type="text" name="address" class="form-control" id="update_address" required>
            </div>
            <div class="form-group">
                <label for="image">Logo</label>
                <input type="file" name="image" class="form-control" id="image">
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
            var url = '{{ Route("backend.branch.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                console.log(data);
                $('#update_name').val(data.name);
                $('#update_phone_number').val(data.phone_number);
                $('#update_address').val(data.address);
                $('#update_id').val(data.id);
              }
            );
        }

    </script>
@endpush
