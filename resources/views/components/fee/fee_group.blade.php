@extends('layouts.backend.main')
@section('title','Fee Group')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Fee Group
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fee Group</li>
      </ol>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">

            <button type="button" class="btn btn-sm btn-primary mr-2 mb-3"  data-toggle="modal" data-target="#AddModel">
              <i class="fa fa-plus"></i> Add Fee Group
            </button>

            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Prefix</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->group_title }}</td>
                            <td>{{ $item->group_description }}</td>
                            <td>{{ $item->invoice_prefix }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </a>

                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{ $item->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                                      <a class="dropdown-item text-danger" href="{{ route('backend.group.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.fee.group.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="group_title">Group Title *</label>
                <input type="text" name="group_title" class="form-control" id="group_title" required>
            </div>
            <div class="form-group">
                <label for="group_title">Group Description</label>
                <textarea name="group_description" id="group_description" class="form-control">
                </textarea>
            </div>
            <div class="form-group">
                <label for="group_title">Invoice Prefix *</label>
                <input type="text" name="invoice_prefix" class="form-control" id="invoice_prefix" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Update Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('backend.group.update') }}" method="POST">
          @csrf
          <div class="form-group">
              <input type="hidden" name="update_id" id="update_id" />
              <label for="update_name">Name</label>
              <input type="text" name="name" class="form-control" id="update_name">
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
            var url = '{{ Route("backend.group.edit",":id") }}'
            url = url.replace(':id',Id)
            $.get(url,
              function (data) {
                $('#update_name').val(data.name);
                $('#update_id').val(data.id);
              }
            );
        }

    </script>
@endpush
