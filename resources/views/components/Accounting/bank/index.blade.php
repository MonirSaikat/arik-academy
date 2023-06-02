
@extends('layouts.backend.main')
@section('title','Bank')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> Addbank </button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Bank_name</th>
                   <th>Account_name</th>
                   <th>Account Number</th>
                   <th>Branch</th>
                   <th>Opening Due</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>

            @php
            $total=0;
            @endphp 
            @foreach($bank as $key=>$banks)
            <tr data-id="">
                <td>{{$key+1}}</td>
                <td>{{ $banks->bank_name }}</td>
                  <td>{{ $banks->account_name }}</td>
                    <td>{{ $banks->account_number }}</td>
                      <td>{{ $banks->branch }}</td>
                      <td>{{$banks->opening_due}}</td>
              
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$banks->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{ route('backend.bank.delete',$banks->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
                        @endif
                      </div>
                    </div>
                  </td>
              
            </tr>
              @php
              $total +=$banks->opening_due;
             @endphp
             @endforeach
             </tbody>
             <tfoot>
             <tr>
            <th colspan="5">Total Opening Due</th>
            <th>{{$total}}</th>
            <th></th>
            <th></th>     
            </tr>
            </tfoot>
  
      </table>
  </div>
</div>
</section>
<div id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('backend.bank.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Addbank</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
          <div class="form-group">
              <label><strong>Bank Name *</strong></label>
              <input type="text" class="form-control" name="bank_name" id="	bank_name" placeholder="Enter name" required>
          </div>   
           <div class="form-group">
              <label><strong>Account Name *</strong></label>
              <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Enter Account name" required>
          </div> 
           <div class="form-group">
              <label><strong>Account Number*</strong></label>
              <input type="number" class="form-control" name="account_number" id="account_number" placeholder="Enter number" required>
          </div> 
           <div class="form-group">
              <label><strong>Branch*</strong></label>
              <input type="text" class="form-control" name="branch" id="branch" placeholder="Enter Branch name" required>
          </div>
          <div class="form-group">
              <label><strong>Opening Due*</strong></label>
              <input type="text" class="form-control" name="opening_due" id="opening_due" placeholder="Enter Branch name" required>
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
     <form action="{{route('backend.bank.update')}}" method="post">
      @csrf
    <div class="modal-header">
      <h5 id="exampleModalLabel" class="modal-title">Update Bank</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      <div class="form-group">
          <label><strong> Bankn Name *</strong></label>
          <input class="form-control" name="bank_name" id="update_name" placeholder="Enter name">
      </div>
       <div class="form-group">
          <label><strong> Account Name *</strong></label>
          <input class="form-control" name="account_name" id="update_account" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label><strong> Account Number *</strong></label>
        <input class="form-control" name="account_number" id="update_number" placeholder="Enter number">
    </div>
       <div class="form-group">
          <label><strong> Branch *</strong></label>
          <input class="form-control" name="branch" id="update_branch" placeholder="Enter branch">
      </div>
       <div class="form-group">
          <label><strong>Opening Due *</strong></label>
          <input class="form-control" name="opening_due" id="update_due" placeholder="Enter name">
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
  var url ='{{route("backend.bank.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_name').val(response.bank_name);
          $('#update_account').val(response.account_name);
          $('#update_number').val(response.account_number);
          $('#update_branch').val(response.branch);
          $('#update_due').val(response.opening_due);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
