

@extends('layouts.backend.main')
@section('title','Message')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Governing body Message
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
              <i class="fa fa-plus"></i> Add Message
            </button>
          @endif
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Principal Message</th>
                      <th>Chairman Message</th>
                      <th>Message</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->principal }}</td>
                            <td>{{ $value->chairman }}</td>
                            <td>{{ $value->message }}</td>
                            <!--<td>-->
                            <!--    <a href="{{route('delete.messasge', $value->id) }}" class="btn btn-danger">Delete</a>-->
                            <!--    <a href="{{route('edit.message',$value->id)}}" class="btn btn-warning">Edit</a>-->
                            <!--</td>-->
                        <td>
                         <div class="dropdown">
                          <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Action
                          </a>
                          <div class="dropdown-menu">
                            @if (userHasPermission('class-update'))
                            <a class="dropdown-item" href="{{route('edit.message',$value->id)}}" onclick="editbutton({{ $value->id }})"><i class="fas fa-edit mr-2"></i> Edit</a>
                            @endif
                            @if (userHasPermission('class-delete'))
                            <a class="dropdown-item text-danger" href="{{ route('delete.messasge', $value->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('school.principal.index') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="principal">Principal Message</label>
                  <input type="text" name="principal" class="form-control" id="principal" required>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="chairman">Chairman Message</label>
                  <input type="text" name="chairman" class="form-control" id="chairman" required>
                </div>
              </div>
              <div class="col-md-12 mb-3">
                <div class="form-group">
                  <label for="message">Watchword</label>
                  <input type="text" name="message" class="form-control" id="message" required>
                </div>
              </div>

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
        <form action="{{ route('backend.class.update') }}" method="POST">
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
                <input type="checkbox" id="{{ $item->name }}" name="section[]" value="{{ $item->id }}" />
                <label for="{{ $item->name }}">{{ $item->name }}</label>
              </div>
            @endforeach

          </fieldset>
          <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
      </div>
    </div>
  </div>
</div> --}}
<body>

@endsection
