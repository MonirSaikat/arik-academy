@extends('layouts.backend.main')
@section('content')
    <div class="row mt-3">
        <h2 class="text-center">Edit School History</h2>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{ route('school.history.edit', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="history" class="form-label">Description</label>
                    <textarea id="history" name="history" class="form-control @error('history') is-invalid @enderror" rows="20">{{ $data->history }}</textarea>
                    @error('history')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
@endsection
