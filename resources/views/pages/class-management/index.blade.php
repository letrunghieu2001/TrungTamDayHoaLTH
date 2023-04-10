@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tất cả lớp học'])
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
                        <h6 class="me-auto p-2 bd-highlight">Danh sách lớp học</h6>
                        @if (Auth::user()->role_id == 1)
                            <a href="{{ route('class.create-step-one') }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Tạo lớp học</button></a>
                            <a href="{{ route('class.delete-class') }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float"
                                    style="margin: 0 20px; background-color: grey" class="p-2 bd-highlight">Danh sách lớp
                                    học
                                    bị ẩn</button></a>
                        @endif
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm lớp học ...">
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
                                                @if (Auth::user()->role_id != 3)
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Thông tin học sinh</th>
                                                @endif
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
                                                    @if (Auth::user()->role_id != 3)
                                                        <td>
                                                            <p class="text-xs text-secondary mb-0">
                                                                Số học sinh:
                                                                {{ DB::table('class_students')->where('class_id', $class->id)->count() }}
                                                            </p>
                                                            @if (Auth::user()->role_id == 1)
                                                                <p class="text-xs text-secondary mb-0">
                                                                    Tiền học mỗi học sinh:
                                                                    {{ number_format($class->price_per_student) }} VND
                                                                </p>
                                                            @endif
                                                        </td>
                                                    @endif
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
                                                        @if (Auth::user()->role_id != 3)
                                                            <a href="{{ route('class.show', [$class->id]) }}"><i
                                                                    class="fa-solid fa-eye"></i></a>
                                                        @else
                                                            <a href="{{ route('class.show', [$class->class_id]) }}"><i
                                                                    class="fa-solid fa-eye"></i></a>
                                                        @endif
                                                        @if (Auth::user()->role_id == 1)
                                                            <a style="cursor: pointer" data-bs-toggle="modal"
                                                                data-bs-target="#editclassModal-{{ $class->id }}"
                                                                class="tt-icon-btn"><i
                                                                    class="fa-solid fa-pen-to-square"></i></a>
                                                            <div class="modal fade" id="editclassModal-{{ $class->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="width:150%">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 d-flex p-2"
                                                                                id="exampleModalLabel">
                                                                                Chỉnh sửa lớp học</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('class.update', [$class->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Tên
                                                                                    lớp:</label>
                                                                                <textarea class="form-control" type="text" name="name" value="{{ $class->name ?? '' }}" rows="2"
                                                                                    style="resize: none">{{ $class->name ?? '' }}</textarea>
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Giá tiền
                                                                                    mỗi
                                                                                    học
                                                                                    sinh
                                                                                    (tính theo VND)
                                                                                    :</label>
                                                                                <input class="form-control" type="number"
                                                                                    value="{{ $class->price_per_student ?? '' }}"
                                                                                    min="1" step="any"
                                                                                    name="price_per_student"
                                                                                    rows="2" style="resize: none">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Trạng
                                                                                    thái</label>
                                                                                <select name="status"
                                                                                    class="form-select">
                                                                                    <option value="1"
                                                                                        @if ($class->status == '1') selected @endif>
                                                                                        Đang học</option>
                                                                                    <option value="0"
                                                                                        @if ($class->status == '0') selected @endif>
                                                                                        Kết thúc</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Thay
                                                                                    đổi</button>
                                                                            </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <a style="cursor: pointer" data-bs-toggle="modal"
                                                                data-bs-target="#deleteclassModal-{{ $class->id }}"
                                                                class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                            <div class="modal fade"
                                                                id="deleteclassModal-{{ $class->id }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content" style="width:150%">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5 d-flex p-2"
                                                                                id="exampleModalLabel">
                                                                                Ẩn lớp học</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Bạn có chắc muốn ẩn lớp học này không ?
                                                                            </p>
                                                                            <p>( Sau khi ẩn có thể khôi phục lại )</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Đóng</button>
                                                                            <form
                                                                                action="{{ route('class.delete', [$class->id]) }}"
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
                                                        @endif
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
