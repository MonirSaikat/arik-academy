@extends('layouts.backend.main')
@section('title','Id Card')
@section('content')
<style>
    .style-font{
        font-family: 'Sofia';
    }
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Id Card
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Seat Plan</li>
      </ol>
    </div>
    
    
    <div class="row mt-3">
        <div class="col-md-12 mb-3">
            <form action="{{ route('backend.id_card.index') }}" method="GET" target="_blank">
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="class_id">Class</label><span class="ml-2">*</span>
                    <select name="class_id" id="class_id" required class="form-control selectpicker" data-live-search="true" title="Select Class" onchange="getSection(this.value)">
                        @foreach (App\Models\Academic\Classes::where('is_active',1)->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-light">@error('class_id'){{ $message }}@enderror</span>
                  </div>
                  <div class="col-md-3">
                      <input type="submit" class="btn btn-primary" value="Search" style="margin-top: 30px">
                  </div>
                </div>
            </form>
        </div>
    </div>
    
</div>


@endsection

@push('js')

    <script>
       
        

        
    </script>
@endpush
