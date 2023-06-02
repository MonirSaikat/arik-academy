
@extends('layouts.backend.main')
@section('title','Transcation')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Bank Transcation </button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Date</th>
                   <th>Bank_name</th>
                   <th>Account type</th>
                   <th>Amount</th>
                   <th>Description</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach($transcation as $key=>$transcations)
            <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{ $transcations->date}}</td>
                  <td>{{ $transcations->bank_name }}</td>
                    <td>{{ $transcations->account_type }}</td>
                      <td>{{ $transcations->amount }}</td>
                      <td>{{$transcations->description}}</td>
              
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$transcations->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.transcation.delete',$transcations->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.transcation.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Bank Transcation</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Date *</strong></label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Enter date" required>
        </div>   
        <div class="form-group">
            <label><strong>Bank Name*</strong></label>
            <input type="text" class="form-control" name="bank_name" id="amount" placeholder="Enter name" required>
        </div> 
         <div class="form-group">
            <label><strong>Account Type*</strong></label>
             <select name="account_type" class="form-control" id="account_type">
                                <option value="">--Select--</option>
                                <option value="deposit">Deposit</option>
                                <option value="withdraw">Withdraw</option>
             </select>
        </div> 
         <div class="form-group">
            <label><strong>Amount*</strong></label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
        </div>
        <div class="form-group">
             <label for="description"><strong> Description </strong> </label>
                 <textarea class="form-control" name="description" id="description" cols="20" rows="2" placeholder="description"></textarea>
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
     <form action="{{route('backend.transcation.update')}}" method="post">
      @csrf
    <div class="modal-header">
      <h5 id="exampleModalLabel" class="modal-title">Update Bank Transcation</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      <div class="form-group">
          <label><strong> Date *</strong></label>
          <input class="form-control" name="date" id="update_date">
      </div>
       <div class="form-group">
          <label><strong> Bank Name *</strong></label>
          <input class="form-control" name="bank_name" id="update_name">
      </div>
      <div class="form-group">
        <label><strong> Account Type *</strong></label>
        <input class="form-control" name="account_type" id="update_type" >
    </div>
       <div class="form-group">
          <label><strong> Amount *</strong></label>
          <input class="form-control" name="amount" id="update_amount">
      </div>
       <div class="form-group">
          <label><strong>Description *</strong></label>
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
  var url ='{{route("backend.transcation.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_date').val(response.date);
          $('#update_name').val(response.bank_name);
          $('#update_type').val(response.account_type);
          $('#update_amount').val(response.amount);
          $('#update_description').val(response.description);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
