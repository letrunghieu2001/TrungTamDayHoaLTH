@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tạo người dùng'])
    <style>
        .custom-profile-pic {
            color: transparent;
            transition: all .3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: all .3s ease;
        }

        .custom-profile-pic input {
            display: none;
        }

        .custom-profile-pic img {
            position: absolute;
            object-fit: cover;
            width: 100px;
            height: 100px;
            box-shadow: 0 0 10px 0 rgba(255, 255, 255, .35);
            border-radius: 100px;
            z-index: 0;
        }

        .custom-profile-pic .avatar-label {
            cursor: pointer;
            height: 100px;
            width: 100px;
        }

        .custom-profile-pic:hover .avatar-label {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, .8);
            z-index: 10000;
            color: rgb(250, 250, 250);
            transition: rgb(25, 24, 21) .2s ease-in-out;
            border-radius: 100px;
            margin: 10px -2px;
        }

        .custom-profile-pic span {
            display: flex;
            padding: .2em;
            height: 2em;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ asset('storage/avatar/default-avatar.png') }}" alt="profile_image"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            Họ và tên
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Quyền
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('user.store') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Thông tin cá nhân</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu thay đổi</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Ảnh đại diện</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-profile-pic">
                                            <label class="avatar-label" for="file">
                                                <span class="glyphicon glyphicon-camera"></span>
                                                <span>Đổi ảnh</span>
                                            </label>
                                            <input id="file" name="avatar" type="file"
                                                onchange="loadFile(event)" />
                                            <img src="{{ asset('storage/avatar/default-avatar.png') }}" id="output"
                                                width="500" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-uppercase text-sm">Thông tin cơ bản</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Họ</label>
                                        <input class="form-control" type="text" name="firstname"
                                            value="{{ old('firstname') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tên</label>
                                        <input class="form-control" type="text" name="lastname"
                                            value="{{ old('lastname') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Địa chỉ email</label>
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Quyền</label>
                                        <select name="role_id" class="form-select">
                                            <option class="not-select" value="" disabled selected>
                                                -- Quyền --</option>
                                            <option value="1" @if (old('role_id') == '1') selected @endif>
                                                Quản trị viên</option>
                                            <option value="2" @if (old('role_id') == '2') selected @endif>
                                                Giáo viên</option>
                                            <option value="3" @if (old('role_id') == '3') selected @endif>
                                                Học sinh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Mật khẩu</label>
                                        <input class="form-control" type="password" id="password" name="password"
                                            placeholder="Mật khẩu">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">Xác nhận mật khẩu</label>
                                        <input class="form-control" type="password" id="password_confirmation"
                                            name="password_confirmation" placeholder="Xác nhận mật khẩu">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Thông tin liên hệ</p>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Số điện thoại</label>
                                        <input class="form-control" type="text" name="phone"
                                            value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ngày sinh</label>
                                        <input class="form-control" type="date" name="dob"
                                            value="{{ old('dob') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Giới tính</label>
                                        <select name="gender" class="form-select">
                                            <option class="not-select" value="" disabled selected>
                                                -- Giới tính --</option>
                                            <option value="Nam" @if (old('gender') == 'Nam') selected @endif>
                                                Nam</option>
                                            <option value="Nữ" @if (old('gender') == 'Nữ') selected @endif>
                                                Nữ</option>
                                            <option value="Khác" @if (old('gender') == 'Khác') selected @endif>
                                                Khác</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Địa chỉ</label>
                                        <input class="form-control" type="text" name="address"
                                            value="{{ old('address') }}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Thông tin chuyển khoản</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Ngân hàng</label>
                                        <input class="form-control" type="text" name="bank"
                                            value="{{ old('bank') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Số tài khoản</label>
                                        <input class="form-control" type="text" name="credit_number"
                                            value="{{ old('credit_number') }}">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Giới thiệu</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Đôi nét về bản
                                            thân</label>
                                        <textarea class="form-control" type="text" name="about" rows="6" style="resize: none">{{ old('about') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
