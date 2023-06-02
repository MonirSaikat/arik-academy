@extends('containt.layouts.forntend')
@section('main')
<div class="single-blog-details sec-spacer">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8 col-md-12">
                <div class="sec-title mb-50 text-center">
                    <h1>PRINCIPAL MESSAGE</h1>   
                </div>
            </div>
            @foreach ($principals as $key =>$principal)
            <div class="col-lg-8 col-md-12">
                <div class="single-image text-center">
                    @if($loop->first)
                    <img src="{{asset('uploads/prinsipals/'.$principal->photo)}}" width="300px" height="200px">
                    @endif
                </div>
                <p>
                    @if($loop->first)
                    {{ $principal->description }}
                    @endif
                </p>
    
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection