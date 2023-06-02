
@extends('containt.layouts.forntend')
@section('main')

<div id="rs-team-2" class="rs-team-2 team-page sec-spacer">
    <div class="container">
        <div class="faculty_container">
            <div class="sec-title mb-50 text-center">
                <h1>School Gallery</h1>
            </div>
            <div class="row justify-content-md-center">
                @foreach ($gallerys as  $gallery)
                <div class="card" style="width: 15rem;">
                    <img src="{{asset('uploads/gallerys/'.$gallery->photo)}}" width="300px" height="300px">
                    {{-- <div class="card-body">
                      <h5 class="card-title text-center">Name:{{ $staffs->name }}</h5>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div> --}}
                  </div>
                  @endforeach
            </div>
        </div>

   
@endsection
