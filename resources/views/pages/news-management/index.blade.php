@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tin tức'])
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
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Quản lý tin tức</h6>
                        <a href="{{ route('news.create') }}"><button class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px;" class="p-2 bd-highlight">Tạo tin tức</button></a>
                        <a href="{{ route('news.delete-new') }}"><button class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: grey" class="p-2 bd-highlight">Danh sách tin tức
                                bị ẩn</button></a>
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm tin tức (theo tiêu đề) ...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($news) > 0)
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
                                                    Ngày đăng</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($news as $new)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $news->perPage() * ($news->currentPage() - 1) + $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        @if (optional($new->user)->email != null)
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/avatar/' . optional($new->user)->avatar) }}"
                                                                        class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ optional($new->user)->firstname . ' ' . optional($new->user)->lastname }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ optional($new->user)->email }}
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
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $new->title }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs text-secondary mb-0">{{ $new->format_time }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('news.show', [$new->id]) }}"><i
                                                                class="fa-solid fa-eye"></i></a>
                                                        <a href="{{ route('news.edit', [$new->id]) }}"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteNewsModal-{{ $new->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                        <div class="modal fade" id="deleteNewsModal-{{ $new->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Ẩn bài viết</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Bạn có chắc muốn ẩn bài viết này không ?</p>
                                                                        <p>( Sau khi ẩn có thể khôi phục lại )</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('news.delete', [$new->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Ẩn</button>
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
        {{ $news->appends(Request::all())->links() }}
    </div>
@endsection
