
@extends('layouts.backend.main')
@section('title','Principal')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
      About Principal
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Class</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
          @if (userHasPermission('class-store'))
            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Principal Inormation
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Description</th>
                      <th>Principal Name</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($principals as $key =>$principal)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $principal->description }}</td>
                          <td>{{ $principal->principal_name }}</td>
                        <td>
                            <img src="{{asset('uploads/prinsipals/'.$principal->photo)}}" width="50px">
                        </td>
                        {{-- <td>
                            <a href="{{route('school.principal.delete',$principal->id)}}" class="btn btn-danger">Delete</a>
                        </td> --}}
                        <td>
                          <div class="dropdown">
                            <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                              Action
                            </a>
                          
                            <div class="dropdown-menu">
                              @if (userHasPermission('session-update'))
                              {{-- <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $principal->id }})"><i class="fas fa-edit mr-2"></i> Edit</a> --}}
                              @endif
                              @if (userHasPermission('session-delete'))
                              <a class="dropdown-item text-danger" href="{{ route('school.principal.delete',$principal->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Principal Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('school.principal') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="description" class="form-label">Add principal message</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="principal_name" class="form-label">Principal Name</label>
                 <input type="text" class="form-control" id="principal_name" name="principal_name" required>
              </div>

              <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                 <input type="file" class="form-control" id="photo" name="photo" required>
              </div>
                        
            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('school.principla.update') }}" method="POST">
          @csrf
          <div class="form-group">
              <input type="hidden" name="update_id" id="update_id" />
              <label for="update_name">Name</label>
              <input type="text" name="name" class="form-control" id="update_name" required>
          </div>
          <fieldset>
            <legend>Choose Section</legend>
            @foreach (App\Models\Academic\Section::where('is_active',1)->get() as $item)
              <div>
                <input type="checkbox" id="{{ $principal->description}}" name="section[]" value="{{ $principal->id }}" />
                <label for="{{ $principal->description }}">{{ $principal->description }}</label>
              </div>
            @endforeach
            
          </fieldset>
          <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
      </div>
    </div>
  </div>
</div> --}}


@endsection

@push('js')

    <script>

        function editbutton(Id){
            $('#editModal').modal('show');
            var url = '{{ Route("backend.class.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                console.log(data);
                $('#update_name').val(data.name);
                $('#update_id').val(data.id);
              }
            );
        }

    </script>
@endpush


