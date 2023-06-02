@extends('layouts.backend.main')
@section('title','Grade')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Grade
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Grade</li>
      </ol>
    </div>
    
    <div class="row mt-3">
        <div class="col-lg-12">
          @if (userHasPermission('examination-store'))
            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Grade
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Name</th>
                      <th>GPA</th>
                      <th>Persent From</th>
                      <th>Persent Upto</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($grades as $key=>$item)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{number_format((float)$item->gpa,2)}}</td>
                      <td>{{ $item->persent_from }}</td>
                      <td>{{ $item->persent_upto }}</td>
                      <td>
                        <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                        
                          <div class="dropdown-menu">
                            @if (userHasPermission('subject-update'))
                            <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $item->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                            @endif
                            @if (userHasPermission('examination-delete'))
                            <form action="{{ route('backend.grade.delete',$item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item show_confirm" data-toggle="tooltip" title='Delete' ><i class="fa-solid fa-trash mr-2"></i>Delete</button>
                            </form>
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
        <form action="{{ route('backend.grade.store') }}" method="post">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="gpa">GPA</label>
                    <input type="text" name="gpa" class="form-control" id="gpa" required>
                </div>
                <div class="mb-3">
                    <label for="persent_from">Persent From</label>
                    <input type="text" name="persent_from" class="form-control" id="persent_from" required>
                </div>
                <div class="mb-3">
                    <label for="persent_upto">Persent Upto</label>
                    <input type="text" name="persent_upto" class="form-control" id="persent_upto" required>
                </div>
                <div class="mb-3">
                    <label for="details">Details</label>
                    <input type="text" name="details" class="form-control" id="details" required>
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
        <form action="{{ route('backend.grade.update') }}" method="POST">
          @csrf
          <div class="form-group">
                <input type="hidden" name="update_id" id="update_id" />
                <div class="mb-3">
                    <label for="update_name">Name</label>
                    <input type="text" name="name" class="form-control" id="update_name" required>
                </div>
                <div class="mb-3">
                    <label for="gpa">GPA</label>
                    <input type="text" name="gpa" class="form-control" id="update_gpa" required>
                </div>
                <div class="mb-3">
                    <label for="persent_from">Persent From</label>
                    <input type="text" name="persent_from" class="form-control" id="update_persent_from" required>
                </div>
                <div class="mb-3">
                    <label for="persent_upto">Persent Upto</label>
                    <input type="text" name="persent_upto" class="form-control" id="update_persent_upto" required>
                </div>
                <div class="mb-3">
                    <label for="details">Details</label>
                    <input type="text" name="details" class="form-control" id="update_details" required>
                </div>
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
            var url = '{{ Route("backend.grade.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                $('#update_name').val(data.name);
                $('#update_gpa').val(data.gpa);
                $('#update_persent_from').val(data.persent_from);
                $('#update_persent_upto').val(data.persent_upto);
                $('#update_details').val(data.details);
                $('#update_id').val(data.id);
              }
            );
        }

    </script>
@endpush
