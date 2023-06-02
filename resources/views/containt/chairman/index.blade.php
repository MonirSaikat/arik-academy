
@extends('layouts.backend.main')
@section('title','Chairman')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
       Chairman
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
              <i class="fa fa-plus"></i> Add Chairman Info
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Photo</th>
                      <th>Chairman Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($chairmans as $key => $chairman)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{$chairman->chairman_name}}</td>
                        <td>
                            <img src="{{asset('uploads/chairmans/'.$chairman->photo)}}" width="50px">
                        </td>
                        <td>
                          <div class="dropdown">
                            <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                              Action
                            </a>
                          
                            <div class="dropdown-menu">
                              @if (userHasPermission('session-update'))
                                <a type="button" class="dropdown-item" data-chairman="{{$chairman}}" data-toggle="modal" data-target="#updateModal"><i class="fas fa-edit mr-2"></i> Edit</a>  
                              @endif
                              @if (userHasPermission('session-delete'))
                                <a class="dropdown-item text-danger" href="{{ route('school.chairman.delete',$chairman->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('school.chairman.photo')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="chairman_name" class="form-label">Chairman Name</label>
                <input type="text" class="form-control" id="chairman_name" name="chairman_name" required>
            </div>
            <div class="form-group">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
            </div>
            
            <button type="submit" class="btn btn-success mt-2">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Chairman</h5>
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
              <input type="text" name="name" class="form-control " id="update_name" required>
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
        $('#updateModal').on('shown.bs.modal', function(e) {
            const button = $(e.relatedTarget) 
            const chairman = button.data('chairman')
            const id = chairman.id;
            
            console.log(chairman) 

            const modal = $(this)
            const form = modal.find('form')[0]
            form.action = '/school/chairman/photo/update/' + id
            modal.find('#update_name').val(chairman.chairman_name)
        });
    </script>
@endpush


