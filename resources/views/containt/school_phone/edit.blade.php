@extends('layouts.backend.main')
@section('title', 'Subject')
@section('content')

    <div class="row mt-3">
        <h2 class="text-center">Edit School Information</h2>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{ route('school.phone.edit', $phones->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="school_name" class="form-label">Edit School Name</label>
                    <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name"
                        name="school_name" value="{{ $phones->school_name }}">
                    @error('school_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Edit School Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ $phones->address }}">
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Edit Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" value="{{ $phones->phone }}">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Edit Phone Number</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ $phones->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <label for="teacher" class="form-label">Edit Total Teacher</label>
                    <input type="text" class="form-control @error('teacher') is-invalid @enderror" id="teacher"
                        name="teacher" value="{{ $phones->teacher }}">
                    @error('teacher')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="student" class="form-label">Edit Total Student</label>
                    <input type="text" class="form-control @error('student') is-invalid @enderror" id="student"
                        name="student" value="{{ $phones->student }}">
                    @error('teacher')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Edit School Year</label>
                    <input type="text" class="form-control @error('year') is-invalid @enderror" id="year"
                        name="year" value="{{ $phones->year }}">
                    @error('year')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="buliding" class="form-label">Edit School Year</label>
                    <input type="text" class="form-control @error('buliding') is-invalid @enderror" id="buliding"
                        name="buliding" value="{{ $phones->buliding }}">
                    @error('buliding')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>

@endsection
