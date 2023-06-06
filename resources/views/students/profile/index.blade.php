<x-student-layout title="Profile">
    @php
        $stu = \App\Models\Student\Student::with('gender')
            ->where('student_unique_id', intval(auth()->user()->username))
            ->first();

        $stu_data = [
            'Name' => $stu->name,
            'Roll Number' => $stu->roll_number ?? 'N/A',
            'Father Name' => $stu->father_name ?? 'N/A',
            'Date of birth' => $stu->date_of_birth ?? 'N/A',
            'Mother Name' => $stu->mother_name ?? 'N/A',
            'Class' => $stu->class->name ?? 'N/A',
            'Group' => $stu->group->name ?? 'N/A',
            'Session' => $stu->session->name ?? 'N/A',
        ];
    @endphp

    <style>
        .card-img-top {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: relative;
            left: 50%;
            top: 20px;
            bottom: 10px;
            transform: translateX(-50%);
        }
    </style>

    <div class="row mb-5">
        <div class="col-md-3">
            <h3>Student's Details</h3>
            <div class="card">
                <img class="card-img-top rounded-top" src="/Images/students/{{ $stu->photo }}" alt="{{ $stu->name }}">
                <div class="card-body">
                    <p class="d-flex justify-content-between">
                        <span>Student name: </span>
                        <span>{{ $stu->name }}</span>
                    </p>
                    <p class="d-flex justify-content-between">
                        <span>Class: </span>
                        <span>{{ $stu->class->name }}</span>
                    </p>
                    <p class="d-flex justify-content-between">
                        <span>Section: </span>
                        <span>{{ $stu->section->name ?? 'N/A'}}</span>
                    </p>
                    <p class="d-flex justify-content-between">
                        <span>Session: </span>
                        <span>{{ $stu->session->name }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                        aria-controls="settings" aria-selected="false">Settings</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card">
                        <div class="card-body">
                            <h3>Personal Information</h3>
                            <hr>

                            @foreach ($stu_data as $key => $info)
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="my-0">{{ $key }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="my-0">{{ $info }}</p>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card">
                        <div class="card-body">
                            <h3>Exam List</h3>
                            <hr>
                            <div class="row">

                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <div class="card">
                        <div class="card-body">
                            <h3>Change Password</h3>
                            <hr>
                            <form action="{{ route('students.update_password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input id="old_password" name="old_password" type="password" class="form-control" placeholder="Enter your old password">
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password <span class="text-danger">New Password must be at least 8 digit or character</span> </label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Re enter new password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    @push('js')
        <script>
            var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        </script>
    @endpush
</x-student-layout>
