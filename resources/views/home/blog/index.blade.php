@extends('layouts.home.app')

@section('title')
    Blogs
@endsection

@section('content')
    <style>
        .overflow {
            display: -webkit-box;
            max-height: 4.8rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 2;
            line-height: 1.6rem;
        }
    </style>
    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate">
                    <h1>LTH Chemistry Blogs</h1>
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
                            <div class="text-uppercase probootstrap-uppercase">Blogs</div>
                            <h3>Chaò mừng đến với blogs của LTH Chemistry</h3>
                            <p>Đây là nơi cung cấp kiến thức, đặt ra các câu hỏi liên quan để cùng nhau giải đáp. Nếu bạn
                                muốn đặt câu hỏi, cùng tham gia giải đáp, vậy thì hãy cùng tham gia với chúng tôi ngay</p>
                            <p>
                                <span class="probootstrap-date"><i class="icon-calendar"></i>2023</span>
                                <span class="probootstrap-location"><i class="icon-user2"></i>Lê Trung Hiếu</span>
                            </p>
                        </div>
                        <div class="probootstrap-image probootstrap-animate"
                            style="background-image: url(img/slider_4.jpg)">
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
                @foreach ($blogs as $blog)
                    <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 probootstrap-animate" style="margin-bottom: 40px">
                        <a href="{{ route('blog.show', $blog->id) }}" class="probootstrap-featured-news-box">
                            <div class="probootstrap-text">
                                <h3 class="overflow">{{ $blog->title }}</h3>
                                <span class="probootstrap-date"><i class="icon-calendar"></i>{{ $blog->postTime }}</span>
                                <span class="probootstrap-location" class="overflow" style="-webkit-line-clamp: 1;"><i
                                        class="icon-user2"></i>
                                    @if (optional($blog->user)->email != null)
                                        {{ optional($blog->user)->firstname . ' ' . optional($blog->user)->lastname }}
                                    @else
                                        Tài khoản đã bị xóa
                                    @endif
                                </span>
                                <span class="probootstrap-location"><i
                                        class="icon-question"></i>{{ $blog->category->academic_level . ' - ' . $blog->category->question_level }}</span>
                                <span class="probootstrap-location"><i
                                        class="icon-heart"></i>{{ DB::table('post_hearts')->where('post_id', $blog->id)->count() }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="clearfix visible-sm-block visible-xs-block"></div>
                <div class="d-flex justify-content-center" style="text-align: center; ">
                    {{ $blogs->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
