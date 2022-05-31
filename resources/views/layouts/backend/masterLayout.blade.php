<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('pagetitle')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('backendAssets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('backendAssets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('backendAssets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('backendAssets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('backendAssets/css/theme.css') }}" rel="stylesheet" media="all">
    
    <!-- Data Table js -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.17.2/full/ckeditor.js"></script>
   
    <!-- Year Picker - DatePicker-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


</head>

<body class="animsition">
    <div class="page-wrapper">
        
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block ">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="{{ route('dashboard') }}">
                            <h2 style="color:white;cursor:pointer;">Kanun</h2>
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <span class="bot-line"></span>Home</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminInfo') }}">
                                    <i class="fas fa-gear"></i>
                                    <span class="bot-line"></span>Info</a>
                            </li>
                            <li>
                                <a href="{{route('AdminGallery')}}">
                                    <i class="fas fa-picture-o"></i>
                                    <span class="bot-line"></span>Gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminCaseStudy') }}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <span class="bot-line"></span>Case Study</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminBlog') }}">
                                    <i class="fas fa-file-text"></i>
                                    <span class="bot-line"></span>Blog</a>
                            </li>
                            <li>
                                <a href="{{route('AdminAppointment')}}">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                    <span class="bot-line"></span>Appointment</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="header__tool">
                        {{-- <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div> --}}

                        @if ($unreadcontact->isNotEmpty())
                            <div class="header-button-item has-noti js-item-menu m-l-20">
                                <i class="fa fa-envelope"></i>
                                <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have Notifications</p>
                                    </div>
                                
                                        @foreach ($unreadcontact as $data)
                                            <a href="{{ route('ContactView', $data->id) }}">
                                                <div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <i class="zmdi zmdi-email-open"></i>
                                                    </div>
                                                    <div class="content">
                                                        <p>{{$data->email}}</p>
                                                        <span class="date">{{$data->created_at->format('d M, Y | h:ia')}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        @endforeach
                                
                                    {{-- <div class="notifi__footer">
                                        <a href="#">All notifications</a>
                                    </div> --}}
                                </div>
                            </div>
                        @else
                            <div class="header-button-item js-item-menu m-l-20">
                                <i class="fa fa-envelope"></i>
                                <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have no Notifications</p>
                                    </div>

                                    {{-- <div class="notifi__footer">
                                        <a href="#">All notifications</a>
                                    </div> --}}
                                </div>
                            </div>
                        @endif
                       

                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu m-l-20">
                                <div class="image">
                                    @if (isset(Auth::user()->image ))
                                        <img src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{  Auth::user()->name }}" />
                                    @else
                                        <img src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg" alt="Profile Picture" />
                                    @endif
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="{{ route('AdminInfo') }}">
                                                @if (isset(Auth::user()->image ))
                                                    <img src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{  Auth::user()->name }}" />
                                                @else
                                                    <img src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg" alt="Profile Picture" />
                                                @endif
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="{{ route('AdminInfo') }}">{{ Auth::user()->name }}</a>
                                            </h5>
                                            <span class="email">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('AdminInfo') }}">
                                                <i class="zmdi zmdi-settings"></i>Info</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="zmdi zmdi-power"></i>Logout</a>                                        
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf                                        
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="">
                            <img src="{{ asset('backendAssets/images/icon/logo-white.png') }}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <span class="bot-line"></span>Home</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminInfo') }}">
                                    <i class="fas fa-gear"></i>
                                    <span class="bot-line"></span>Info</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminGallery')}}">
                                    <i class="fas fa-picture-o"></i>
                                    <span class="bot-line"></span>Gallery</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminCaseStudy') }}">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    <span class="bot-line"></span>Case Study</a>
                            </li>
                            <li>
                                <a href="{{ route('AdminBlog') }}">
                                    <i class="fas fa-file-text"></i>
                                    <span class="bot-line"></span>Blog</a>
                            </li>
                            <li>
                                <a href="{{route('AdminAppointment')}}">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                    <span class="bot-line"></span>Appointment</a>
                            </li>
                    </ul>
                </div>
            </nav>
        </header>


        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                {{-- <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div> --}}

                @if ($unreadcontact->isNotEmpty())
                    <div class="header-button-item has-noti js-item-menu m-l-20">
                        <i class="fa fa-envelope"></i>
                        <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                            <div class="notifi__title">
                                <p>You have Notifications</p>
                            </div>
                        
                                @foreach ($unreadcontact as $data)
                                    <a href="{{ route('ContactView', $data->id) }}">
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>{{$data->email}}</p>
                                                <span class="date">{{$data->created_at->format('d M, Y | h:ia')}}</span>
                                            </div>
                                        </div>
                                    </a>    
                                
                                @endforeach
                        
                            {{-- <div class="notifi__footer">
                                <a href="#">All notifications</a>
                            </div> --}}
                        </div>
                    </div>
                @else
                    <div class="header-button-item js-item-menu m-l-20">
                        <i class="fa fa-envelope"></i>
                        <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                            <div class="notifi__title">
                                <p>You have no Notifications</p>
                            </div>
                            
                            {{-- <div class="notifi__footer">
                                <a href="#">All notifications</a>
                            </div> --}}
                        </div>
                    </div>
                @endif

                <div class="account-wrap">
                    <div class="account-item account-item--style2 clearfix js-item-menu m-l-20">
                        <div class="image">
                            @if (isset(Auth::user()->image ))
                                <img src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{  Auth::user()->name }}" />
                            @else
                                <img src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg" alt="Profile Picture" />
                            @endif
                        </div>
                        <div class="content">
                            <a class="js-acc-btn" href="{{ route('AdminInfo') }}">{{ Auth::user()->name }}</a>
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="{{ route('AdminInfo') }}">
                                        @if (isset(Auth::user()->image ))
                                            <img src="{{ asset('images/profile/'.Auth::user()->image) }}" alt="{{  Auth::user()->name }}" />
                                        @else
                                            <img src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg" alt="Profile Picture" />
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="name">
                                        <a href="{{ route('AdminInfo') }}">{{ Auth::user()->name }}</a>
                                    </h5>
                                    <span class="email">johndoe@example.com</span>
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="zmdi zmdi-power"></i>Logout</a>                                        
                                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf                                        
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="{{ route('dashboard') }}">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">
                                            @yield('pagename')
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- Page content -->            
            @yield('pagecontent')
            <!-- End Page Content -->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © <?php $year = date("Y"); echo $year; ?> All rights reserved. Developed by <a href="https://paperart.digital/" target="_blank">PaperArt.digital</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('backendAssets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('backendAssets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('backendAssets/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('backendAssets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('backendAssets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('backendAssets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('backendAssets/vendor/select2/select2.min.js') }}">
    </script>
    
    <!-- Main JS-->
    <script src="{{ asset('backendAssets/js/main.js') }}"></script>


   
    
    @yield('footer_js')
    

</body>

</html>
<!-- end document-->