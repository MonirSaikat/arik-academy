
@extends('layouts.backend.main')
@section('title','Stores')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Stores</button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Store Title</th>
                  <th>Description</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
          @foreach ($store as $key=>$stores)
           <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{$stores->store_title}}</td>
                <td>{{$stores->description}}</td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$stores->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.store.delete',$stores->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
                        @endif
                      </div>
                    </div>
                  </td> 
            </tr>
            @endforeach
      </table>
  </div>
</div>
</section>
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('backend.store.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Store</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Store Titel*</strong></label>
            <input type="text" class="form-control" name="store_title"  placeholder="Enter title" required>
        </div> 

        <div class="form-group">
            <label><strong>Description*</strong></label>
            <textarea name="description" class="form-control" placeholder="Enter Description" rows="5" required></textarea>    
        </div>

          <div class="form-group">       
            <input type="submit" value="submit" class="btn btn-primary">
          </div>
     
      </div>
    </div>
  </form>
  </div>
</div>

<div id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
<div role="document" class="modal-dialog">
    
  <div class="modal-content">
     <form action="{{route('backend.store.update')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Income</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      <div class="form-group">
        <label><strong>Store Title*</strong></label>
        <input class="form-control" name="store_title" id="update_title">
    </div> 
    <div class="form-group">
        <label><strong>Description*</strong></label>
        <input class="form-control" name="description" id="update_description">
    </div> 

      <div class="form-group">       
          <input type="submit" value="submit" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
</div>
</div>


<script type="text/javascript">

function editbutton(Id){
  $('#editModal').modal('show');
  var url ='{{route("backend.store.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_title').val(response.store_title);
          $('#update_description').val(response.description);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
