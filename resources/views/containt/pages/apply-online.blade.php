@extends('containt.layouts.forntend')

@section('main')
    <style>
        form.apply {
            background: #fedac3;
            padding: 1.5rem;
            border-width: 3px;
            border-color: #052e59;
            margin: 2rem 0;
            border-style: double;
            color: #052e59;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        
        /* Remove default Bootstrap form control styles */
        .form-control {
            padding: 8px 10px !important;
            color: #333;
            background-color: #f8f8f8;
            border: 1px solid #008836;
            border-radius: 3px;
            box-shadow: 0 0 0 !important;
        } 
        
        #submit-btn {
            color: #fff;
            background-color: #052e59;
            border-color: #052e59;
            width: 100%;
            border-radius: 3px !important;
        }
        
        #submit-btn:hover {
            color: #fff;
            background-color: #052e59;
            border-color: #052e59;
            width: 100%;
            border-radius: 3px !important;
        }
    </style>

    <div class="container mt-5">
        <form method="POST" action="{{ route('apply_online.store') }}" class="apply" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center mt-2">Apply Now</h2>
            @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="class_id">Class *</label>
                        <select name="class_id" id="class_id"required class="form-control">
                            <option>Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4"> 
                    <div class="form-group">
                        <label for="student-name-english">Name (in english) *</label>
                        <input type="text" id="student-name-english" required name="student_name_english" class="form-control" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="student-name-bangla">Name (in bangla) *</label>
                        <input type="text" id="student-name-bangla" required name="student_name_bangla" class="form-control" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_name_bangla">Father's name (in bangla *)</label>
                        <input type="text" id="father_name_bangla"  required name="father_name_bangla" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_name_english">Father's name (in english) *</label>
                        <input type="text" id="father_name_english" required name="father_name_english" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_name_bangla">Mothers's name (in bangla) *</label>
                        <input type="text" id="mother_name_bangla" required name="mother_name_bangla" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_name_english">Mothers's name (in english) *</label>
                        <input type="text" id="mother_name_english" required name="mother_name_english" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_mobile_no">Father's Phone No *</label>
                        <input type="text" id="father_mobile_no" required name="father_mobile_no" class="form-control" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_mobile_no">Mother's Phone No</label>
                        <input type="text" id="mother_mobile_no" required name="mother_mobile_no" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nid_or_birth_cert">NID/Birth Certificate No.</label>
                        <input type="text" id="nid_or_birth_cert" required name="nid_or_birth_cert" class="form-control" />
                        @error('nid_or_birth_cert')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_of_birth">Date of birth *</label>
                        <input type="date" id="date_of_birth" required name="date_of_birth" class="form-control" />
                        @error('date_of_birth')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="present_address">Present Address *</label>
                        <input type="text" id="present_address" required name="present_address" class="form-control" />
                        @error('present_address')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="parmanent_address">Permanent Address *</label>
                        <input type="text" id="parmanent_address" required name="parmanent_address" class="form-control" />
                        @error('parmanent_address')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div> 
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select name="gender" id="gender"required class="form-control">
                            <option>Select Gender</option>
                            @php
                                $genders = [
                                    'Male', 'Female', 'Other'
                                ];
                            @endphp
                            @foreach($genders as $gender)
                                <option value="{{ $gender }}">{{ $gender }}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="blood_group">Blood Group *</label>
                        <select name="blood_group" id="blood_group"required class="form-control">
                            <option>Select Blood Group</option>
                            @php
                                $blood_groups = [
                                    'A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+','AB-'
                                ];
                            @endphp
                            @foreach($blood_groups as $bg)
                                <option value="{{ $bg }}">{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="image">Image *</label>
                        <input type="file" id="image" required name="image" class="form-control" />
                        @error('image')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                 
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
@endsection
