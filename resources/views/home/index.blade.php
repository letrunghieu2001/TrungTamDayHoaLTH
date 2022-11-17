@extends('layouts.home.app')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section class="flexslider">
        <ul class="slides">
            <li style="background-image: url({{ asset('/img/home/slider_1.jpg') }})" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate">Quan trọng không phải vị trí bạn đang
                                    đứng mà là hướng bạn đang đi</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url({{ asset('/img/home/slider_2.jpg') }})" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate">Không chỉ là kiến thức, mà còn là kỹ
                                    năng sống</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url({{ asset('/img/home/slider_3.jpg') }})" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate">Định hướng nghề nghiệp, phát triển
                                    tương lai</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate">
                    <h2>Chào mừng đến với trung tâm dạy hóa LTH</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="probootstrap-flex-block">
                        <div class="probootstrap-text probootstrap-animate">
                            <h3>Về trung tâm</h3>
                            <p>Dù là một trung tâm non trẻ vừa mới được thành lập sau 3 năm kinh nghiệm đi dạy thêm, nhưng
                                với vốn kiến thức hóa học được tích lũy từ cấp 2, cấp 3 cùng khả năng quản trị được học tại
                                Trường Đại Học Kinh Tế Quốc Dân, trung tâm sẽ có lộ trình phát triển từng bước vững chắc để
                                khẳng định vị thế</p>
                            <p><a href="#" class="btn btn-primary">Tìm hiểu thêm</a></p>
                        </div>
                        <div class="probootstrap-image probootstrap-animate"
                            style="background-image: url(img/slider_3.jpg)">
                            <a href="https://vimeo.com/45830194" class="btn-video popup-vimeo"><i
                                    class="icon-play3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section" id="probootstrap-counter">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                    <div class="probootstrap-counter-wrap">
                        <div class="probootstrap-icon">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="probootstrap-text">
                            <span class="probootstrap-counter">
                                <span class="js-counter" data-from="0" data-to="20203" data-speed="5000"
                                    data-refresh-interval="50">1</span>
                            </span>
                            <span class="probootstrap-counter-label">Số học sinh tốt nghiệp</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                    <div class="probootstrap-counter-wrap">
                        <div class="probootstrap-icon">
                            <i class="icon-users2"></i>
                        </div>
                        <div class="probootstrap-text">
                            <span class="probootstrap-counter">
                                <span class="js-counter" data-from="0" data-to="20203" data-speed="5000"
                                    data-refresh-interval="50">1</span>
                            </span>
                            <span class="probootstrap-counter-label">Số học sinh hiện tại</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                    <div class="probootstrap-counter-wrap">
                        <div class="probootstrap-icon">
                            <i class="icon-user-tie"></i>
                        </div>
                        <div class="probootstrap-text">
                            <span class="probootstrap-counter">
                                <span class="js-counter" data-from="0" data-to="139" data-speed="5000"
                                    data-refresh-interval="50">1</span>
                            </span>
                            <span class="probootstrap-counter-label">Tổng số giáo viên</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-sm-block visible-xs-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate">
                    <div class="probootstrap-counter-wrap">
                        <div class="probootstrap-icon">
                            <i class="icon-library"></i>
                        </div>
                        <div class="probootstrap-text">
                            <span class="probootstrap-counter">
                                <span class="js-counter" data-from="0" data-to="99" data-speed="5000"
                                    data-refresh-interval="50">1</span>%
                            </span>
                            <span class="probootstrap-counter-label">Đỗ đại học</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="probootstrap-section probootstrap-section-colored probootstrap-bg probootstrap-custom-heading probootstrap-tab-section"
        style="background-image: url(img/slider_2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center section-heading probootstrap-animate">
                    <h2 class="mb0">Nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="probootstrap-tab-style-1">
            <ul class="nav nav-tabs probootstrap-center probootstrap-tabs no-border">
                <li class="active"><a data-toggle="tab" href="#featured-news">Tin tức mới</a></li>
                <li><a data-toggle="tab" href="#upcoming-events">Topic tranh luận nổi bật</a></li>
            </ul>
        </div>
    </section>

    <section class="probootstrap-section probootstrap-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div id="featured-news" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel" id="owl1">
                                        <div class="item">
                                            <a href="#" class="probootstrap-featured-news-box">
                                                <figure class="probootstrap-media"><img src="img/img_sm_3.jpg"
                                                        alt="Free Bootstrap Template by ProBootstrap.com"
                                                        class="img-responsive"></figure>
                                                <div class="probootstrap-text">
                                                    <h3>Tempora consectetur unde nisi</h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, ut.
                                                    </p>
                                                    <span class="probootstrap-date"><i class="icon-calendar"></i>July 9,
                                                        2017</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- END item -->
                                    </div>
                                </div>
                            </div>
                            <!-- END row -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p><a href="#" class="btn btn-primary">Xem tất cả tin tức mới</a></p>
                                </div>
                            </div>
                        </div>
                        <div id="upcoming-events" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel" id="owl2">
                                        <div class="item">
                                            <a href="#" class="probootstrap-featured-news-box">
                                                <figure class="probootstrap-media"><img src="img/img_sm_3.jpg"
                                                        alt="Free Bootstrap Template by ProBootstrap.com"
                                                        class="img-responsive"></figure>
                                                <div class="probootstrap-text">
                                                    <h3>Tempora consectetur unde nisi</h3>
                                                    <span class="probootstrap-date"><i class="icon-calendar"></i>July 9,
                                                        2017</span>
                                                    <span class="probootstrap-location"><i
                                                            class="icon-location2"></i>White Palace, Brooklyn, NYC</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- END item -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p><a href="#" class="btn btn-primary">Tới trang blog</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                    <h2>Các lớp học hiện tại</h2>
                    <p class="lead">Phía dưới là một vài lớp học hiện có của trung tâm</p>
                </div>
            </div>
            <!-- END row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="probootstrap-service-2 probootstrap-animate">
                        <div class="image">
                            <div class="image-bg">
                                <img src="img/img_sm_1.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                            </div>
                        </div>
                        <div class="text">
                            <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                            <h3>Application Design</h3>
                            <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi
                                voluptatum architecto rerum error.</p>
                            <p><a href="#" class="btn btn-primary">Enroll now</a> <span
                                    class="enrolled-count">2,928 students enrolled</span></p>
                        </div>
                    </div>

                    <div class="probootstrap-service-2 probootstrap-animate">
                        <div class="image">
                            <div class="image-bg">
                                <img src="img/img_sm_3.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                            </div>
                        </div>
                        <div class="text">
                            <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                            <h3>Chemical Engineering</h3>
                            <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi
                                voluptatum architecto rerum error.</p>
                            <p><a href="#" class="btn btn-primary">Enroll now</a> <span
                                    class="enrolled-count">7,202 students enrolled</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="probootstrap-service-2 probootstrap-animate">
                        <div class="image">
                            <div class="image-bg">
                                <img src="img/img_sm_2.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                            </div>
                        </div>
                        <div class="text">
                            <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                            <h3>Math Major</h3>
                            <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi
                                voluptatum architecto rerum error.</p>
                            <p><a href="#" class="btn btn-primary">Enroll now</a> <span
                                    class="enrolled-count">12,582 students enrolled</span></p>
                        </div>
                    </div>

                    <div class="probootstrap-service-2 probootstrap-animate">
                        <div class="image">
                            <div class="image-bg">
                                <img src="img/img_sm_4.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                            </div>
                        </div>
                        <div class="text">
                            <span class="probootstrap-meta"><i class="icon-calendar2"></i> July 10, 2017</span>
                            <h3>English Major</h3>
                            <p>Laboriosam pariatur modi praesentium deleniti molestiae officiis atque numquam quos quis nisi
                                voluptatum architecto rerum error.</p>
                            <p><a href="#" class="btn btn-primary">Enroll now</a> <span
                                    class="enrolled-count">9,582 students enrolled</span></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <section class="probootstrap-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                    <h2>Gặp gỡ đội ngũ giáo viên chất lượng</h2>
                    <p class="lead">Đội ngũ giáo viên được tuyển chọn và rèn luyện kĩ càng, nhằm đem đến chất lượng tốt
                        nhất cho trung tâm</p>
                </div>
            </div>
            <!-- END row -->

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="probootstrap-teacher text-center probootstrap-animate">
                        <figure class="media">
                            <img src="img/person_1.jpg" alt="Free Bootstrap Template by ProBootstrap.com"
                                class="img-responsive">
                        </figure>
                        <div class="text">
                            <h3>Chris Worth</h3>
                            <p>Physical Education</p>
                            <ul class="probootstrap-footer-social">
                                <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                                <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                                <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="probootstrap-teacher text-center probootstrap-animate">
                        <figure class="media">
                            <img src="img/person_5.jpg" alt="Free Bootstrap Template by ProBootstrap.com"
                                class="img-responsive">
                        </figure>
                        <div class="text">
                            <h3>Janet Morris</h3>
                            <p>English Teacher</p>
                            <ul class="probootstrap-footer-social">
                                <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                                <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                                <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-sm-block visible-xs-block"></div>
                <div class="col-md-3 col-sm-6">
                    <div class="probootstrap-teacher text-center probootstrap-animate">
                        <figure class="media">
                            <img src="img/person_6.jpg" alt="Free Bootstrap Template by ProBootstrap.com"
                                class="img-responsive">
                        </figure>
                        <div class="text">
                            <h3>Linda Reyez</h3>
                            <p>Math Teacher</p>
                            <ul class="probootstrap-footer-social">
                                <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                                <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                                <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="probootstrap-teacher text-center probootstrap-animate">
                        <figure class="media">
                            <img src="img/person_7.jpg" alt="Free Bootstrap Template by ProBootstrap.com"
                                class="img-responsive">
                        </figure>
                        <div class="text">
                            <h3>Jessa Sy</h3>
                            <p>Physics Teacher</p>
                            <ul class="probootstrap-footer-social">
                                <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                                <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                                <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                                <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial"
        style="background-image: url(img/slider_4.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                    <h2>Reviews của học sinh</h2>
                    <p class="lead">Những học sinh đã từng học nói gì về trung tâm</p>
                </div>
            </div>
            <!-- END row -->
            <div class="row">
                <div class="col-md-12 probootstrap-animate">
                    <div class="owl-carousel owl-carousel-testimony owl-carousel-fullwidth">
                        <div class="item">

                            <div class="probootstrap-testimony-wrap text-center">
                                <figure>
                                    <img src="img/person_1.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                                </figure>
                                <blockquote class="quote">&ldquo;Design must be functional and functionality must be
                                    translated into visual aesthetics, without any reliance on gimmicks that have to be
                                    explained.&rdquo; <cite class="author"> &mdash; <span>Mike Fisher</span></cite>
                                </blockquote>
                            </div>

                        </div>
                        <div class="item">

                            <div class="probootstrap-testimony-wrap text-center">
                                <figure>
                                    <img src="img/person_1.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                                </figure>
                                <blockquote class="quote">&ldquo;Design must be functional and functionality must be
                                    translated into visual aesthetics, without any reliance on gimmicks that have to be
                                    explained.&rdquo; <cite class="author"> &mdash; <span>Mike Fisher</span></cite>
                                </blockquote>
                            </div>

                        </div>
                        <div class="item">

                            <div class="probootstrap-testimony-wrap text-center">
                                <figure>
                                    <img src="img/person_1.jpg" alt="Free Bootstrap Template by ProBootstrap.com">
                                </figure>
                                <blockquote class="quote">&ldquo;Design must be functional and functionality must be
                                    translated into visual aesthetics, without any reliance on gimmicks that have to be
                                    explained.&rdquo; <cite class="author"> &mdash; <span>Mike Fisher</span></cite>
                                </blockquote>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END row -->
        </div>
    </section>

    <section class="probootstrap-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                    <h2>Tại sao chọn LTH Chemistry</h2>
                    <p class="lead">Chúng tôi tự tin có thể vươn lên trở thành trung tâm dạy hóa dẫn đầu Việt Nam</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Đội ngũ giáo viên chất lượng</h3>
                            <p>Trung tâm có đội ngũ giáo viên trẻ, nhiệt huyết được tuyển chọn gắt gao, qua đào tạo bài bản
                                để đem tới cho
                                học sinh những giờ học chất lượng nhất</p>
                        </div>
                    </div>
                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Đội ngũ học sinh hùng hậu</h3>
                            <p>Trung tâm hiện đang đón một lượng lớn học sinh tham gia dù mới thành lập, điều đó cho thấy sự
                                phát triển đúng hướng của trung tâm</p>
                        </div>
                    </div>
                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Những giờ học vui vẻ</h3>
                            <p>Học sinh không chỉ được
                                học kiến thức từ nền tảng tới chuyên sâu, mà còn trú trọng phát triển kĩ năng mềm, phát
                                triển toàn diện bản thân hơn </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Hệ thống bài giảng cập nhật mới nhất</h3>
                            <p>Các bài học luôn cố gắng bắt kịp theo xu hướng mới nhất, theo sự thay đổi của bộ giáo dục và
                                đào tạo, nhằm đem đến cho học sinh những kiến thức mới nhất</p>
                        </div>
                    </div>

                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Hoạt động ngoại khóa vui vẻ</h3>
                            <p>Ngoài những giờ học căng thẳng, trung tâm còn hay tổ chức các hoạt động ngoại khóa như xem
                                phim, đi ăn, quay tiktok để "bắt trend" cùng thời đại,...</p>
                        </div>
                    </div>

                    <div class="service left-icon probootstrap-animate">
                        <div class="icon"><i class="icon-checkmark"></i></div>
                        <div class="text">
                            <h3>Cơ sở vật chất được đầu tư</h3>
                            <p>Trung tâm đầu tư cơ sở vật chất theo hướng khoa học nhất, bắt kịp những công nghệ mới nhất để
                                áp dụng vào thực tiễn, khiến học sinh cảm thấy thoải mái nhất khi học tập</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END row -->
        </div>
    </section>
@endsection
