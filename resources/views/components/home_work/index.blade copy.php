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
        <form action="{{ route('backend.home_work.index') }}" method="GET">
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
            <div class="col-md-3">
              <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
            </div>
          </div>
        </form>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Home Work</h3>
          </div>
          <div class="card-body">
            <table class="table table-striped" id="dataTableHover">
              <thead>
                <tr>
                  <th>SL</th>
                  <th>Class</th>
                  <th>Subject</th>
                  <th>Home Work Date</th>
                  <th>Submission Date</th>
                  <th>Document</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($homework as $key => $item)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->class->name ?? 'N/A' }}</td>
                    <td>{{ $item->subject ?? 'N/A' }}</td>
                    <td>{{ $item->homework_date }}</td>
                    <td>{{ $item->submission_date }}</td>
                    <td class="d-flex"><a href="{{ route('backend.home_work.pdf.show', $item->file) }}"> <i class="fa fa-file-pdf"></i>
                        {{ $item->file }}</a></td>
                    @if ($item->is_active == true)
                      <td><span class="badge bg-info text-light">Active</span></td>
                    @else
                      <td><span class="badge bg-danger text-light">Active</span></td>
                    @endif
                    <td>
                      <div class="dropdown">
                        <a class="dropdown-toggle btn btn-info" href="#" role="button" data-toggle="dropdown"
                          aria-expanded="false">
                          Action
                        </a>
                        <div class="dropdown-menu">
                          @if (userHasPermission('homework-update'))
                            <a class="dropdown-item" href="{{ route('backend.home_work.edit',$item->id) }}"><i class="fas fa-edit mr-2"></i> Edit</a>
                          @endif
                          @if (userHasPermission('homework-delete'))
                            <a class="dropdown-item text-danger"
                              href="{{ route('backend.income.delete', $item->id) }}"
                              onclick="return confirm('Are you sure to delete this data..??')"><i
                                class="fas fa-trash mr-2"></i>Delete</a>
                          @endif
                        </div>
                      </div>
                    </td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>


@endsection

@push('js')
  <script>
    const section = @json($section);
    const group = @json($group);

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
      }
    }
  </script>
@endpush
