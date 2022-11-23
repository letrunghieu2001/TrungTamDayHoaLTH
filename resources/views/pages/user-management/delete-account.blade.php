@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Danh sách người dùng bị vô hiệu hóa'])
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div>
                        <a href="{{ URL::signedRoute('user.admin') }}" style="color: blue; font-size: 15px"><i
                                class="fa-solid fa-arrow-left-long"></i> Trang trước</a>
                    </div>
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Danh sách người dùng bị vô hiệu hóa</h6>
                        @if (count($users) > 0)
                            <form action="{{ route('user.restore-all') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Khôi phục toàn bộ người dùng</button>
                            </form>
                        @endif
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 10px 0 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm người dùng bị vô hiệu hóa...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($users) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Mã người dùng</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Người dùng</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Thông tin</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $user->unique_id }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                                                                    class="avatar avatar-sm me-3" alt="user1">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    {{ $user->firstname . ' ' . $user->lastname }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $user->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $user->gender }}</p>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->dobFormat }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#restoreUserModal-{{ $user->id }}"
                                                            class="tt-icon-btn"><i
                                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUserModal-{{ $user->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-user-xmark"></i></a>
                                                        <div class="modal fade" id="deleteUserModal-{{ $user->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Xóa hoàn toàn người dùng</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn xóa hoàn toàn người dùng này không
                                                                        ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('user.force-delete', [$user->id]) }}"
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
                                                        <div class="modal fade" id="restoreUserModal-{{ $user->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Khôi phục người dùng</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn khôi phục người dùng này không ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('user.restore', [$user->id]) }}"
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
@endsection
