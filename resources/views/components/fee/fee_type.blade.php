@extends('layouts.backend.main')
@section('title','Fee Group')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Fee Type
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fee Type</li>
      </ol>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">

            <div class="card mb-4 p-4">
                <form action="{{ route('backend.fee.type.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="fee_type_title">Fee Type Title *</label>
                        <input type="text" name="fee_type_title" class="form-control" id="fee_type_title" required>
                    </div>
                    <div class="form-group">
                        <label for="fee_group_title_id">Fee Group *</label>
                        <select name="fee_group_title_id" title="select group title" live-data-search="true" class="form-control selectpicker" id="fee_group_title_id">
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}">{{ $item->group_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fee_code">Fee Code *</label>
                        <input type="text" name="fee_code" class="form-control" id="fee_code" required>
                    </div>
                    <div class="form-group">
                        <label for="fee_description">Fee Description</label>
                        <textarea name="fee_description" id="fee_description" class="form-control">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="fee_amount">Fee Amount *</label>
                        <input type="text" name="fee_amount" class="form-control" id="fee_amount" required>
                    </div>
                    <div class="form-group">
                        <label for="fee_amount">Fee Schedule *</label>
                        @foreach ($schedule as $key=>$val)
                            <div class="form-group ml-5">
                                <input class="form-check-input mr-2" type="radio" name="fee_schedule" value="{{ $val->time }}" id="{{ $key }}">
                                <label for="{{ $key }}" class="ml-2">{{ $val->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            <h5>Fee Schedule</h5>
                        </div>
                        <div class="card-body" id="schedule_body">

                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Save</button>
                </form>
            </div>

            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="bg-primary text-light">
                    <tr>
                      <th>Sl</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Prefix</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

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

        $('input[name=fee_schedule]').on('change',function(){

            let count = $(this).val();
            $('#schedule_body').html('');

            if(count == 0){
                $('#schedule_body').html(`
                    <div class="row">
                        <h4 class="text-center text-muted">No Date Available </h4>
                    </div>
                `);
            }else if(count == 1){

                $('#schedule_body').html(`
                    <div class="row">
                        <div class="col-md-6">
                            <label>Fixed Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Due Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>
                `);

            }else{

                function dateName(ind){
                    let arr = ['First','Second','Third','Fourth','Fifth','Sixth','Seventh','Eighth','Ninth','Tenth','Eleventh','Twelveth'];
                    return arr[ind];
                }
                let schedule_row = ''

                for(let i=0;i<count;i++){
                    schedule_row += `
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>${dateName(i)} Date</label>
                                <input type="date" name="start_date[]" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Due Date</label>
                                <input type="date" name="end_date[]" class="form-control">
                            </div>
                        </div>
                    `
                }

                $('#schedule_body').html(schedule_row);
            }
        })

    </script>
@endpush
