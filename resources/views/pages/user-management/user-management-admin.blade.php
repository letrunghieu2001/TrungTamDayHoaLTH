@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý người dùng'])
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Quản lý người dùng</h6>
                        <a href="{{ route('user.create') }}"><button class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px;" class="p-2 bd-highlight">Tạo người dùng</button></a>
                        <a href="{{ route('user.delete-account') }}"><button
                                class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: grey" class="p-2 bd-highlight">Danh sách người dùng
                                bị vô hiệu hóa</button></a>
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm quản trị viên (theo mã - tên - email) ...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                <a href="{{ route('user.admin') }}">
                                    <button class="nav-link active" id="nav-home-tab" type="button"
                                        aria-selected="true">Quản trị
                                        viên</button>
                                </a>
                                <a href="{{ route('user.teacher') }}">
                                    <button class="nav-link " id="nav-profile-tab" type="button" aria-selected="false">Giáo
                                        viên</button>
                                </a>
                                <a href="{{ route('user.student') }}">
                                    <button class="nav-link" id="nav-contact-tab" aria-selected="false">Học sinh</button>
                                </a>
                            </div>
                        </nav>
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
                                                        @if (Auth::user()->id == $user->id)
                                                            <a href="{{ route('myprofile') }}"><i
                                                                    class="fa-solid fa-user-pen"></i></a>
                                                        @else
                                                            <a href="{{ route('user.edit', [$user->id]) }}"><i
                                                                    class="fa-solid fa-user-pen"></i></a>
                                                        @endif
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
                                                                            Vô hiệu hóa người dùng</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn vô hiệu hóa người dùng này không ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('user.delete', [$user->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger">Vô
                                                                                hiệu hóa</button>
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
