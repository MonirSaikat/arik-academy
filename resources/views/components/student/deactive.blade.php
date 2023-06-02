@extends('layouts.backend.main')
@section('title','Deactive Student List')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Deactive Student List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Deactive Student List</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
      <div class="col-md-12 mb-3">
        <form action="{{ route('backend.student.index') }}" method="GET">
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="class_id">Class</label><span class="ml-2">*</span>
                <select name="class_id" id="class_id" class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                    @foreach (App\Models\Academic\Classes::where('is_active',1)->get() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
              </div>
              <div class="col-md-3 mb-3" id="group" style="display: none">
                  <label for="group_id">Group</label><span class="ml-2">*</span>
                  <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true" title="Select Group">
                      
                  </select>
                  <span class="text-light">@error('group_id'){{ $message }}@enderror</span>
              </div>
              <div class="col-md-3 mb-3" id="section" style="display: none">
                  <label for="section_id">Section</label><span class="ml-2">*</span>
                  <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true" title="Select Section">
                      
                  </select>
                  <span class="text-light">@error('section_id'){{ $message }}@enderror</span>
              </div>
              <div class="col-md-3">
                  <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
              </div>
            </div>
        </form>
    </div>
        @if (isset($student))
            
        
        <div class="col-md-12 mt-3">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                    <thead class="bg-primary text-light">
                      <tr>
                        <th>Sl</th>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Father Name</th>
                        <th>Date of Birth</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($student as $key=>$item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->roll_number }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->class->name }}</td>
                            <td>{{ $item->father_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date_of_birth)->format('d-M-Y') }}</td>
                            <td>
                                <div class="dropdown">
                                  <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                  </a>
                                
                                  <div class="dropdown-menu">
                                    @if (userHasPermission('student-advance'))
                                    <a class="dropdown-item" href="{{ route('backend.student.activedeactive',$item->id) }}">{{ $item->is_active == true ? 'Deactive':'active' }}</a>
                                    @endif
                                    
                                    @if (userHasPermission('student-delete'))
                                    <a class="dropdown-item text-danger" href="{{ route('backend.student.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this data..??')"><i class="fas fa-trash mr-2"></i>Delete</a>
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
        @endif
    </div>
    
</div>



@endsection

@push('js')

    <script>
        const section = @json($section);
        const group = @json($group);
        function getSection(id){
            if(id){
                $('#section_id').html(null);
                $('#section_id').append('<option value="" hidden>Select Section</option>');
                var i = 0;
                section.filter(function(item){
                    if((item.class_id == id)) {
                        return item;
                        
                    }
                }).map(function(item){
                    $('#section_id').append(`<option value="${item.id}">${item.name}</option>`);
                    i++;
                });
                
                if (i != 0) {
                    $('#section').css('display','block');
                }else{
                    $('#section').css('display','none');
                }
                $('#section_id').val(0);
                $('#section_id').selectpicker("refresh");


                $('#group_id').html(null);
                $('#group_id').append('<option value="" hidden>Select Group</option>');
                var j = 0;
                group.filter(function(item){
                    if((item.class_id == id)) {
                        return item;
                    }
                }).map(function(item){
                    $('#group_id').append(`<option value="${item.id}">${item.name}</option>`);
                    j++;
                });
                if (j != 0) {
                    $('#group').css('display','block');
                }else{
                    $('#group').css('display','none');
                }
                $('#group_id').val(0);
                $('#group_id').selectpicker("refresh");
            }
        }
        
    </script>
@endpush
