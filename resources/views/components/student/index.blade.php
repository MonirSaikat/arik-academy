@extends('layouts.backend.main')
@section('title','Student List')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Student List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Student List</li>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Roll</th>
                        <th>Class</th>
                        <th>Section</th> 
                        <th>Group</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($student as $key=>$item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ 'AA' . $item->student_unique_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->student_phone[0] == '0' ? $item->student_phone : '0'. $item->student_phone }}</td>
                            <td>{{ $item->roll_number }}</td>
                            <td>{{ $item->class->name }}</td>
                            <td>{{ $item->section->name ?? 'N/A' }}</td> 
                            <td>{{ $item->group->name ?? 'N/A' }}</td>
                            <td>
                                <img src="https://transcendifs.com/wp-content/uploads/2021/04/tifs-student-placeholder.jpg" style="width: 60px; height: 60px; border-radius: 50%;" alt="<?= $item->name ?>" />
                            </td>
                            <td>
                                <div class="dropdown">
                                  <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                  </a>
                                
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#studentViewModal" data-student="{{ $item }}"><i class="fa fa-list mr-2"></i> View</a>
                                    @if (userHasPermission('student-advance'))
                                    <a class="dropdown-item" href="{{ route('backend.student.activedeactive',$item->id) }}">{{ $item->is_active == true ? 'Deactive':'active' }}</a>
                                    @endif
                                    @if (userHasPermission('student-update'))
                                    <a class="dropdown-item" href="{{ route('backend.student.edit',$item->id) }}"><i class="fas fa-edit mr-2"></i> Edit</a>
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

<!-- Student View Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Student's Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table">
              <tr>
                  <th>Unique Id</th>
                  <td id="student_unique_id"></td>
              </tr>
              <tr>
                  <th>Name</th>
                  <td id="student_name"></td>
              </tr>
              <tr>
                  <th>Mobile No</th>
                  <td id="student_phone"></td>
              </tr>
                <tr>
                  <th>Class</th>
                  <td id="student_class"></td>
              </tr>
              <tr>
                  <th>Roll No</th>
                  <td id="student_roll"></td>
              </tr>
                <tr>
                  <th>Section</th>
                  <td id="student_section"></td>
              </tr>
               <tr>
                  <th>Group</th>
                  <td id="student_group"></td>
              </tr>
             <tr>
                  <th>Gender</th>
                  <td id="gender"></td>
              </tr>
             <tr>
                  <th>Religion</th>
                  <td id="religion"></td>
              </tr>
                 <tr>
                  <th>Blood Group</th>
                  <td id="blood_group"></td>
              </tr>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>


@endsection

@push('js')

    <script>
       $('#studentViewModal').on('show.bs.modal', function (event) {
          const button = $(event.relatedTarget) // Button that triggered the modal
          const student = button.data('student') // Extract info from data-* attributes
          const modal = $(this) 
          
          modal.find('#student_unique_id').text(student.student_unique_id)
          modal.find('#student_name').text(student.name)
          modal.find('#student_roll').text(student.roll_number)
          modal.find('#student_phone').text(student.student_phone)
          modal.find('#student_class').text(student.class.name || 'N/A')
          modal.find('#student_section').text(student.section.name || 'N/A')
          modal.find('#student_group').text(student.group.name || 'N/A')
          
          modal.find('#gender').text(student.gender.name || 'N/A')
          modal.find('#religion').text(student.religion.name || 'N/A')
          modal.find('#blood_group').text(student.blood_group || 'N/A')
          
        })
       
       
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
