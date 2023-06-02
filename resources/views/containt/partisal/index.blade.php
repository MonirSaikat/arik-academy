@extends('containt.layouts.forntend')
@section('main')
    <style>
        .heading {
            height: 40px;
            text-align: center;
            color: white;
            text-transform: uppercase;
            background: #134955;
        }

        .heading h4 {
            color: white;
        }

        .message_box {
            height: 200px;
            overflow: scroll;
            background-color: bisque;
        }
    </style>


    <div id="rs-slider" class="slider-overlay-2">
        <div id="home-slider">
                
                @foreach ($sliders as $key=>$slider)
                    @if($key != 0)
                    <div class="item ">
                        <img src="{{asset('uploads/sliders/'.$slider->photo)}}" alt="aa" height="100px" class="img-fluid" />
                        <div class="slide-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <div class="container text-center">
                                        <h1 class="slider-title" data-animation-in="fadeInLeft" data-animation-out="animate-out">{{$slider->school_name}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
        </div>
    </div>

        <!-- Slider Area End -->

        <div class="rs-services rs-services-style1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('index.principal') }}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/pm_icon.png" class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">Principal Corner</h4>
                                </div>
                            </div>
                        </a>
                    </div>



                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('faculity.staffs') }}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/tp.png" class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">Faculty</h4>
                                </div>
                            </div>
                        </a>
                    </div>



                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('result') }}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/results_icon.png"
                                        class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">Results</h4>
                                </div>
                            </div>
                        </a>
                    </div>



                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('alumni') }}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/alumni.png" class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">Alumni</h4>
                                </div>
                            </div>
                        </a>
                    </div>




                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('gallery') }}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/clubs_icon.png"
                                        class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">Gallery</h4>
                                </div>
                            </div>
                        </a>
                    </div>



                    <div class="col-lg-2 col-md-6">
                        <a href="{{ route('school.worker.froend')}}">
                            <div class="services-item rs-animation-hover">
                                <div class="services-icon">
                                    <img src="https://ndc.edu.bd/themes/notredame/assets/images/info-icon.png"
                                        class="mb-15">
                                </div>
                                <div class="services-desc">
                                    <h4 class="services-title">School staff</h4>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            </div>
        </div>
        <!-- Services End -->

        <!-- PM start -->


        <!--alok-->
        <div class="container" style="margin-bottom: 100px">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1>Head Teacher</h1>
                        @foreach ($principals as $principal)
                        <h4 class="text-center">{{$principal->principal_name}}</h4>
                    @endforeach
                    @foreach ($principals as $principal)
                    <a href="#">
                        {{-- <img src="{{ asset('frontend/assets/images/dpilot.jpg') }}" alt="PRINCIPAL MESSAGE"
                            class="prcplimg">     --}}
                            @if ($loop->first)
                            <img src="{{asset('uploads/prinsipals/'.$principal->photo)}}" width="250px" height="250">
                            @endif
                    </a>
                    @endforeach
                    @foreach ($datas as  $value)
                    @if($loop->first)
                    <p>{{ $value->principal }}</p>
                    @endif
                    @endforeach

                </div>

                <div class="col-md-6 mt-3">

                    <div class="card">
                        <div class="card-header heading">
                            <h4>Message</h4>
                        </div>
                        <div class="card-body message_box">

                            <ul>
                                @foreach ($datas as $key => $value)
                                <li>{{ $value->message }}</li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="card-footer heading">
                            <h4>Message</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <h1>Chairman</h1>
                       @foreach ($chairmans as $key => $chairman)
                        <h4 class="text-center">{{$chairman->chairman_name}}</h4>
                    @endforeach
                    @foreach ($chairmans as $key => $chairman)
                    <a href="#">
                        {{-- <img src="{{ asset('frontend/assets/images/dpilot.jpg') }}" alt="PRINCIPAL MESSAGE"
                            class="prcplimg"> --}}
                            @if ($loop->first)
                            <img src="{{asset('uploads/chairmans/'.$chairman->photo)}}" width="250px" height="250px">
                            @endif
                    </a>
                    @endforeach
                    @foreach ($datas as  $value)
                    <p>{{ $value->chairman }}</p>
                    @endforeach
                </div>
            </div>
        </div>


        {{-- <div class="rs-history sec-spacer">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-4 col-md-12 rs-vertical-bottom mobile-mb-50"> -->
                <div class="col-lg-4 col-md-12 mobile-mb-50">


                    <div class="col-lg-8 col-md-8">
                        <div class="abt-title">
                            <h2>Principal Message</h2>
                        </div>
                        <div class="about-desc">
                            <p style="text-align: justify;">Welcome to <strong>Notre Dame College</strong><p style="text-align: justify;">Our approach is student-centered and we believe that the approach to motivating and getting the best out of the student is based on the positive reinforcement of good work and good behavior. Our endeavor will be to ensure that student grow in their full potential and be competent to take responsibility in all walks of life. We teach our student that nothing worthwhile can be achieved without a sense of discipline and we expect our student to conform to high disciplinary standards and cherish the values of tolerance, compassion, respect, obedient and independent thinking.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><strong>Dr. Father Hemanto Pius Rozario, CSC</strong><br>Principal<br>Notre Dame College, Dhaka</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}



        <!-- About Us Start -->
        <div id="rs-about" class="rs-about sec-spacer sec-color">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="about-desc"> 
                            <h3>Arik Academy</h3>
                            <p></p>
                        </div>

                        <div id="accordion" class="rs-accordion-style1">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h3 class="acdn-title" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        School History
                                    </h3>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">

                                        @foreach ($data as $key => $datas)
                                        @if($loop->first)
                                            <p style="text-align: justify;">{{ $datas->history }}</p>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="sidebar-area">
                            <div class="latest-courses">
                                <h3 class="title">Notice Board</h3>
                                @foreach ($notices as  $notice)
                                <div class="post-item">

                                    <div class="post-img">

                                        <a href="#" target="_blank"><img style="width:130px; height: 100px;"
                                                src="https://ndc.edu.bd/themes/notredame/assets/images/pdf-icon.png"
                                                alt="" title="News image"></a>

                                        </div>


                                    <div class="post-desc notice-details">
                                        <h4>
                                  <a href="{{route('download',$notice->id)}}" target="_blank">{{$notice->description}} Viwe/Download</a>

                                  </h4>
                                        <span class="price"> <span><i class="fa fa-calendar" aria-hidden="true"></i>Date:
                                        {{date('Y-m-d')}}</span></span>
                                        ...

                                    </div>

                                </div>
                                @endforeach


                                {{-- <div style="text-align: right; margin-top: 10px;"><a href="#" class="vr_btn">More
                                        Notice</a></div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Us End -->

        <!-- Counter Up Section Start-->
        <div class="rs-counter pt-100 pb-70 bg3">
            <div class="container">
                @foreach ($phones as $key =>$data)
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            {{-- @foreach ($phones as $key =>$data) --}}
                            @if($loop->first)
                            <h2 class="counter-title">{{ $data->school_name }}</h2>
                            @endif
                            {{-- @endforeach --}}
                            <p>

                            </p>
                        </center>
                    </div>
                    {{-- <div class="col-lg-6 col-md-12">
                        <div class="counter-content">
                            <div class="counter-img rs-image-effect-shine">
                                @foreach ($logos as $key => $logo)
                                <img src="{{asset('uploads/logos/'.$logo->photo)}}" height="250px" width="250px">
                                @endforeach
                            </div>
                        </div>
                    </div>  --}}
                    <div class="col-lg-12 col-md-6">
                        <div class="row">
                            @if($loop->first)
                            <div class="col-md-6">
                                <div class="rs-counter-list">
                                    <h2 class="counter-number plus">{{$data->teacher}}</h2>
                                    <h4 class="counter-desc">TEACHERS</h4>
                                </div>
                            </div>
                            @endif
                            @if($loop->first)
                            <div class="col-md-6">
                                <div class="rs-counter-list">
                                    <h2 class="counter-number plus">{{$data->year}}</h2>
                                    <h4 class="counter-desc">Years</h4>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($loop->first)
                            <div class="col-md-6">
                                <div class="rs-counter-list">
                                    <h2 class="counter-number plus">{{$data->student}}</h2>
                                    <h4 class="counter-desc">STUDENTS</h4>
                                </div>
                            </div>
                            @endif
                            @if($loop->first)
                            <div class="col-md-6">
                                <div class="rs-counter-list">

                                    <h2 class="counter-number plus">{{$data->buliding}}</h2>

                                    <h4 class="counter-desc">Building</h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Counter Down Section End -->

        <!-- Events Start -->
        <div id="rs-events" class="rs-events sec-spacer education_bg">
            <div class="container">
                <div class="sec-title mb-50 text-center">
                    <h2>Recent and Upcoming Events</h2>
                    <p>I feel the presence of the Almighty, who formed us in his own image, and the breath.</p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30"
                            data-autoplay="false" data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="true"
                            data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                            data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="true"
                            data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true"
                            data-md-device-dots="true">


{{--
                            <div class="event-item">
                                <div class="event-img">
                                    <img src="{{ asset('frontend/assets/images/a.jpg') }}" alt="" />
                                    <a class="image-link"
                                        href="https://ndc.edu.bd/news/details/distribute-goods-among-flood-victims"
                                        title="Distribute goods among the flood victims">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                                <div class="events-details sec-color">
                                    <div class="event-date">
                                        <i class="fa fa-calendar"></i>
                                        <span>July 1, 2022</span>
                                    </div>
                                    <h4 class="event-title"><a
                                            href="https://ndc.edu.bd/news/details/distribute-goods-among-flood-victims">Distribute
                                            goods among the flood victims</a></h4>
                                </div>
                            </div>


                            <div class="event-item">
                                <div class="event-img">
                                    <img src="{{ asset('frontend/assets/images/a.jpg') }}" alt="" />
                                    <a class="image-link" href="https://ndc.edu.bd/news/details/March-26"
                                        title="স্বাধীনতা দিবস">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                                <div class="events-details sec-color">
                                    <div class="event-date">
                                        <i class="fa fa-calendar"></i>
                                        <span>June 8, 2022</span>
                                    </div>
                                    <h4 class="event-title"><a href="https://ndc.edu.bd/news/details/March-26">স্বাধীনতা
                                            দিবস</a></h4>
                                </div>
                            </div> --}}

{{--
                            <div class="event-item">
                                <div class="event-img">
                                    <img src="{{ asset('frontend/assets/images/a.jpg') }}" alt="" />
                                    <a class="image-link" href="https://ndc.edu.bd/news/details/February-21"
                                        title="শহীদ দিবস">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                                <div class="events-details sec-color">
                                    <div class="event-date">
                                        <i class="fa fa-calendar"></i>
                                        <span>June 6, 2022</span>
                                    </div>
                                    <h4 class="event-title"><a href="https://ndc.edu.bd/news/details/February-21">শহীদ
                                            দিবস</a></h4>
                                </div>
                            </div>


                            <div class="event-item">
                                <div class="event-img">
                                    <img src="{{ asset('frontend/assets/images/a.jpg') }}" alt="" />
                                    <a class="image-link" href="https://ndc.edu.bd/news/details/nobin-boron-2022"
                                        title="Nobin Boron - 2022">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                                <div class="events-details sec-color">
                                    <div class="event-date">
                                        <i class="fa fa-calendar"></i>
                                        <span>June 6, 2022</span>
                                    </div>
                                    <h4 class="event-title"><a
                                            href="https://ndc.edu.bd/news/details/nobin-boron-2022">Nobin Boron - 2022</a>
                                    </h4>
                                </div>
                            </div> --}}


                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    <!-- Events End -->
