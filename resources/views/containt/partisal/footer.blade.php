<div class="container">
    <!-- Footer Address -->
    <div>
        <div class="row footer-contact-desc">
            <div class="col-md-4">
                @foreach ($phones as $data)
                @if($loop->first)
                <div class="contact-inner">
                        <i class="fa fa-map-marker"></i>
                        <h4 class="contact-title">Address</h4>
                        <p class="contact-desc text-center text-white"> 
                            <h4 class="text-white">{{ $data->address }}</h4>        
                        </p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-4">
                @foreach ($phones as $data)
                @if($loop->first)
                <div class="contact-inner">
                    <i class="fa fa-phone"></i>
                    <h4 class="contact-title">Phone Number</h4>
                    <p class="contact-desc text-white">
                        <h4 class="text-white">{{ $data->phone }}</h4>
                      
                    </p>
                </div>
                @endif
                @endforeach
            </div>
            <div class="col-md-4">
                @foreach ($phones as $data)
                @if($loop->first)
                <div class="contact-inner">
                    <i class="fa fa-map-marker"></i>
                    <h4 class="contact-title">Email Address</h4>
                    <p class="contact-desc text-white">
                        <h4 class="text-white">{{$data->email}}</h4>    
                    </p>
                </div>
                @endif
                @endforeach
            </div>
        </div>					
    </div>
</div>

<!-- Footer Top -->
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-12"></div>
            <div class="col-lg-4 col-md-12">
                @foreach ($logos as $key => $logo)
                <div class="about-widget">
                    {{-- <img src="{{asset('frontend/assets/images/logo.jpg')}}" alt="Footer Logo"> --}}
                    @if($loop->first)
                    <img src="{{asset('uploads/logos/'.$logo->photo)}}" width="250px">
                    @endif
                    <p></p>
                </div>
                @endforeach
            </div>
            
            <div class="col-lg-4 col-md-12">
                <h5 class="footer-title">OUR SITEMAP</h5>
                <ul class="sitemap-widget">
                    <li class="active"><a href="{{route('index')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Home</a></li>
                    <li ><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>About</a></li>
                    <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Admission Information</a></li>
                    {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>News & Events</a></li> --}}
                    {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Why Study At NDC</a></li> --}}
                    <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Governing Body</a></li>
                    <!-- <li><a href="https://ndc.edu.bd/administration"><i class="fa fa-angle-right" aria-hidden="true"></i>Administrations</a></li> -->
                    {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Holy Cross</a></li> --}}
                    {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Alumni</a></li> --}}
                    <li><a href="{{route('faculity.staffs')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Faculty & Staff</a></li>
                    <li><a href="{{route('gallery')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Gallery</li>  
                    <li><a href="{{route('result')}}"><i class="fa fa-angle-right" aria-hidden="true"></i>Result</li>                             
                    <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-12"></div>
            <!-- <div class="col-lg-4 col-md-12">
                <h5 class="footer-title">NEWSLETTER</h5>
                <p>Sign Up to Our Newsletter to Get Latest Updates &amp; Services</p>
                <form class="news-form">
                    <input type="text" class="form-input" placeholder="Enter Your Email">
                    <button type="submit" class="form-button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </form>
            </div> -->
        </div>
        <div class="footer-share">
            {{-- <ul>  
                <li><a href="" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li><a href="" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            </ul> --}}
        </div>                                
    </div>
</div>

<!-- Footer Bottom -->
<div class="footer-bottom">
    <div class="container">
        <div class="copyright">
            <p>©<?= date('Y') ?> Arik Academy, Rangpur. All Rights Reserved. Powered By ITDEAL. <a href="#"></a>.</p>
        </div>
    </div>
</div>