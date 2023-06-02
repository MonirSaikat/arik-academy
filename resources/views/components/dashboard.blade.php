@extends('layouts.backend.main')

@section('content')
    @php
        $lang = session()->get('language');
        app()->setLocale($lang);
    @endphp
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('breadcrumb.dashboard') }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Students</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_students }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-graduate fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Groups</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_groups }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Sections</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sections }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Subjects</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_subjects }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book-open fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Class</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_classes }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Rooms</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_rooms }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-home fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--Row-->
    </div>
@endsection
