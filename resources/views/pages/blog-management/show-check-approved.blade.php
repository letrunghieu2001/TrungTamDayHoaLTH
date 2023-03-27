@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Duyệt bài đăng'])
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Duyệt bài đăng</h6>
                        @if ($blog->status == 0)
                            <button type="button" class="btn btn-secondary not-approved" data-bs-toggle="modal"
                                data-bs-target="#updateStatusModal-{{ $blog->id }}" class="tt-icon-btn">Chưa được
                                duyệt</button>
                            <div class="modal fade" id="updateStatusModal-{{ $blog->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Duyệt bài đăng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn duyệt bài đăng này không ?</p>
                                            <p>Nếu duyệt bài đăng sẽ được công khai</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <form action="{{ route('blog.update-status', [$blog->id]) }}"
                                                id="blog-update-status-{{ $blog->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($blog->status == 1)
                            <button type="button" class="btn btn-success not-approved" data-bs-toggle="modal"
                                data-bs-target="#updateStatusModal-{{ $blog->id }}" class="tt-icon-btn">Đã được
                                duyệt</button>
                            <div class="modal fade" id="updateStatusModal-{{ $blog->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Hủy duyệt bài đăng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn hủy duyệt bài đăng này không ?</p>
                                            <p>Nếu hủy duyệt bài đăng sẽ được đưa trở về trạng thái chờ duyệt</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <form action="{{ route('blog.update-status', [$blog->id]) }}"
                                                id="blog-update-status-{{ $blog->id }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container">
                        <div class="row">
                            <div>
                                @if (optional($blog->user)->email != null)
                                    <img src="{{ asset('storage/avatar/' . optional($blog->user)->avatar) }}" alt="#"
                                        class="img-circle" width=50 height=50 style="border-radius: 50%">
                                    <span>
                                        {{ optional($blog->user)->firstname . ' ' . optional($blog->user)->lastname }}
                                        <span style="float: right">
                                            <span>{{ $blog->category->academic_level . '-' . $blog->category->question_level }}<span>
                                                    <span style="margin-left: 20px">{{ $blog->postTime }}</span>
                                                </span>
                                            </span>
                                        </span>
                                    @else
                                        <span>Tài khoản đã bị xóa</span>
                                @endif
                            </div>
                            <h4 style="margin: 20px 0">{{ $blog->title }}</h4>
                            <p>
                                {!! $blog->content !!}
                            </p>
                            @if ($blog->status == 1)
                                <div>
                                    <a href="{{ route('blog.show', [$blog->id]) }}" style="color: blue">Xem bài viết công
                                        khai</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
