@extends('layouts.backend.main')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header bg-info text-light">
                    <h5>Add Student</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('backend.student.store')}}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label class="" for="student_unique_id">Sutdent Unique Id</label>
                                <input type="text" class="form-control"  name="student_unique_id" id="student_unique_id">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="roll_number">Roll Number</label>
                                <input type="text" class="form-control" required name="roll_number" id="roll_number">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="name">Name</label>
                                <input type="text" class="form-control" required name="name" id="name">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="father_name">Father Name</label>
                                <input type="text" class="form-control" required name="father_name" id="father_name">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="mother_name">Mother Name</label>
                                <input type="text" class="form-control" required name="mother_name" id="mother_name">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="parent_number">Parent Number</label>
                                <input type="text" class="form-control" min="10" required name="parent_number" id="parent_number">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label  for="student_number">Student Number</label>
                                <input type="number" class="form-control" min="10"  name="student_number" id="student_number">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label for="class">Class</label>
                                <select name="class" class="form-control selectpicker" data-live-search="true" title="Choose class..." required id="class">
                                                                        <option value="6">Six</option>
                                                                        <option value="7">Seven</option>
                                                                        <option value="8">Eight</option>
                                                                        <option value="9">Nine</option>
                                                                        <option value="10">Ten</option>
                                                                        <option value="06">Rangpur</option>
                                                                        <option value="22">Maisha</option>
                                                                    </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="group">Group</label>
                                <select name="group" class="form-control selectpicker" data-live-search="true" title="Choose group..." required id="group">
                                                                        <option value="General">General</option>
                                                                        <option value="Science">Science</option>
                                                                        <option value="Business">Business</option>
                                                                        <option value="Humanities">Humanities</option>
                                                                        <option value="22">Bussines</option>
                                                                    </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="session">Session</label>
                                <select name="session" class="form-control selectpicker" data-live-search="true" title="Choose session..." required id="session">
                                                                        <option value="2022">2022</option>
                                                                    </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="section">Section</label>
                                <select name="section" class="form-control selectpicker" data-live-search="true" title="Choose section..." required id="section">
                                                                        <option value="Joba">Joba</option>
                                                                        <option value="Shapla">Shapla</option>
                                                                        <option value="Golap">Golap</option>
                                                                        <option value="Tista">Tista</option>
                                                                        <option value="Surma">Surma</option>
                                                                        <option value="Kortowa">Kortowa</option>
                                                                        <option value="Jamuna">Jamuna</option>
                                                                        <option value="Meghna">Meghna</option>
                                                                        <option value="Padma">Padma</option>
                                                                        <option value="Common">Common</option>
                                                                    </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="gender">Gender</label>
                                <select name="gender" class="form-control selectpicker" data-live-search="true" title="Choose gender..." required id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="blood_group">Blood Group</label>
                                <select name="blood_group" class="form-control selectpicker" data-live-search="true" title="Choose blood group..."  id="blood_group">
                                    <option value="a+">A+</option>
                                    <option value="a-">A-</option>
                                    <option value="b+">B+</option>
                                    <option value="b-">B-</option>
                                    <option value="o+">O+</option>
                                    <option value="o-">O-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="ab-">AB-</option>
                                </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="religion">Religion</label>
                                <select name="religion" class="form-control selectpicker" data-live-search="true" title="Choose religion..."  id="religion">
                                    <option value="islam">Islam</option>
                                    <option value="hinduism">Hinduism</option>
                                    <option value="christianity">Christianity</option>
                                    <option value="buddhism">Buddhism</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="bate_of_birth">Date of birth</label>
                                <input type="date" class="form-control" required  name="bate_of_birth" id="bate_of_birth">
                            </div>

                            <div class="col-sm-3 my-1">
                                <label class="" for="birth_certificate_number">Birth certificate Number</label>
                                <input type="text" class="form-control"   name="birth_certificate_number" id="birth_certificate_number">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="'photo">Profile Image</label>
                                <input type="file" class="form-control" required  name="'photo" id="'photo">
                            </div> 
                        </div>
                        <strong>Present Address</strong>
                        <div class="row">
                            <div class="col-sm-3 my-1">
                                <label class="" for="village">Village</label>
                                <input type="text" class="form-control" required  name="village" id="village">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="post">Post</label>
                                <input type="text" class="form-control" required  name="post" id="post">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="upozila">UpoZila</label>
                                <input type="text" class="form-control" required  name="upozila" id="upozila">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="district">District</label>
                                <input type="text" class="form-control" required  name="district" id="district">
                            </div>
                        </div>
                        <strong>Parmanent Address</strong> <strong class="ml-2 mr-1">Same </strong> <input type="checkbox" id="same_address" name="same_address">
                        <div class="row">
                            
                            <div class="col-sm-3 my-1">
                                <label class="" for="permanent_village">Village</label>
                                <input type="text" class="form-control" required  name="parmanent_village" id="parmanent_village">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="parmanent_post">Post</label>
                                <input type="text" class="form-control" required  name="parmanent_post" id="parmanent_post">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="parmanent_upozila">UpoZila</label>
                                <input type="text" class="form-control" required  name="parmanent_upozila" id="parmanent_upozila">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label class="" for="parmanent_district">District</label>
                                <input type="text" class="form-control" required  name="parmanent_district" id="parmanent_district">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
