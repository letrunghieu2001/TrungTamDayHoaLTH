@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tạo lịch học'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('calendar.store') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Tạo lịch học mới</p>
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
                                        <label for="example-text-input" class="form-control-label">Ngày học:</label>
                                        <select name="day_of_the_week" class="form-select">
                                            <option class="not-select" value="" disabled selected>
                                                -- Thứ --</option>
                                            <option value="1" @if (old('day_of_the_week') == '1') selected @endif>
                                                Thứ hai</option>
                                            <option value="2" @if (old('day_of_the_week') == '2') selected @endif>
                                                Thứ ba</option>
                                            <option value="3" @if (old('day_of_the_week') == '3') selected @endif>
                                                Thứ tư</option>
                                            <option value="4" @if (old('day_of_the_week') == '4') selected @endif>
                                                Thứ năm</option>
                                            <option value="5" @if (old('day_of_the_week') == '5') selected @endif>
                                                Thứ sáu</option>
                                            <option value="6" @if (old('day_of_the_week') == '6') selected @endif>
                                                Thứ bảy</option>
                                            <option value="0" @if (old('day_of_the_week') == '0') selected @endif>
                                                Chủ nhật</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="appt">Giờ bắt đầu học:</label>
                                        <input class="form-control" type="time" id="appt" name="start_hour">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="appt">Giờ kết thúc:</label>
                                        <input class="form-control" type="time" id="appt" name="end_hour">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto" style="float:right">Xác
                                        nhận</button>
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
