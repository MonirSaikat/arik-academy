@extends('layouts.backend.main')
@section('title','General Setting')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        General Setting
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">General Setting</li>
      </ol>
    </div>
    <form action="{{ route('backend.setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-3 w-50 mx-auto">
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $general_setting->name }}">
                </div>
                <div class="mb-3">
                    <label for="eiin_no">EIIN No</label>
                    <input type="text" name="eiin_no" id="eiin_no" class="form-control" value="{{ $general_setting->eiin_no }}">
                </div>
                <div class="mb-3">
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ $general_setting->code }}">
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ $general_setting->address }}">
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $general_setting->phone }}">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $general_setting->email }}">
                </div>
                <div class="mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                    @if($general_setting->logo)
                    <img src="{{ asset('public/Image/Setting/'.$general_setting->logo) }}" alt="Logo" width="50px" height="50px">
                    @endif
                </div>
                <input type="submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>

@endsection

@push('js')
@endpush
