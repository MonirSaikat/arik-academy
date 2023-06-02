
@extends('layouts.backend.main')
@section('title','Payroll')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Payroll</button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Employee Name</th>
                  <th>Account</th>
                  <th>Amount</th>
                  <th>Method</th>
                  <th>Note</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
 @foreach($payroll as $key=>$payrolls)
           <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{$payrolls->employee_name}}</td>
                <td>{{$payrolls->account}}</td>
                <td>{{$payrolls->amount}}</td>
                <td>{{$payrolls->method}}</td>
                <td>{{$payrolls->description}}</td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$payrolls->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.payroll.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Add Payroll</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Employee Name*</strong></label>
             <select name="employee_name" class="form-control" id="name">
                                <option value="">--Select--</option>
                                @foreach ($designation as $key=>$designations)
                                <option>{{$designations->employee_name}}</option>
                                @endforeach
             </select>
        </div> 

        <div class="form-group">
            <label><strong>Account*</strong></label>
            <input type="text" class="form-control" name="account"  placeholder="Enter account" required>
        </div> 
       
        <div class="form-group">
            <label><strong>Amount*</strong></label>
            <input type="number" class="form-control" name="amount"  placeholder="Enter Amount" required>
        </div> 
        
        <div class="form-group">
            <label><strong>Method*</strong></label>
             <select name="method" class="form-control" id="name">
                                <option value="">--Select--</option>
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="card">Credit Card</option>
                             
             </select>
        </div> 
        
        <div class="form-group">
            <label><strong>Note*</strong></label>
            <textarea id="description" name="description" class="form-control" placeholder="Enter Description" rows="3"></textarea>    
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
     <form action="{{route('backend.payroll.update')}}" method="post">
      @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Update Stuff</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">

      <div class="form-group">
        <label><strong>Employee Name*</strong></label>
        <input class="form-control" name="employee_name" id="update_employee">
    </div> 
    <div class="form-group">
        <label><strong>Account*</strong></label>
        <input class="form-control" name="account" id="update_account">
    </div> 

    <div class="form-group">
        <label><strong>Amount*</strong></label>
        <input class="form-control" name="amount" id="update_amount">
    </div> 
    <div class="form-group">
        <label><strong>Method*</strong></label>
        <input class="form-control" name="method" id="update_method">
    </div> 
    <div class="form-group">
        <label><strong>Note*</strong></label>
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
  var url ='{{route("backend.payroll.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_employee').val(response.employee_name);
          $('#update_account').val(response.account);
          $('#update_amount').val(response.amount);
          $('#update_method').val(response.method);
          $('#update_description').val(response.description);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
