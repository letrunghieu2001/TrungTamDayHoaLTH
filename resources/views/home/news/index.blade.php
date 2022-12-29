@extends('layouts.home.app')

@section('title')
    Tin tức
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
                    <h1>Tin tức</h1>
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
                            <div class="text-uppercase probootstrap-uppercase">News</div>
                            <h3>Tin tức</h3>
                            <p>Đây là kênh tin tức chính thức của trung tâm. Tại đây các bạn có thể hiểu rõ hơn về chúng tôi
                            </p>
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
                @foreach ($news as $new)
                    <a href="{{ route('news.show', $new->id) }}" style="color:grey">
                        <div class="col-md-12">
                            <div class="probootstrap-service-2 probootstrap-animate">
                                <div class="text" style="width: 100%">
                                    <span class="probootstrap-meta"><i class="icon-calendar2"></i>
                                        {{ $new->formatTime }}</span>
                                    <p>{{ $new->title }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="d-flex justify-content-center" style="text-align: center; ">
        {{ $news->appends(Request::all())->links() }}
    </div>
@endsection
