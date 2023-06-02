@extends('layouts.backend.main')
@section('title','Fee Invoice')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Fee Invoice
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fee Invoice</li>
      </ol>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">

            <div class="card mb-4 p-4">
                <form action="{{ route('backend.fee.invoice.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="fee_title">Fee Title *</label>
                        <input type="text" name="fee_title" class="form-control" id="fee_title" required>
                    </div>


                    <button type="submit" class="btn btn-success mt-2">Save</button>
                </form>
            </div>


          </div>
    </div>
</div>









@endsection

@push('js')

    <script>

            
    </script>
@endpush
