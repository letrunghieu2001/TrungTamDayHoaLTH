@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tạo lớp học'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('class.store-step-one') }}
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Tạo lớp học mới - Bước 1: Thông tin cơ bản</p>
                            </div>
                            <div id="alert">
                                @include('components.alert')
                            </div>
                        </div>
                        <div class="card-body">
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tên lớp:</label>
                                        <textarea class="form-control" type="text" name="name" value="{{ $class->name ?? '' }}" rows="2"
                                            style="resize: none">{{ $class->name ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Giá tiền mỗi học sinh
                                            (tính theo VND):</label>
                                        <input class="form-control" type="number"
                                            value="{{ $class->price_per_student ?? '' }}" min="1" step="any"
                                            name="price_per_student" rows="2"
                                            style="resize: none">
                                    </div>
                                </div>
                                <input class="form-control" type="text" value="1" name="status" rows="2"
                                    style="display: none">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto" style="float:right">Sang
                                        bước 2</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
