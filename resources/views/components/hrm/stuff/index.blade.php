
@extends('layouts.backend.main')
@section('title','Stuff')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Stuff</button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Department</th>
                  <th>Photo</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
       @foreach ($stuff as $key=>$stuffs)
           <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{$stuffs->stuff_name}}</td>
                <td>{{$stuffs->phone}}</td>
                <td>{{$stuffs->name}}</td>
                <td>
                    <img src="{{asset('uploads/stuff/'.$stuffs->photo)}}" width="50px">
                </td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$stuffs->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.stuff.delete',$stuffs->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.stuff.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Stuff</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Stuff Name*</strong></label>
            <input type="text" class="form-control" name="stuff_name"  placeholder="Enter name" required>
        </div> 

        <div class="form-group">
            <label><strong>Phone*</strong></label>
            <input type="text" class="form-control" name="phone"  placeholder="Enter phone" required>
        </div> 

        
        <div class="form-group">
            <label><strong>Department Name*</strong></label>
             <select name="name" class="form-control" id="name">
                                <option value="">--Select--</option>
                                @foreach ($department as $key=>$departments)
                                <option>{{$departments->name}}</option>
                                @endforeach
             </select>
        </div> 

        <div class="form-group">
            <label><strong>Photo*</strong></label>
            <input type="file" class="form-control" name="photo" required>
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
     <form action="{{route('backend.stuff.update')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Stuff</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">

      <div class="form-group">
        <label><strong>Stuff Name*</strong></label>
        <input class="form-control" name="stuff_name" id="update_stuff">
    </div> 
    <div class="form-group">
        <label><strong>Phone*</strong></label>
        <input class="form-control" name="phone" id="update_phone">
    </div> 

    <div class="form-group">
        <label><strong>Department Name*</strong></label>
        <input class="form-control" name="name" id="update_name">
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
  var url ='{{route("backend.stuff.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_stuff').val(response.stuff_name);
          $('#update_phone').val(response.phone);
          $('#update_name').val(response.name);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
