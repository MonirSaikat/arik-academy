@extends('layouts.backend.main')
@section('title','Pending Student')
@section('content')

@php
    $item_id = request()->get('delete');
    
    if($item_id) {
        DB::table('student_admissions')->where('id', $item_id)->delete();
    } else {
    }
@endphp


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Pending Students
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Student</li>
        <li class="breadcrumb-item" aria-current="page">Pending Student</li>
      </ol>
    </div> 
        
        <div class="col-md-12 mt-3">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                    <thead class="bg-primary text-light">
                      <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Birth Certificate No</th>
                        <th>Father Name</th>
                        <th>Father Phone No.</th>
                        <th>Desired Class</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pendingStudents as $key=>$item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->student_name_english }}</td>
                            <td>{{ $item->nid_or_birth_cert }}</td>
                            <td>{{ $item->father_name_english }}</td>
                            <td>{{ $item->father_mobile_no }}</td>
                            <td>{{ $item->class_name }}</td>
                            <td>{{ $item->present_address }}</td>
                            <td>
                                <a class="btn btn-primary me-2" href="">Admit</a>
                                <a class="btn btn-danger" href="?delete=<?= $item->id ?>">Delete</a>
                            </td> 
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
   
    </div>
    
 

@endsection
