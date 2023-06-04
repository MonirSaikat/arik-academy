@extends('layouts.backend.main')
@section('title', 'Routine')
@section('content')


  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Routine
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Routine</li>
      </ol>
    </div>

    <div class="row mt-3">
      <div class="col-lg-12">
        <h5>Select Criteria</h5>
        <div class="card my-3">
          <form action="{{ route('backend.routine.index') }}" method="GET">
            <div class="row p-3">
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="class">Class</label>
                  <select name="class_id" id="class_id" class="form-control selectpicker" data-live-search="true"
                    title="select class">
                    @foreach ($class as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="class">Section</label>
                  <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true"
                    title="select section">

                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <label for="" style="height: 45px"></label>
                <input type="submit" class="btn btn-info" value="Search">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

@push('js')
  <script>
    $('#class_id').on('change', function() {
      $.get("/authority/academic/routine/getSection/" + $(this).val(),
        function(data) {
          $('#section_id').html(null);
          $('#section_id').append('<option value="" hidden>Select Section</option>');
          data.map(function(item) {
            $('#section_id').append(`<option value="${item.id}">${item.name}</option>`);
          });
          $('#section_id').val(0);
          $('#section_id').selectpicker("refresh");
        }
      );
    });
  </script>
@endpush
