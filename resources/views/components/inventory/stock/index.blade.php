@extends('layouts.backend.main')
@section('title','stock')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Items Stock</button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Reference Number</th>
                  <th>Category</th>
                  <th>Item</th>
                  <th>Store</th>
                  <th>Supplier</th>
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Attachment</th>
                  <th>Notes</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
         @foreach($stock as $key=>$stocks)
           <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{$stocks->reference_number}}</td>
                <td>{{$stocks->title}}</td>
                <td>{{$stocks->item_title}}</td>
                <td>{{$stocks->store_title}}</td>
                <td>{{$stocks->supplier_name}}</td>
                <td>{{$stocks->quantity}}</td>
                <td>{{$stocks->date}}</td>
                <td>
                    <img src="{{asset('uploads/stock/'.$stocks->photo)}}" width="50px">
                </td>
                <td>{{$stocks->description}}</td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$stocks->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.stock.delete',$stocks->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.stock.store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Items Stocks</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Reference Number*</strong></label>
            <input type="text" class="form-control" name="reference_number"  placeholder="Enter Number" required>
        </div> 
         
        <div class="form-group">
            <label><strong>Item Category*</strong></label>
             <select name="title" class="form-control" id="title">
                                <option value="">--Select--</option>
                                @foreach ($category as $key=>$categorys )
                                <option>{{$categorys->title}}</option>
                                @endforeach
             </select>
        </div> 
        
        <div class="form-group">
            <label><strong>Item *</strong></label>
             <select name="item_title" class="form-control" id="title">
                                <option value="">--Select--</option>
                                @foreach($item as $key=>$items)
                                <option>{{$items->item_title}}</option>
                                @endforeach
             </select>
        </div> 

        <div class="form-group">
            <label><strong>Store*</strong></label>
             <select name="store_title" class="form-control" id="title">
                                <option value="">--Select--</option>
                                @foreach ($store as $key=>$stores)
                                <option>{{$stores->store_title}}</option>
                                @endforeach
             </select>
        </div> 
        <div class="form-group">
            <label><strong>Supplier*</strong></label>
             <select name="supplier_name" class="form-control" id="title">
                                <option value="">--Select--</option>
                                @foreach($supplier as $key=>$suppliers)
                                <option>{{$suppliers->supplier_name}}</option>
                                @endforeach
             </select>
        </div> 
        
        <div class="form-group">
            <label><strong>Quantity*</strong></label>
            <input type="number" class="form-control" name="quantity"  placeholder="Enter quantity" required>
        </div> 

        <div class="form-group">
            <label><strong>Date*</strong></label>
            <input type="date" class="form-control" name="date"  required>
        </div> 
        <div class="form-group">
            <label><strong>Attachment*</strong></label>
            <input type="file" class="form-control" name="photo"  required>
        </div> 

        <div class="form-group">
            <label><strong>Description*</strong></label>
            <textarea name="description" class="form-control" placeholder="Enter Description" rows="3" required></textarea>    
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
     <form action="{{route('backend.stock.update')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Stock</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      
      <div class="form-group">
        <label><strong>Reference Number*</strong></label>
        <input class="form-control" name="reference_number" id="update_reference_number">
    </div> 

    <div class="form-group">
        <label><strong>Item Category*</strong></label>
        <input class="form-control" name="title" id="update_title">
    </div> 
    <div class="form-group">
        <label><strong>Item*</strong></label>
        <input class="form-control" name="item_title" id="update_item_title">
    </div> 
    <div class="form-group">
        <label><strong>Store*</strong></label>
        <input class="form-control" name="store_title" id="update_store_title">
    </div> 
    <div class="form-group">
        <label><strong>Supplier*</strong></label>
        <input class="form-control" name="supplier_name" id="update_supplier_name">
    </div> 

    <div class="form-group">
        <label><strong>Quantity*</strong></label>
        <input class="form-control" name="quantity" id="update_quantity">
    </div> 

    <div class="form-group">
        <label><strong>Date*</strong></label>
        <input class="form-control" type="date" name="date" id="update_date">
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
  var url ='{{route("backend.stock.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_reference_number').val(response.reference_number);
          $('#update_title').val(response.title);
          $('#update_item_title').val(response.item_title);
          $('#update_supplier_name').val(response.supplier_name);
          $('#update_store_title').val(response.store_title);
          $('#update_quantity').val(response.quantity);
          $('#update_date').val(response.date);
          $('#update_description').val(response.description);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
