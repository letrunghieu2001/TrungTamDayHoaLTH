<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/logos/logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <script src="https://kit.fontawesome.com/240d2d8630.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home/styles-merged.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/custom.css') }}">
</head>

<body>

    <div class="probootstrap-search" id="probootstrap-search">
        <a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
        <form action="#">
            <input type="search" name="s" id="search" placeholder="Search a keyword and hit enter...">
        </form>
    </div>

    <div class="probootstrap-page-wrapper">
        <div class="probootstrap-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 probootstrap-top-quick-contact-info">
                        <div><i class="icon-location2"></i><b> CS1:</b> 28 phố Ngọc Khánh, quận Ba Đình, thành phố Hà
                            Nội </div>
                        <div><i class="icon-location2"></i><b> CS2:</b> 44D ngõ 66 đường Hò Tùng Mậu, quận Cầu Giấy,
                            thành phố Hà Nội</div>
                        <div><i class="icon-phone2"></i> 0942225766</div>
                        <div><i class="icon-mail"></i> letrunghieu2001@gmail.com</div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 probootstrap-top-social">
                        <ul>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-facebook2"></i></a></li>
                            <li><a href="#"><i class="icon-instagram2"></i></a></li>
                            <li><a href="#"><i class="icon-youtube"></i></a></li>
                            <li><a href="#" class="probootstrap-search-icon js-probootstrap-search"><i
                                        class="icon-search"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default probootstrap-navbar">
            <div class="container">
                <div class="navbar-header">
                    <div class="btn-more js-btn-more visible-xs">
                        <a href="#"><i class="icon-dots-three-vertical "></i></a>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}" title="Trung tâm dạy hóa LTH">LTH Chemistry</a>
                </div>

                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="{{ route('home') }}">Trang Chủ</a></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Giới thiệu</a>
                            <ul class="dropdown-menu">
                                <li><a href="about.html">Về trung tâm</a></li>
                                <li><a href="courses.html">Đội ngũ giáo viên</a></li>
                                <li><a href="course-single.html">Tin tức</a></li>
                                <li><a href="gallery.html">Bảng thành tích</a></li>
                            </ul>
                        </li>
                        <li><a href="events.html">Đăng kí học</a></li>
                        <li><a href="courses.html">Blog</a></li>
                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"
                                    class="dropdown-toggle">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('dashboard') }}">Quản lý</a></li>
                                    <li>
                                        <form id='logoutForm' method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                                style="display: block;clear: both;font-weight: 400;line-height: 1.42857143;">
                                                Đăng xuất</a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
