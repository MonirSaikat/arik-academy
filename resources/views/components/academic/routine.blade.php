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
                      <option value="{{ $item->id }}" {{ $item->id == $class_id ? 'selected' : '' }}>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="class">Section</label>
                  <select name="section_id" id="section_id" class="form-control selectpicker" data-live-search="true"
                    title="select section">
                    @foreach ($sections as $item)
                      <option value="{{ $item->id }}" {{ $item->id == $section_id ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                    @endforeach
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
      @if ($class_id)
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs" id="routine-tab" role="tablist">
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link tab-active" id="saturday-tab" data-toggle="tab" data-target="#saturday"
                    type="button" role="tab" aria-controls="saturday" aria-selected="true">SATURDAY</button>
                </li>
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link" id="sunday-tab" data-toggle="tab" data-target="#sunday" type="button"
                    role="tab" aria-controls="sunday" aria-selected="false">SUNDAY</button>
                </li>
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link" id="monday-tab" data-toggle="tab" data-target="#monday" type="button"
                    role="tab" aria-controls="monday" aria-selected="false">MONDAY</button>
                </li>
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link" id="tuesday-tab" data-toggle="tab" data-target="#tuesday" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">TUSADAY</button>
                </li>
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link" id="wednesday-tab" data-toggle="tab" data-target="#wednesday" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">WEDNESDAY</button>
                </li>
                <li class="nav-item mr-1" role="presentation">
                  <button class="nav-link" id="thursday-tab" data-toggle="tab" data-target="#thursday" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">THURSDAY</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="friday-tab" data-toggle="tab" data-target="#friday" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">FRIDAY</button>
                </li>
                <button class="btn btn-info" style="position: absolute;right: 0;"><i class="fa fa-plus-circle mr-2"></i>Add</button>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show mt-3" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="thursday" role="tabpanel" aria-labelledby="thusrsday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="tab-pane fade show mt-3" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                  <table class="table bg-light" style="border-bottom:2px solid blue">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>start Time</th>
                        <th>End Time</th>
                        <th>Is Break</th>
                        <th>Other Day</th>
                        <th>Class Room</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      @endif

    </div>
  </div>


@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Add a click event listener to each tab
      $('#tab1, #tab2, #tab3').click(function(e) {
        e.preventDefault(); // Prevent the default behavior of the link
        var tabId = $(this).attr('id'); // Get the ID of the clicked tab
        $(this).addClass('active'); // Add the active class to the clicked tab
        $(this).siblings().removeClass('active'); // Remove the active class from other tabs
        // You can perform additional actions based on the clicked tab ID
        // For example, show/hide corresponding content
        if (tabId === 'tab1') {
          // Show content for tab 1
        } else if (tabId === 'tab2') {
          // Show content for tab 2
        } else if (tabId === 'tab3') {
          // Show content for tab 3
        }
      });
    });

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
