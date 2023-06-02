@extends('layouts.backend.main')
@section('title', 'Profile')
@section('content')


  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Profile
      </h1>
    </div>
    <div class="card w-50 m-auto">
      <div class="card-body">
        <form action="{{ route('backend.user.profile.update',$user->id) }}" method="POSt">
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="mb-3">
                <label for="user_name">User Name</label>
                <input type="text" class="form-control" value="{{ $user->username }}" id="user_name" name="user_name" readonly>
              </div>
              <div class="mb-3">
                <label for="old_password">Old Password <span class="text-danger">*</span> </label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
                @error('old_password')<span class="text-danger"> {{ $message }} </span>@enderror
              </div>
              <div class="mb-3">
                <label for="new_password">New Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                @error('new_password')<span class="text-danger"> {{ $message }} </span>@enderror
              </div>
              <div class="mb-3">
                <label for="c_password">Conform Password  <span class="text-danger">* (must be same as new password)</span></label>
                <input type="password" class="form-control" id="c_password" name="c_password" required>
                @error('c_password')<span class="text-danger"> {{ $message }} </span>@enderror
              </div>
              <input type="submit" class="btn btn-primary" value="Save" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
