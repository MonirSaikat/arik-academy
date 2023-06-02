@extends('layouts.backend.main')
@section('title','Student Create')
@section('content')
<style>
    .student_create_bg{
        background: #27394f!important;
    }
    
    .student_create_bg span.text-light {
        color: red !important;
        font-weight: bold;
        font-size: 14px;
    }
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Student Create
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Create Student</li>
      </ol>
    </div>
    
    <form action="{{ route('backend.student.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row mt-3 student_create_bg text-light py-3 rounded">
        @csrf
        <div class="col-md-12 mb-3">
            <h4>Student Info</h4>
            <p class="">All * mark filed is required</p>
        </div>
        <div class="col-md-3 mb-3">
            <label for="roll_number">Roll</label><span class="ml-2">*</span>
            <input type="text" name="roll_number" id="roll_number" class="form-control" value="{{ old('roll_number') }}">
            <span class="text-light">@error('roll_number'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="name">Name</label><span class="ml-2">*</span>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            <span class="text-light">@error('name'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="student_phone">Phone Number</label>
            <input type="text" name="student_phone" id="student_phone" class="form-control" value="{{ old('student_phone') }}">
            <span class="text-light">@error('student_phone'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="date_of_birth">Date of Birth</label><span class="ml-2">*</span>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
            <span class="text-light">@error('date_of_birth'){{ $message }}@enderror</span>
        </div>
        
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
        <div class="col-md-3 mb-3">
            <label for="session_id">Session</label><span class="ml-2">*</span>
            <select name="session_id" id="session_id" class="form-control selectpicker" data-live-search="true" title="Select Section">
                @foreach (App\Models\Academic\Session::where('is_active',1)->get() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="text-light">@error('session_id'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="religion">Religion</label><span class="ml-2">*</span>
            <select name="religion" id="religion" class="form-control selectpicker" data-live-search="true" title="Select Section">
                @foreach (App\Models\Religion::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="text-light">@error('religion'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="gender">Gender</label><span class="ml-2">*</span>
            <select name="gender" id="gender" class="form-control selectpicker" data-live-search="true" title="Select Section">
                @foreach (App\Models\Gender::all() as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="text-light">@error('gender'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="blood_group">Blood Group</label>
            <select name="blood_group" id="blood_group" class="form-control selectpicker" data-live-search="true" title="Select Blood Group">
                @foreach (App\Models\BloodGroup::all() as $item)
                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="text-light">@error('blood_group'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="birth_certificate_number">Birth certificate Number</label><span class="ml-2">*</span>
            <input type="text" name="birth_certificate_number" id="birth_certificate_number" class="form-control" value="{{ old('birth_certificate_number') }}">
            <span class="text-light">@error('birth_certificate_number'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="father_name">Father Name</label><span class="ml-2">*</span>
            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}">
            <span class="text-light">@error('father_name'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="mother_name">Mother Name</label><span class="ml-2">*</span>
            <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ old('mother_name') }}">
            <span class="text-light">@error('mother_name'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="parent_phone">Father Phone</label><span class="ml-2">*</span>
            <input type="text" name="parent_phone" id="parent_phone" class="form-control" value="{{ old('parent_phone') }}">
            <span class="text-light">@error('parent_phone'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="photo">Photo</label><span class="ml-2">*</span>
            <input type="file" name="photo" id="photo" class="form-control">
            <span class="text-light">@error('photo'){{ $message }}@enderror</span>
        </div>

        <div class="col-md-12 mt-3">
            <h4>Present Address</h4>
        </div>
        <div class="col-md-3 mb-3">
            <label for="district">District</label><span class="ml-2">*</span>
            <input type="text" name="district" id="district" class="form-control" value="{{ old('district') }}">
            <span class="text-light">@error('district'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="upozila">Upazila</label><span class="ml-2">*</span>
            <input type="text" name="upozila" id="upozila" class="form-control" value="{{ old('upozila') }}">
            <span class="text-light">@error('upozila'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="post">Post Office</label><span class="ml-2">*</span>
            <input type="text" name="post" id="post" class="form-control" value="{{ old('post') }}">
            <span class="text-light">@error('post'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-3 mb-3">
            <label for="village">Village</label><span class="ml-2">*</span>
            <input type="text" name="village" id="village" class="form-control" value="{{ old('village') }}">
            <span class="text-light">@error('village'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <h4>Permanent Address</h4><strong class="ml-3 mr-1" style="line-height: 38px">Same </strong> <input type="checkbox" id="same_address" name="same_address">
        </div>
        <div class="col-md-3 mb-3">
            <label for="parmanent_district">District</label><span class="ml-2">*</span>
            <input type="text" name="parmanent_district" id="parmanent_district" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
            <label for="parmanent_upozila">Upazila</label><span class="ml-2">*</span>
            <input type="text" name="parmanent_upozila" id="parmanent_upozila" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
            <label for="parmanent_post">Post Office</label><span class="ml-2">*</span>
            <input type="text" name="parmanent_post" id="parmanent_post" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
            <label for="parmanent_village">Village</label><span class="ml-2">*</span>
            <input type="text" name="parmanent_village" id="parmanent_village" class="form-control">
        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </div>
    </form>
</div>



@endsection

@push('js')

    <script>
        const section = @json($section);
        const group = @json($group);

        $('#same_address').change(function(){
            if(this.checked) {
                $('#parmanent_district').prop('readonly', true);
                $('#parmanent_upozila').prop('readonly', true);
                $('#parmanent_post').prop('readonly', true);
                $('#parmanent_village').prop('readonly', true);
            }else{
                $('#parmanent_district').prop('readonly', false);
                $('#parmanent_upozila').prop('readonly', false);
                $('#parmanent_post').prop('readonly', false);
                $('#parmanent_village').prop('readonly', false);
            }
            
        });

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
