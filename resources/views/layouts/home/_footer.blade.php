<style>
    .lac {
        animation: wiggle 2s linear infinite;
        opacity: 100;
        visibility: visible;
    }

    /* Keyframes */
    @keyframes wiggle {

        0%,
        7% {
            transform: rotateZ(0);
        }

        15% {
            transform: rotateZ(-15deg);
        }

        20% {
            transform: rotateZ(10deg);
        }

        25% {
            transform: rotateZ(-10deg);
        }

        30% {
            transform: rotateZ(6deg);
        }

        35% {
            transform: rotateZ(-4deg);
        }

        40%,
        100% {
            transform: rotateZ(0);
        }
    }
</style>
<section class="probootstrap-cta">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="probootstrap-animate" data-animate-effect="fadeInRight">Vậy còn chần chờ gì nữa</h2>
                <button href="#" role="button" class="btn btn-primary btn-lg btn-ghost probootstrap-animate lac"
                    data-animate-effect="fadeInLeft" class="dropdown-item" data-toggle="modal" data-target="#signUpModal"
                    class="tt-icon-btn" style="cursor: pointer">Đăng ký học ngay</button>
                <div class="modal fade" id="signUpModal" tabindex="-2" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width:150%">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Đăng ký học</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <h3>Quý phụ huynh học sinh muốn đăng ký học vui lòng liên hệ với thầy giáo Hiếu để
                                        được tư vấn kĩ càng hơn và kiểm tra trình độ qua:</h3>
                                    <p><b>Số điện thoại hoặc Zalo:</b> 0942225766</p>
                                    <p><b>Qua email:</b> letrunghieu2001@gmail.com <b>hoặc</b>
                                        trungtamdayhoalth@gmail.com</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="probootstrap-footer probootstrap-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                    <h3>LTH Chemistry</h3>
                    <p>Hướng tới việc trở thành trung tâm dạy Hóa số 1 Việt Nam. Luôn đặt học sinh lên hàng đầu</p>
                    <h3>Mạng xã hội</h3>
                    <ul class="probootstrap-footer-social">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-github"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-md-push-1">
                <div class="probootstrap-footer-widget">
                    <h3>Links</h3>
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Trang Chủ</a></li>
                        <li> <a class="dropdown-item" data-toggle="modal" data-target="#signUpModal" class="tt-icon-btn"
                                style="cursor: pointer"> Đăng kí học </a></li>
                        <div class="modal fade" id="signUpModal" tabindex="-2" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:150%">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            Đăng ký học</h1>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <h3>Quý phụ huynh học sinh muốn đăng ký học vui lòng liên hệ với thầy giáo
                                                Hiếu để được tư vấn kĩ càng hơn và kiểm tra trình độ qua:</h3>
                                            <p><b>Số điện thoại hoặc Zalo:</b> 0942225766</p>
                                            <p><b>Qua email:</b> letrunghieu2001@gmail.com <b>hoặc</b>
                                                trungtamdayhoalth@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <li><a href="{{ route('home.periodic-table') }}">Bảng tuần hoàn</a></li>
                        <li><a href="{{ route('news.index') }}">Tin tức</a></li>
                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                    <h3>Liên hệ</h3>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-location2"></i> <span><b> CS1:</b> 28 phố Ngọc Khánh, quận Ba Đình, thành phố
                                Hà
                                Nội </span> </li>
                        <li><i class="icon-location2"></i> <span><b> CS2:</b> 44D ngõ 66 đường Hò Tùng Mậu, quận Cầu
                                Giấy,
                                thành phố Hà Nội</span></li>
                        <li><i class="icon-mail"></i><span>letrunghieu2001@gmail.com</span></li>
                        <li><i class="icon-phone2"></i><span>0942225766</span></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- END row -->

    </div>

    <div class="probootstrap-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-left">
                    <p>&copy; {{ now()->year }} <a href="{{ route('home') }}">LTH Chemistry</a>. Thiết kế và &amp; phát triển with <i
                            class="icon icon-heart"></i> bởi <a href="{{ route('home') }}">TrungHieuLe</a></p>
                </div>
                <div class="col-md-4 probootstrap-back-to-top">
                    <p><a href="#" class="js-backtotop">Lên đầu trang<i class="icon-arrow-long-up"></i></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- END wrapper -->

<script src="{{ asset('assets/js/home/scripts.min.js') }}"></script>
<script src="{{ asset('assets/js/home/main.min.js') }}"></script>
<script src="{{ asset('assets/js/home/custom.js') }}"></script>

</body>

</html>
