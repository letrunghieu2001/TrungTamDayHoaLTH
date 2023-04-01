@extends('layouts.home.app')

@section('title')
    {{ $blog->title }}
@endsection

@section('content')
    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate">
                    <h1>{{ $blog->title }}</h1>
                </div>
            </div>
        </div>
    </section>
    <style>
        .modal-backdrop {
            z-index: -1;
        }
        </style>
    <section class="probootstrap-section probootstrap-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row probootstrap-gutter0">
                        <div class="col-md-4" id="probootstrap-sidebar">
                            <div class="probootstrap-sidebar-inner probootstrap-overlap probootstrap-animate">
                                <h3>Blog liên quan</h3>
                                <ul class="probootstrap-side-menu">
                                    <li class="active"><a>{{ $blog->title }}</a></li>
                                    @foreach ($relatedBlogs as $relatedBlog)
                                        <li><a
                                                href="{{ route('blog.show', $relatedBlog->id) }}">{{ $relatedBlog->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 col-md-push-1  probootstrap-animate" id="probootstrap-content">
                            <div style="margin-bottom : 50px">
                                @if (optional($blog->user)->email != null)
                                    <div class="d-flex px-2 py-1"
                                        style="display: flex; align-items: center; justify-content: space-between">
                                        <div>
                                            <img src="{{ asset('storage/avatar/' . optional($blog->user)->avatar) }}"
                                                class="img-circle" style="width: 50px; height: auto" alt="user1">
                                            <span class="mb-0 text-sm"
                                                style="margin:auto; margin-left: 20px; font-weight: bold">
                                                {{ optional($blog->user)->firstname . ' ' . optional($blog->user)->lastname }}
                                            </span>
                                        </div>
                                        <div style="float:right">
                                            {{ $blog->category->academic_level . ' - ' . $blog->category->question_level }}
                                            <span style="margin-left: 20px">{{ $blog->postTime }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex px-2 py-1"
                                        style="display: flex; align-items: center; justify-content: space-between">
                                        <div>
                                            <span class="text-secondary overflow text-xs font-weight-bold"
                                                style="font-weight:bold">Tài
                                                khoản viết bài viết này đã bị xóa</span>
                                        </div>
                                        <div style="float:right">
                                            {{ $blog->category->academic_level . ' - ' . $blog->category->question_level }}
                                            <span style="margin-left: 20px">{{ $blog->postTime }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div>{!! $blog->content !!}</div>
                            <div class="heart-post" style="margin-top: 50px">
                                @if (Auth::check())
                                    @if (is_null($isPostHeart))
                                        <form id="heartForm">
                                            <i class="fa-solid fa-heart icon-heart icon-post" style="cursor: pointer"
                                                data-url='{{ route('postheart.update', [$blog->id, Auth::user()->id]) }}'></i><span>
                                                <span class="count-heart">{{ $countPostHeart }} </span>
                                                người thích bài viết này</span>
                                        </form>
                                    @else
                                        <form id="heartForm">
                                            <i class="fa-solid fa-heart icon-heart text-danger icon-post"
                                                style="cursor: pointer"
                                                data-url='{{ route('postheart.update', [$blog->id, Auth::user()->id]) }}'></i><span>
                                                <span class="count-heart">{{ $countPostHeart }} </span>
                                                người thích bài viết này</span>
                                        </form>
                                    @endif
                                @else
                                    <i class="fa-solid fa-heart"></i><span> {{ $countPostHeart }}
                                        thích bài viết này</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 probootstrap-animate" id="probootstrap-content" style="margin: 50px 0">
                            <h2>Bình luận</h2>
                            @if (Auth::Check())
                                <form method="POST" action={{ route('comment.store', [$blog->id]) }}
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-12">
                                        <textarea id="summernoteContent" name="content">{{ old('content') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg active comment-button"
                                        data-url='{{ route('comment.store', [$blog->id]) }}'>Bình luận</button>
                                </form>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            @else
                                <div class="alert alert-success alert-success-custom" role="alert">
                                    <a href="{{ route('login') }}">Hãy đăng nhập để bình luận</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <h3>Có {{ count($comments) }} bình luận </h3>
                        </div>
                        <div>
                            @if (count($comments) > 0)
                                @foreach ($comments as $comment)
                                    <div class="col-md-1 col-2 avatar-comment">
                                        <img class="img-circle" style="width: 80px; margin-left: -20px"
                                            src="{{ asset('storage/avatar/' . optional($comment->user)->avatar) }}">
                                    </div>
                                    <div class="col-md-11 col-10 comment-username">
                                        <b>
                                            {{ optional($comment->user)->firstname . ' ' . optional($comment->user)->lastname }}
                                        </b>
                                        @if (Auth::check())
                                            <div class="btn-group dropstart" style="cursor: pointer; float: right">
                                                <div class="three-dots-dropdown" id="dLabel" data-toggle="dropdown"
                                                    aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </div>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel">
                                                    @can('canComment', [$blog, $comment])
                                                        <li><a class="dropdown-item" data-toggle="modal"
                                                                data-target="#updateCommentModal-{{ $comment->id }}">Sửa</a>
                                                        </li>
                                                        <li> <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#deleteCommentModal-{{ $comment->id }}"
                                                                class="tt-icon-btn">Xóa</a>
                                                        </li>
                                                    @endcan
                                                    <li> <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#reportCommentModal-{{ $comment->id }}"
                                                            class="tt-icon-btn">Báo cáo</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    @if (Auth::check())
                                        @can('canComment', [$blog, $comment])
                                            <div class="modal fade" id="updateCommentModal-{{ $comment->id }}" tabindex="-2"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width:150%">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Sửa comment</h1>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <form method="POST"
                                                            action={{ route('comment.update', [$comment->id]) }}
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="comment" class="form-label">Nội
                                                                        dung</label>
                                                                    <textarea class="summernoteEditContent" id="summernoteEditContent-{{ $comment->id }}" name="editContent">{!! $comment->content !!}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-id="{{ $comment->id }}"
                                                                    data-url="{{ route('comment.update', [$comment->id]) }}"
                                                                    id="editComment">Xác nhận</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteCommentModal-{{ $comment->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width:150%">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                                Xóa comment</h1>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc muốn xóa comment này không ?
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="display: flex; justify-content: space-between">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Đóng</button>
                                                            <form action="{{ route('comment.delete', [$comment->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Xóa
                                                                    comment</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="reportCommentModal-{{ $comment->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width:150%">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                                Báo cáo comment</h1>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        @if (Auth::check())
                                                            @if (is_null($isCommentReported[$comment->id]))
                                                                <form class="report-comment-form-{{ $comment->id }}">
                                                                    <div class="modal-body">
                                                                        <div>Tại sao bạn muốn báo cáo bình luận này ? </div>
                                                                        <input type="radio" id="reportComment1"
                                                                            name="reportComment"
                                                                            value="Nội dung không liên quan đến bài viết"
                                                                            checked>
                                                                        <label for="reportComment1"> Nội dung không liên
                                                                            quan
                                                                            đến
                                                                            bài
                                                                            viết</label><br>
                                                                        <input type="radio" id="reportComment2"
                                                                            name="reportComment" value="Spam">
                                                                        <label for="reportComment2"> Spam</label><br>
                                                                        <input type="radio" id="reportComment3"
                                                                            name="reportComment"
                                                                            value="Chứa ngôn từ không phù hợp">
                                                                        <label for="reportComment3"> Chứa ngôn từ không phù
                                                                            hợp</label><br>
                                                                    </div>
                                                                @else
                                                                    <div class="modal-body">
                                                                        Bạn đã báo cáo bình luận này rồi. Hãy chờ admin giải
                                                                        quyết
                                                                    </div>
                                                            @endif
                                                            <div class="modal-footer"
                                                                style="display: flex; justify-content: space-between">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Đóng</button>
                                                                @if (Auth::check())
                                                                    @if (is_null($isCommentReported[$comment->id]))
                                                                        <button type="button"
                                                                            class="btn btn-danger button-report-comment-{{ $comment->id }}"
                                                                            data-url='{{ route('report-comment.store', [$comment->id]) }}'
                                                                            data-id="{{ $comment->id }}">Báo
                                                                            cáo</button>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    @endif
                                    <div class="col-md-1 col-2">
                                    </div>
                                    <div class="col-md-11 col-10 comment-content">
                                        <div id="comment{{ $comment->id }}">{!! $comment->content !!}</div>
                                    </div>
                                    <div class="col-md-1 col-2"></div>
                                    <div class="col-md-11 col-10 comment-time" style="margin-bottom: 30px; display: flex">
                                        <span>{{ $comment->post_time }}</span>
                                        <span class="heart-comment-{{ $comment->id }}" style="margin-left: 50px">
                                            @if (Auth::check())
                                                @if (is_null($isCommentHeart[$comment->id]))
                                                    <form id="heartForm">
                                                        <i class="fa-solid fa-heart icon-heart icon-comment-{{ $comment->id }}"
                                                            style="cursor: pointer"
                                                            data-url='{{ route('commentheart.update', [$comment->id, Auth::user()->id]) }}'
                                                            data-id="{{ $comment->id }}"></i><span>
                                                            <span
                                                                class="count-comment-heart-{{ $comment->id }}">{{ $countCommentHeart[$comment->id] }}
                                                            </span></span>
                                                    </form>
                                                @else
                                                    <form id="heartForm">
                                                        <i class="fa-solid fa-heart icon-heart icon-comment-{{ $comment->id }} text-danger"
                                                            style="cursor: pointer"
                                                            data-url='{{ route('commentheart.update', [$comment->id, Auth::user()->id]) }}'
                                                            data-id="{{ $comment->id }}"></i><span>
                                                            <span
                                                                class="count-comment-heart-{{ $comment->id }}">{{ $countCommentHeart[$comment->id] }}
                                                            </span></span>
                                                    </form>
                                                @endif
                                            @else
                                                <i class="fa-solid fa-heart"></i><span>
                                                    {{ $countCommentHeart[$comment->id] }}</span>
                                            @endif
                                        </span>
                                    </div>
                                @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const comments = {{ Js::from($comments) }};
        for (var k in comments) {
            $("#summernoteEditContent-" + comments[k].id).summernote({
                height: 400
            });
        };
        $('#summernoteContent').summernote({
            height: 400
        });

        //Heart
        $(".heart-post").on("click", ".icon-heart", function(e) {
            e.preventDefault();
            let url = $(this).data("url");
            $.ajax({
                url: url,
                type: "PUT",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    let i = data.countPostHeart;
                    $(".count-heart").text(i);
                    if ($(".icon-post").hasClass("text-danger")) {
                        $(".icon-post").removeClass("text-danger");
                    } else {
                        $(".icon-post").addClass("text-danger");
                    }
                },
            });
        });

        for (var k in comments) {
            $(".heart-comment-" + comments[k].id).on("click", ".icon-comment-" + comments[k].id, function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                let id = $(this).data("id");
                $.ajax({
                    url: url,
                    type: "PUT",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        let i = data.countCommentHeart;
                        console.log(i);
                        $(".count-comment-heart-" + id).text(i);
                        if ($(".icon-comment-" + id).hasClass("text-danger")) {
                            $(".icon-comment-" + id).removeClass("text-danger");
                        } else {
                            $(".icon-comment-" + id).addClass("text-danger");
                        }
                    },
                });
            });

            $(".report-comment-form-" + comments[k].id).on("click", ".button-report-comment-" + comments[k].id, function(
                e) {
                e.preventDefault();
                let url = $(this).data("url");
                let id = $(this).data("id");
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'reportComment': $("input[name='reportComment']:checked").val()
                    },
                    success: function(data) {
                        alert(
                            'Cảm ơn bạn đã báo cáo bình luận này cho chúng tôi. Chúng tôi sẽ xem xét và giải quyết'
                        )
                        location.reload()
                    },
                });
            });
        };
    </script>
@endsection
