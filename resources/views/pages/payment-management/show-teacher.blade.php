@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tài chính giáo viên'])
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Quản lý tài chính giáo viên:
                            {{ $user->firstname . ' ' . $user->lastname }} - {{ $user->unique_id }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border " id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tên lớp</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tên buổi</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Được nhận</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dates as $date)
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            <tr>
                                                <td colspan="4" style="background-color: #fbd9d9">Tháng
                                                    {{ $date }}
                                                </td>
                                            </tr>
                                            @foreach ($lessons as $lesson)
                                                @if (\Carbon\Carbon::parse($lesson->created_at)->month == explode('/', $date)[0])
                                                    <tr>
                                                        <td>
                                                            {{ $lesson->class_name }}
                                                        </td>
                                                        <td>
                                                            {{ $lesson->lesson_name }}
                                                        </td>
                                                        <td class="price-{{ $date }}">
                                                            {{ number_format(($lesson->price_per_student * 60) / 100) }}
                                                        </td>
                                                        @php
                                                            $total_price += ($lesson->price_per_student * 60) / 100;
                                                        @endphp
                                                        <td>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td colspan="2"
                                                    style="background-color: #003768; color: white; font-weight: bold">Tổng
                                                    lương Tháng
                                                    {{ $date }}
                                                </td>
                                                <td>
                                                    {{ number_format($total_price) }}
                                                </td>
                                                <td style="border-width: 1px">
                                                    @php
                                                        $dateMonth = explode('/', $date)[0];
                                                        $dateYear = explode('/', $date)[1];
                                                    @endphp
                                                    @if (\App\Models\TeacherPayment::where('status', 0)->where('teacher_id', $user->id)->where('date', $date)->exists())
                                                        <a style="cursor: pointer"
                                                            class="btn btn-secondary not-approved badge badge-sm bg-gradient-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal-{{ $dateMonth . $dateYear }}"
                                                            class="tt-icon-btn">Đã nhận</a>
                                                        @if (Auth::user()->role_id == 1)
                                                            <div class="modal fade"
                                                                id="updateStatusModal-{{ $dateMonth . $dateYear }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="width:150%">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 d-flex p-2"
                                                                                id="exampleModalLabel">
                                                                                Cập nhật học phí</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Bạn có sửa trạng thái thành chưa nhận không
                                                                                ?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                            <form
                                                                                action="{{ route('payment.teacher-update-status', [$user->id, $dateMonth, $dateYear]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Xác nhận</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @elseif (\App\Models\TeacherPayment::where('status', 1)->where('teacher_id', $user->id)->where('date', $date)->exists())
                                                        <a style="cursor: pointer"
                                                            class="btn btn-secondary not-approved badge badge-sm bg-gradient-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateStatusModal-{{ $dateMonth . $dateYear }}"
                                                            class="tt-icon-btn">Chưa nhận</a>
                                                        @if (Auth::user()->role_id == 1)
                                                            <div class="modal fade"
                                                                id="updateStatusModal-{{ $dateMonth . $dateYear }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="width:150%">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 d-flex p-2"
                                                                                id="exampleModalLabel">
                                                                                Cập nhật học phí</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Bạn có sửa trạng thái thành đã nhận không
                                                                                ?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                            <form
                                                                                action="{{ route('payment.teacher-update-status', [$user->id, $dateMonth, $dateYear]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Xác nhận</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
