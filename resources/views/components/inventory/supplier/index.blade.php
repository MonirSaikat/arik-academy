
@extends('layouts.backend.main')
@section('title','Supplier')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Supplier</button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Supplier name </th>
                  <th>Description</th>
                  <th>Supplier Phone</th>
                  <th>Supplier E-mail</th>
                  <th>Supplier Address</th>
                  <th>Contact Person Name</th>
                  <th>Contact Person Phone</th>
                  <th>Contact Person E-mail</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
       @foreach($supplier as $key=>$suppliers)
           <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{$suppliers->supplier_name}}</td>
                <td>{{$suppliers->description}}</td>
                <td>{{$suppliers->supplier_phone}}</td>
                <td>{{$suppliers->supplier_email}}</td>
                <td>{{$suppliers->supplier_address}}</td>
                <td>{{$suppliers->person_name}}</td>
                <td>{{$suppliers->person_phone}}</td>
                <td>{{$suppliers->person_email}}</td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$suppliers->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.supplier.delete',$suppliers->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.supplier.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Supplier</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Supplier Name*</strong></label>
            <input type="text" class="form-control" name="supplier_name"  placeholder="Enter name" required>
        </div> 

        <div class="form-group">
            <label><strong>Description*</strong></label>
            <textarea name="description" class="form-control" placeholder="Enter Description" rows="3" required></textarea>    
        </div>
        <div class="form-group">
            <label><strong>Supplier Phome*</strong></label>
            <input type="text" class="form-control" name="supplier_phone"  placeholder="Enter phone number" required>
        </div> 
        <div class="form-group">
            <label><strong>Supplier Email*</strong></label>
            <input type="email" class="form-control" name="supplier_email"  placeholder="Enter Email" required>
        </div> 
        <div class="form-group">
            <label><strong>Supplier Address*</strong></label>
            <textarea name="supplier_address" class="form-control" placeholder="Enter Address" rows="3" required></textarea>    
        </div>
        <div class="form-group">
            <label><strong>Contac Person name*</strong></label>
            <input type="text" class="form-control" name="person_name"  placeholder="Enter Person Name" required>
        </div> 
        <div class="form-group">
            <label><strong>Contact Person phone*</strong></label>
            <input type="text" class="form-control" name="person_phone"  placeholder="Enter Person phone" required>
        </div> 
        <div class="form-group">
            <label><strong>Contac Person Email*</strong></label>
            <input type="text" class="form-control" name="person_email"  placeholder="Enter Person email" required>
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
     <form action="{{route('backend.supplier.update')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Income</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      <div class="form-group">
        <label><strong>Supplier Name*</strong></label>
        <input class="form-control" name="supplier_name" id="update_supplier_name">
    </div> 

    <div class="form-group">
        <label><strong>Description*</strong></label>
        <input class="form-control" name="description" id="update_description">
    </div> 

    <div class="form-group">
        <label><strong>Supplier Phone*</strong></label>
        <input class="form-control" name="supplier_phone" id="update_supplier_phone">
    </div> 
    <div class="form-group">
        <label><strong>Supplier Email*</strong></label>
        <input class="form-control" name="supplier_email" id="update_supplier_email">
    </div> 
    <div class="form-group">
        <label><strong>Supplier Address*</strong></label>
        <input class="form-control" name="supplier_address" id="update_supplier_address">
    </div> 
    <div class="form-group">
        <label><strong>Contact Person Name*</strong></label>
        <input class="form-control" name="person_name" id="update_person_name">
    </div> 
    <div class="form-group">
        <label><strong>Contact Person Phone*</strong></label>
        <input class="form-control" name="person_phone" id="update_person_phone">
    </div> 
    <div class="form-group">
        <label><strong>Contact Person Email*</strong></label>
        <input class="form-control" name="person_email" id="update_person_email">
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
  var url ='{{route("backend.supplier.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_supplier_name').val(response.supplier_name);
          $('#update_description').val(response.description);
          $('#update_supplier_phone').val(response.supplier_phone);
          $('#update_supplier_email').val(response.supplier_email);
          $('#update_supplier_address').val(response.supplier_address);
          $('#update_person_name').val(response.person_name);
          $('#update_person_phone').val(response.person_phone);
          $('#update_person_email').val(response.person_email);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
