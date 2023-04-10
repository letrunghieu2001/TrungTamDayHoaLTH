@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Danh sách bài viết bị ẩn'])
    <style>
        .overflow {
            display: -webkit-box;
            max-height: 3.2rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 1;
            line-height: 1.6rem;
        }
    </style>
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div>
                        <a href="{{ URL::signedRoute('blog.active') }}" style="color: blue; font-size: 15px"><i
                                class="fa-solid fa-arrow-left-long"></i> Trang trước</a>
                    </div>
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Danh sách bài viết bị ẩn</h6>
                        @if (count($blogs) > 0)
                            <form action="{{ route('blog.restore-all') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Khôi phục toàn bộ bài viết</button>
                            </form>
                        @endif
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 10px 0 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm bài viết bị ẩn...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($blogs) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    STT</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Người đăng</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tiêu đề</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Thông tin</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Trạng thái</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogs as $blog)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $blogs->perPage() * ($blogs->currentPage() - 1) + $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        @if (optional($blog->user)->email != null)
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/avatar/' . optional($blog->user)->avatar) }}"
                                                                        class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ optional($blog->user)->firstname . ' ' . optional($blog->user)->lastname }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ optional($blog->user)->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="text-secondary overflow text-xs font-weight-bold">Tài
                                                                khoản đã bị xóa</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $blog->title }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $blog->category->academic_level . ' - ' . $blog->category->question_level }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">{{ $blog->format_time }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        @if ($blog->status == 1)
                                                            <span class="badge badge-sm bg-gradient-success">Đã được
                                                                duyệt</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-secondary">Đang chờ
                                                                duyệt</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#restoreUserModal-{{ $blog->id }}"
                                                            class="tt-icon-btn"><i
                                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUserModal-{{ $blog->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-ban"></i></a>
                                                        <div class="modal fade" id="deleteUserModal-{{ $blog->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Xóa hoàn toàn bài viết</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn xóa hoàn toàn bài viết này không
                                                                        ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('blog.force-delete', [$blog->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Xoá</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="restoreUserModal-{{ $blog->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Khôi phục bài viết</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn khôi phục bài viết này không ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('blog.restore', [$blog->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Khôi
                                                                                phục</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        Không có kết quả
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $blogs->appends(Request::all())->links() }}
    </div>
@endsection
