@extends('layouts.home.app')

@section('title')
    Trang chủ
@endsection

@section('content')
    <style>
        .overflow {
            display: -webkit-box;
            max-height: 30.2rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 2;
        }
    </style>
    <section class="flexslider">
        <ul class="slides">
            <li style="background-image: linear-gradient(to bottom,rgba(0,0,0,0.3),rgba(0,0,0,0.3)), url({{ asset('/img/home/slider_1.jpg') }})"
                class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate" style="font-family: Lato-Bold">Quan trọng không phải vị trí bạn đang
                                    đứng mà là hướng bạn đang đi</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image:  linear-gradient(to bottom,rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{ asset('/img/home/slider_2.jpg') }})"
                class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate" style="font-family: Lato-Bold">Không chỉ là kiến thức, mà còn là kỹ
                                    năng sống</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image:  linear-gradient(to bottom,rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url({{ asset('/img/home/slider_3.jpg') }})"
                class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="probootstrap-slider-text text-center">
                                <h1 class="probootstrap-heading probootstrap-animate" style="font-family: Lato-Bold">Định hướng nghề nghiệp, phát triển
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
    <section class="probootstrap-section probootstrap-bg probootstrap-section-colored probootstrap-testimonial"
        style="background-image: url(img/slider_4.jpg);">
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
                <div class="col-md-12 probootstrap-animate">
                    <div class="owl-carousel owl-carousel-testimony owl-carousel-fullwidth">
                        @foreach ($teachers as $teacher)
                            <div class="item">
                                <div class="probootstrap-testimony-wrap text-center">
                                    <figure>
                                        <img src="{{ asset('storage/avatar/' . $teacher->avatar) }}" alt="giáo viên">
                                    </figure>
                                    <blockquote class="quote">
                                        &ldquo;{{ $teacher->about }}.&rdquo;
                                        <ul class="probootstrap-footer-social" style="margin-top: 20px">
                                            <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                                            <li class="facebook"><a href="#"><i class="icon-facebook2"></i></a></li>
                                            <li class="instagram"><a href="#"><i class="icon-instagram2"></i></a></li>
                                            <li class="google-plus"><a href="#"><i class="icon-google-plus"></i></a>
                                            </li>
                                        </ul> <cite class="author"> &mdash; <span>{{ $teacher->firstname ?? 'Firstname' }}
                                                {{ $teacher->lastname ?? 'Lastname' }}</span></cite>
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END row -->
        </div>
    </section>

    <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                    <h2>Một vài blog nổi bật</h2>
                    <p class="lead">Phía dưới là một vài blog nổi bật</p>
                </div>
            </div>
            <!-- END row -->
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-6">
                        <div class="probootstrap-service-2 probootstrap-animate">
                            <div class="text" style="width: 100%">
                                <span class="probootstrap-meta"><i class="icon-calendar2"></i>
                                    {{ $post->postTime }}</span>
                                <h3 class="overflow">{!! $post->title !!}</h3>
                                <p style="margin: 20px 0"><a href="{{ route('blog.show', [$post->id]) }}"
                                        class="btn btn-primary">Xem thêm</a> <span
                                        class="enrolled-count">{{ DB::table('post_hearts')->where('post_id', $post->id)->count() }}
                                        người thích bài viết này</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p><a href="{{ route('blog.index') }}" class="btn btn-primary">Xem tất cả bài viết</a></p>
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
                    <h2 class="mb0">Tin tức nổi bật</h2>
                </div>
            </div>
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
                                        @foreach ($news as $new)
                                            <div class="item" style="margin-bottom: 25px">
                                                <a href="{{ route('news.show', [$new->id]) }}"
                                                    class="probootstrap-featured-news-box">
                                                    <div class="probootstrap-text" style="top:0; bottom: 20px">
                                                        <h3 class="overflow">{{ $new->title }}</h3>
                                                        <p class="overflow">{{ $new->content }}
                                                        </p>
                                                        <span class="probootstrap-date"><i
                                                                class="icon-calendar"></i>{{ $new->postTime }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                        <!-- END item -->
                                    </div>
                                </div>
                            </div>
                            <!-- END row -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p><a href="{{ route('news.index') }}" class="btn btn-primary">Xem tất cả tin tức
                                            mới</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
