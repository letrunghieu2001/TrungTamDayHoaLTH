@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Danh sách lớp học bị ẩn'])
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
                        <a href="{{ URL::signedRoute('class.management') }}" style="color: blue; font-size: 15px"><i
                                class="fa-solid fa-arrow-left-long"></i> Trang trước</a>
                    </div>
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Danh sách lớp học bị ẩn</h6>
                        @if (count($classes) > 0)
                            <form action="{{ route('class.restore-all') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Khôi phục toàn bộ lớp học</button>
                            </form>
                        @endif
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 10px 0 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm lớp học bị ẩn...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($classes) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    STT</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tên lớp học</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Giáo viên</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Thông tin học sinh</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Lịch học</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Trạng thái</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $classes->perPage() * ($classes->currentPage() - 1) + $loop->iteration }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $class->name }}</span>
                                                    </td>
                                                    <td>
                                                        @if (optional($class->teacher)->email != null)
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/avatar/' . optional($class->teacher)->avatar) }}"
                                                                        class="avatar avatar-sm me-3" alt="teacher1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ optional($class->teacher)->firstname . ' ' . optional($class->teacher)->lastname }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ optional($class->teacher)->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="text-secondary overflow text-xs font-weight-bold">Tài
                                                                khoản đã bị xóa</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p class="text-xs text-secondary mb-0">
                                                            Số học sinh:
                                                            {{ DB::table('class_students')->where('class_id', $class->id)->count() }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            Tiền học mỗi học sinh: {{ $class->price_per_student }} VND
                                                        </p>
                                                    </td>
                                                    <td>
                                                        @foreach ($class->calendars as $calendar)
                                                            @if (optional($calendar)->day_of_the_week == 0)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Chủ Nhật' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 1)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ hai' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 2)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ ba' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 3)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ tư' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 4)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ năm' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 5)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ sáu' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                            @if (optional($calendar)->day_of_the_week == 6)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ 'Thứ bảy' . ' ' . optional($calendar)->start_hour . ' - ' . optional($calendar)->end_hour }}
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="align-middle text-sm">
                                                        @if ($class->status == 1)
                                                            <span class="badge badge-sm bg-gradient-success">Đang học</span>
                                                        @else
                                                            <span class="badge badge-sm bg-gradient-secondary">Kết
                                                                thúc</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#restoreUserModal-{{ $class->id }}"
                                                            class="tt-icon-btn"><i
                                                                class="fa-solid fa-trash-arrow-up"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUserModal-{{ $class->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-ban"></i></a>
                                                        <div class="modal fade" id="deleteUserModal-{{ $class->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Xóa hoàn toàn lớp học</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn xóa hoàn toàn lớp học này không
                                                                        ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('class.force-delete', [$class->id]) }}"
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
                                                        <div class="modal fade" id="restoreUserModal-{{ $class->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Khôi phục lớp học</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Bạn có chắc muốn khôi phục lớp học này không ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('class.restore', [$class->id]) }}"
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
        {{ $classes->appends(Request::all())->links() }}
    </div>
@endsection
