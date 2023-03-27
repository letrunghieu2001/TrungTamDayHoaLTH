<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/logos/logo.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700|Open+Sans" rel="stylesheet">
    <script src="https://kit.fontawesome.com/240d2d8630.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home/styles-merged.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/custom.css') }}">

</head>

<style>
    /* customizable snowflake styling */
    .snowflake {
        color: #fff;
        font-size: 1em;
        font-family: Arial;
        text-shadow: 0 0 1px #000;
    }

    @-webkit-keyframes snowflakes-fall {
        0% {
            top: -10%
        }

        100% {
            top: 100%
        }
    }

    @-webkit-keyframes snowflakes-shake {
        0% {
            -webkit-transform: translateX(0px);
            transform: translateX(0px)
        }

        50% {
            -webkit-transform: translateX(80px);
            transform: translateX(80px)
        }

        100% {
            -webkit-transform: translateX(0px);
            transform: translateX(0px)
        }
    }

    @keyframes snowflakes-fall {
        0% {
            top: -10%
        }

        100% {
            top: 100%
        }
    }

    @keyframes snowflakes-shake {
        0% {
            transform: translateX(0px)
        }

        50% {
            transform: translateX(80px)
        }

        100% {
            transform: translateX(0px)
        }
    }

    .snowflake {
        position: fixed;
        top: -10%;
        z-index: 9999;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        cursor: default;
        -webkit-animation-name: snowflakes-fall, snowflakes-shake;
        -webkit-animation-duration: 10s, 3s;
        -webkit-animation-timing-function: linear, ease-in-out;
        -webkit-animation-iteration-count: infinite, infinite;
        -webkit-animation-play-state: running, running;
        animation-name: snowflakes-fall, snowflakes-shake;
        animation-duration: 10s, 3s;
        animation-timing-function: linear, ease-in-out;
        animation-iteration-count: infinite, infinite;
        animation-play-state: running, running
    }

    .snowflake:nth-of-type(0) {
        left: 1%;
        -webkit-animation-delay: 0s, 0s;
        animation-delay: 0s, 0s
    }

    .snowflake:nth-of-type(1) {
        left: 10%;
        -webkit-animation-delay: 1s, 1s;
        animation-delay: 1s, 1s
    }

    .snowflake:nth-of-type(2) {
        left: 20%;
        -webkit-animation-delay: 6s, .5s;
        animation-delay: 6s, .5s
    }

    .snowflake:nth-of-type(3) {
        left: 30%;
        -webkit-animation-delay: 4s, 2s;
        animation-delay: 4s, 2s
    }

    .snowflake:nth-of-type(4) {
        left: 40%;
        -webkit-animation-delay: 2s, 2s;
        animation-delay: 2s, 2s
    }

    .snowflake:nth-of-type(5) {
        left: 50%;
        -webkit-animation-delay: 8s, 3s;
        animation-delay: 8s, 3s
    }

    .snowflake:nth-of-type(6) {
        left: 60%;
        -webkit-animation-delay: 6s, 2s;
        animation-delay: 6s, 2s
    }

    .snowflake:nth-of-type(7) {
        left: 70%;
        -webkit-animation-delay: 2.5s, 1s;
        animation-delay: 2.5s, 1s
    }

    .snowflake:nth-of-type(8) {
        left: 80%;
        -webkit-animation-delay: 1s, 0s;
        animation-delay: 1s, 0s
    }

    .snowflake:nth-of-type(9) {
        left: 90%;
        -webkit-animation-delay: 3s, 1.5s;
        animation-delay: 3s, 1.5s
    }

    .demo {
        font-family: 'Raleway', sans-serif;
        color: #fff;
        display: block;
        margin: 0 auto;
        padding: 15px 0;
        text-align: center;
    }

    .demo a {
        font-family: 'Raleway', sans-serif;
        color: #000;
    }
</style>

<body>
    <div class="snowflakes" aria-hidden="true">
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
        <div class="snowflake">
            ❅
        </div>
        <div class="snowflake">
            ❆
        </div>
        <div class="snowflake">
            ❄
        </div>
    </div>
    <div class="probootstrap-search" id="probootstrap-search">
        <a href="#" class="probootstrap-close js-probootstrap-close"><i class="icon-cross"></i></a>
        <form action="#">
            <input type="search" name="q" id="search" placeholder="Tìm blog( theo tiêu đề )...">
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
                        <li class="nav-link {{ str_contains(request()->url(), 'home') == true ? 'active' : '' }}"><a href="{{ route('home') }}">Trang Chủ</a></li>
                        <li> <a class="dropdown-item" data-toggle="modal"
                            data-target="#signUpModal"
                            class="tt-icon-btn" style="cursor: pointer"> Đăng kí học </a></li>
                            <div class="modal fade" id="signUpModal" tabindex="-2"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                Đăng ký học</h1>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <h3>Quý phụ huynh học sinh muốn đăng ký học vui lòng liên hệ với thầy giáo Hiếu để được tư vấn kĩ càng hơn và kiểm tra trình độ qua:</h3>
                                                    <p><b>Số điện thoại hoặc Zalo:</b> 0942225766</p>
                                                    <p><b>Qua email:</b> letrunghieu2001@gmail.com <b>hoặc</b> trungtamdayhoalth@gmail.com</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <li class="nav-link {{ str_contains(request()->url(), 'periodic-table') == true ? 'active' : '' }}"><a href="{{ route('home.periodic-table') }}">Bảng tuần hoàn</a></li>
                        <li class="nav-link {{ str_contains(request()->url(), 'news') == true ? 'active' : '' }}"><a href="{{ route('news.index') }}">Tin tức</a></li>
                        <li class="nav-link {{ str_contains(request()->url(), 'blog') == true ? 'active' : '' }}"><a href="{{ route('blog.index') }}">Blog</a></li>
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
