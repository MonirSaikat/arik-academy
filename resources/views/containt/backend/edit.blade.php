@extends('layouts.backend.main')
@section('content')
<div class="row mt-3">
    <h2 class="text-center">Edit Message</h2>
      <div class="col-md-3"></div>
      <div class="col-md-6">
          <form action="{{route('edit.message',$value->id)}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
      <label for="principal" class="form-label">Principal Message</label>
      <input type="text" class="form-control @error('principal') is-invalid @enderror" id="principal" name="principal" value="{{$value->principal}}">
      @error('principal')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
    </div>
      <div class="mb-3">
      <label for="chairman" class="form-label">Chairman Message</label>
      <input type="text" class="form-control @error('chairman') is-invalid @enderror" id="chairman" name="chairman" value="{{$value->chairman}}">
       @error('chairman')
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="5">{{$value->message}}</textarea>
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
      </div>
      
  </div>
@endsection