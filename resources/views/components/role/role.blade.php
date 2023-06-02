@extends('layouts.backend.main')
@section('title','Role')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Role Create
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Role</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('backend.role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="categoryname">Name</label>
                            <input type="text" class="form-control" required name="name" id="categoryname" value="{{$warehouse->name ?? old('name')}}" class="@error('name') is-invalid @enderror">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                  </div>
            </div>
          </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-dark">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($roles as $key=>$role)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$role->name}}</td>
                      <td class="d-flex">

                        <a href="{{ route('backend.role.assign.create',$role->id) }}" class="btn btn-sm btn-primary mr-2">Permission</a>

                        <button type="button" class="btn btn-sm btn-primary mr-2" onclick="editButton({{ $role->id }})"  data-toggle="modal" data-target="#exampleModal">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>

                        <form action="{{ route('backend.role.destroy',$role->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger show_confirm"   data-toggle="tooltip" title='Delete' ><i class="fa-solid fa-trash"></i></button>
                        </form>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Warehouse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                <input type="hidden" name="hidden_update_id" id="hidden_update_id" />
                <label for="update_name">Name</label>
                <input type="text" name="update_name" class="form-control" id="update_name">
            </div>
            <button class="btn btn-success mt-2" onclick="updateBtn()">Update</button>
      </div>
    </div>
  </div>
</div>





@endsection

@push('js')
    <script>
        function editButton(Id){
            var url ='{{route("backend.role.edit", ":id")}}'
            url = url.replace(':id', Id);
            $.ajax({
                url:url,
                type:'get',
                success:function(response){
                    $('#update_name').val(response.name)
                    $('#hidden_update_id').val(response.id)
                }
            })

        }

        function updateBtn(){
          var Id = $('#hidden_update_id').val()
          var url = '{{ Route("backend.role.update",":id") }}'
          url = url.replace(':id',Id)

          $.ajax({
            url:url,
            type:'put',
            data: { "_token": "{{ csrf_token() }}" , name: $('#update_name').val()},
            success: function(response){
              toastr.options.timeOut = 5000;
              location.reload()
              toastr.success(response);
            }
          })
        }
    </script>
@endpush
