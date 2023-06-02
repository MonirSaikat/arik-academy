<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <title>{{ $settings->school_name ?? '' }}</title>
    <meta name="description" content="">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.html">
    <link rel="shortcut icon" type="image/x-icon" href="https://ndc.edu.bd/themes/notredame/assets/images/fav.png">
    <!-- bootstrap v4 css -->
    {{-- <link rel="stylesheet" type="text/css"  href="{{asset('backend/assets/done/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/bootstrap.min.css" <!--
        font-awesome css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/font-awesome.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/font-awesome.min.css">
    <!-- animate css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/animate.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/animate.css">
    <!-- owl.carousel css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/owl.carousel.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/owl.carousel.css">
    <!-- slick css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/slick.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/slick.css">
    <!-- magnific popup css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/magnific-popup.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/magnific-popup.css">
    <!-- Offcanvas CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/off-canvas.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/off-canvas.css">
    <!-- flaticon css  -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/flaticon.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/fonts/flaticon.css">
    <!-- flaticon2 css  -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/flaticon.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/fonts/fonts2/flaticon.css">
    <!-- rsmenu CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/rsmenu-main.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/rsmenu-main.css">
    <!-- rsmenu transitions CSS -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/rsmenu-transitions.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/rsmenu-transitions.css">
    <!-- style css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/style.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/style.css">
    <!-- responsive css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/done/responsive.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="https://ndc.edu.bd/themes/notredame/assets/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <style type="text/css">
        /*.rs-team-2 .team-item .team-body .name {
                color: #fff;
            }

            .rs-team-2 .team-item .team-body .designation {
                color: #fff;
            }*/
        .faculty_container {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
        }

        .rs-team-2 .team-item .team-body {
            padding: 0 0 15px 0;
        }

        .sec-spacer {
            padding: 50px 0;
        }

        .rs-team-2.team-page {
            padding-top: 50px;
        }

        .rs-team-2 .team-item .team-body {
            padding: 15px 0 15px 0;
        }

        h1 {
            text-align: center;
        }
    </style>

</head>

<body class="home1">



    <!--Full width header Start-->
    <div class="full-width-header">

        <!-- Toolbar Start -->
        <div class="rs-toolbar ">
            <div class="container">
                <div class="row pt-10 ">
                    <div class="col-md-4 col-5">
                        <div class="rs-toolbar-left">
                            <a href="{{ route('apply_online') }}" class="Aply_btn">Apply Online</a>
                        </div>
                    </div>

                    <!--start code for scrolling -->
                    <div class="col-md-4 col-7">
                        <marquee behavior="scroll" direction="left" onmouseover="this.stop();"
                            onmouseleave="this.start();">

                            <table class="border-0">
                                <tr>
                                    <td class="border-0">
                                        @foreach ($notices as $notice)
                                            <a href="{{ asset('uploads/notices/' . $notice->file) }}" target="_blank">
                                                {{ $notice->description }} </a> &nbsp; &nbsp; &nbsp;
                                        @endforeach
                                    </td>



                                    {{-- <td class="border-0">

	                                    	<a href="#" target="_blank"> ২০২২ শিক্ষাবর্ষে  ভর্তি নিশ্চয়ন সম্পর্কিত বিজ্ঞপ্তি </a> &nbsp; &nbsp; &nbsp;</td>


                        			<td class="border-0">

	                                <a href="#" target="_blank"> রকেট ও নেক্সাস পে -এর মাধ্যমে টিউশন ফি প্রদানের পদ্ধতি </a> &nbsp; &nbsp; &nbsp;

	                                    	                                </td> --}}

                                    <!-- ### Notice End ### -->

                                </tr>

                            </table>

                        </marquee>
                    </div>
                    <!--end code for scrolling-->

                    <div class="col-md-4 col-12">
                        <div class="rs-toolbar-right">
                            <div class="toolbar-share-icon">
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Toolbar End -->

        <!--Header Start-->
        <header id="rs-header" class="rs-header">

            @include('containt.partisal.header')

        </header>
        <!--Header End-->

    </div>
    <!--Full width header End-->

    <style type="text/css">
        .notice-details p {
            margin: 0px;
            font-size: 15px;
        }
    </style>

    @yield('main')
    <!-- Footer Start -->
    <footer style="margin-top: 150px;" id="rs-footer" class="bg3 rs-footer">
        @include('containt.partisal.footer')
    </footer>
    <!-- Footer End -->

    <!-- start scrollUp  -->
    <div id="scrollUp">
        <i class="fa fa-angle-up"></i>
    </div>

    <!-- Canvas Menu start -->
    <nav class="right_menu_togle">
        <div class="close-btn"><span id="nav-close" class="text-center">x</span></div>
        <div class="canvas-logo">
            <a href="https://ndc.edu.bd"><img src="https://ndc.edu.bd/themes/notredame/assets/images/logo.png"
                    alt="logo"></a>
        </div>
        <ul class="sidebarnav_menu list-unstyled main-menu">
            <!--Home Menu Start-->
            <li class="current-menu-item"><a href="{{ route('index') }}">Home</a></li>
            <!--Home Menu End-->

            <!--About Menu Start-->
            <li class=""><a href="https://ndc.edu.bd/glance">About Us</a></li>
            <!--About Menu End-->

            <!--News Menu Star-->
            <li class="menu-item-has-children"><a href="#">News & Notice</a>
                <ul class="list-unstyled">
                    <li class="sub-nav"><a href="https://ndc.edu.bd/news">News<span class="icon"></span></a></li>
                    <li class="sub-nav"><a href="https://ndc.edu.bd/notice-lists">Notice<span
                                class="icon"></span></a></li>
                </ul>
            </li>
            <!--News Menu End-->

            <li><a href="https://ndc.edu.bd/governingbody">Governing Body</a></li>

            <li><a href="https://ndc.edu.bd/alumni">Alumni</a></li>
            <li><a href="https://ndc.edu.bd/department">Faculty & Staff</a></li>
            <li><a href="https://ndc.edu.bd/contact">Contact<span class="icon"></span></a></li>
        </ul>
    </nav>
    <!-- Canvas Menu end -->

    <!-- Search Modal Start -->
    <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="fa fa-close"></span>
        </button>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="search-block clearfix">
                    <form action="https://ndc.edu.bd/search-result" method="get">
                        <div class="form-group">
                            <input class="form-control" placeholder="Search..." type="text" name="q">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Modal End -->
    <!-- JS -->

    <!-- modernizr js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/modernizr-2.8.3.min.js"></script>
    <!-- jquery latest version -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/owl.carousel.min.js"></script>
    <!-- slick.min js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/slick.min.js"></script>
    <!-- isotope.pkgd.min js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- wow js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/wow.min.js"></script>
    <!-- counter top js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/waypoints.min.js"></script>
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/jquery.counterup.min.js"></script>
    <!-- magnific popup -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- rsmenu js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/rsmenu-main.js"></script>
    <!-- plugins js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/plugins.js"></script>
    <!-- main js -->
    <script src="https://ndc.edu.bd/themes/notredame/assets/js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/v4-font-face.min.css"
        integrity="sha512-ueEJBIkl0DBM2fA8eS/o12U3l+ZUFn32IUY4jIaTZnNtKR4ktQw3cE/tx/tFIYJuBm4EVT7WUMqIXP1TUN0boA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="/modules/system/assets/js/framework.js"></script>
    <script src="/modules/system/assets/js/framework.extras.js"></script>
    <link rel="stylesheet" property="stylesheet" href="/modules/system/assets/css/framework.extras.css">




</body>

</html>
