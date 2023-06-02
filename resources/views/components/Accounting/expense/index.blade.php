
@extends('layouts.backend.main')
@section('title','Expense')
@section('content')
<section>
  <div class="container-fluid">
      <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Expanse </button>
  </div>
<div class="card mt-3">
  <div class="table-responsive p-3">
      <table id="biller-table" class="table table-striped">
          <thead>
              <tr>
                  <th>Sl</th>
                  <th>Expense title</th>
                  <th>Expense amount</th>
                   <th>Category</th>
                   <th>Notes</th>
                   <th>Date</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
 @foreach($category as $key=>$categorys)
            <tr data-id="">
              <td>{{$key+1}}</td>
              <td>{{ $categorys->categori_title}}</td>
                <td>{{ $categorys->amount }}</td>
                <td>{{ $categorys->title }}</td>
                <td>{{ $categorys->note}}</td>
                <td>{{ $categorys->date }}</td>
                  <td>
                    <div class="dropdown">
                      <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </a>
                      <div class="dropdown-menu">
                        @if (userHasPermission('session-update'))
                        <a class="dropdown-item" href="javascript:void(0)" onclick="editbutton({{$categorys->id}})"><i class="fas fa-edit mr-2"></i> Edit</a>
                        @endif
                        @if (userHasPermission('session-delete'))
                        <a class="dropdown-item text-danger" href="{{route('backend.expense.delete',$categorys->id)}}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
      <form action="{{route('backend.expense.store')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title">Expense Category</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p class="italic"><small>The field labels marked with * are required input fields</small></p>
       
        <div class="form-group">
            <label><strong>Expense Title *</strong></label>
            <input type="text" class="form-control" name="categori_title" id="categori_title" placeholder="Enter title" required>
        </div>   
        <div class="form-group">
            <label><strong>Expense Amount*</strong></label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
        </div> 
        <div class="form-group">
          <label><strong>Expense Date *</strong></label>
          <input type="date" class="form-control" name="date" id="date" placeholder="Enter Date" required>
      </div> 
         <div class="form-group">
            <label><strong>Expense Category*</strong></label>
             <select name="title" class="form-control" id="title">
                                <option value="">--Select--</option>
                                @foreach($expense as $key=>$expenses)
                                <option>{{$expenses->title}}</option>
                                @endforeach
             </select>
        </div> 

        <div class="form-group">
             <label for="description"><strong> Note </strong> </label>
                 <textarea class="form-control" name="note" id="note" cols="20" rows="2" placeholder="note"></textarea>
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
     <form action="{{route('backend.expense.update')}}" method="post">
      @csrf
    <div class="modal-header">
      <h5 id="exampleModalLabel" class="modal-title">Update Expense</h5>
      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
      <p class="italic"><small>The field labels marked with * are required input fields</small></p>
      <input type="hidden" name="update_id" id="update_id">
      <div class="form-group">
          <label><strong>Expense Title*</strong></label>
          <input class="form-control" name="categori_title" id="update_title">
      </div>
      <div class="form-group">
        <label><strong>Expense Amount *</strong></label>
        <input class="form-control" name="amount" id="update_amount" >
    </div>
       <div class="form-group">
          <label><strong> Expense Date *</strong></label>
          <input class="form-control" type="date" name="date" id="update_date">
      </div>
       <div class="form-group">
          <label><strong>Expense Category*</strong></label>
          <input class="form-control" name="title" id="update_category_title">
      </div>
      <div class="form-group">
        <label><strong> Note *</strong></label>
        <input class="form-control" name="note" id="update_note">
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
  var url ='{{route("backend.expense.edit", ":id")}}'
  url = url.replace(':id', Id);
  $.ajax({
      url:url,
      type:'get',
      success:function(response){
          console.log(response);
          $('#update_title').val(response.categori_title);
          $('#update_amount').val(response.amount);
          $('#update_date').val(response.date);
          $('#update_category_title').val(response.title);
          $('#update_note').val(response.note);
          $('#update_id').val(response.id);
      }
  })
}
  

</script>
@endsection
