@extends('layouts.backend.main')
@section('title', 'Home Work')
@section('content')


  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Home Work
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Home Work</li>
      </ol>
    </div>


    <div class="row mt-3">
      <div class="col-md-12 mb-3">
        <form action="{{ route('backend.home_work.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="class_id">Class</label><span class="ml-2">*</span>
              <select name="class_id" id="class_id" class="form-control selectpicker" data-live-search="true"
                title="Select Class" onchange="getSection(this.value)">
                @foreach (App\Models\Academic\Classes::where('is_active', 1)->get() as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
              <span class="text-light">
                @error('class_id')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3" id="group" style="display: none">
              <label for="group_id">Group</label><span class="ml-2">*</span>
              <select name="group_id" id="group_id" class="form-control selectpicker" data-live-search="true"
                title="Select Group">

              </select>
              <span class="text-light">
                @error('group_id')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3" id="section" style="display: none">
              <label for="section_id">Section</label><span class="ml-2">*</span>
              <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true"
                title="Select Section">

              </select>
              <span class="text-light">
                @error('section_id')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="subject_id">Subject</label><span class="ml-2">*</span>
              <select name="subject_id" id="subject_id" class="form-control selectpicker" data-live-search="true"
                title="Select Subject">
                
              </select>
              <span class="text-light">
                @error('subject_id')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="homework_date">Homework Date</label><span class="ml-2">*</span>
              <input type="date" name="homework_date" class="form-control" id="homework_date" value="{{ date('Y-m-d') }}" >
              </select>
              <span class="text-light">
                @error('homework_date')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="submission_date">Submission Date</label><span class="ml-2">*</span>
              <input type="date" name="submission_date" class="form-control" id="submission_date" value="{{ date('Y-m-d') }}" >
              </select>
              <span class="text-light">
                @error('submission_date')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="mark">Marks</label><span class="ml-2">*</span>
              <input type="text" name="mark" id="mark" class="form-control" placeholder="Enter Marks" required >
              </select>
              <span class="text-light">
                @error('mark')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3 mb-3">
              <label for="file">Attach File</label><span class="ml-2">*</span>
              <input type="file" name="file" id="file" class="form-control" >
              </select>
              <span class="text-light">
                @error('file')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="col-md-3">
              <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>

@php
    $subjects = DB::table('subjects')
        ->join('subject_assign_classes','subject_assign_classes.subject_id','subjects.id')
        ->get();
@endphp
@endsection

@push('js')
  <script>
    const section = @json($section);
    const group = @json($group);
    const subjects = @json($subjects);

    function getSection(id) {
      if (id) {
        $('#section_id').html(null);
        $('#section_id').append('<option value="" hidden>Select Section</option>');
        var i = 0;
        section.filter(function(item) {
          if ((item.class_id == id)) {
            return item;

          }
        }).map(function(item) {
          $('#section_id').append(`<option value="${item.id}">${item.name}</option>`);
          i++;
        });

        if (i != 0) {
          $('#section').css('display', 'block');
        } else {
          $('#section').css('display', 'none');
        }
        $('#section_id').val(0);
        $('#section_id').selectpicker("refresh");


        $('#group_id').html(null);
        $('#group_id').append('<option value="" hidden>Select Group</option>');
        var j = 0;
        group.filter(function(item) {
          if ((item.class_id == id)) {
            return item;
          }
        }).map(function(item) {
          $('#group_id').append(`<option value="${item.id}">${item.name}</option>`);
          j++;
        });
        if (j != 0) {
          $('#group').css('display', 'block');
        } else {
          $('#group').css('display', 'none');
        }
        $('#group_id').val(0);
        $('#group_id').selectpicker("refresh");

        $('#subject_id').html(null);
        subjects.filter(function(item) {
          if ((item.class_id == id)) {
            return item;
          }
        }).map(function(item) {
          $('#subject_id').append(`<option value="${item.subject_id}">${item.name}</option>`);
        });
        $('#subject_id').val(0);
        $('#subject_id').selectpicker("refresh");
      }
    }
  </script>
@endpush
