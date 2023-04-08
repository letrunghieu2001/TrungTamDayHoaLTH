@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Lớp học'])
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

        .lesson_name {
            margin: 15px 0;
            color: #6699FF;
        }

        .lesson-detail {
            margin: 10px 0 0 30px;
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
                        <h6 class="me-auto p-2 bd-highlight">{{ $class->name }}</h6>
                        @if (Auth::user()->role_id == 1)
                            <a href="{{ route('class.edit-teacher', [$class->id]) }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float"
                                    style="margin: 0 20px; background-color: purple" class="p-2 bd-highlight">Quản lý giáo
                                    viên</button></a>
                            <a href="{{ route('class.add-student', [$class->id]) }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Quản lý học sinh</button></a>
                            <a href="{{ route('class.add-calendar', [$class->id]) }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float"
                                    style="margin: 0 20px; background-color: grey" class="p-2 bd-highlight">Quản lý giờ
                                    học</button></a>
                        @endif
                    </div>
                    @if (Auth::user()->role_id != 3)
                        <a href="{{ route('class.show-attendance', [$class->id]) }}"><button
                                class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: #00CC33" class="p-2 bd-highlight">Xem danh sách
                                diểm danh</button></a>
                        <button class="btn btn-primary btn-sm ms-auto button-float" data-bs-toggle="modal"
                            data-bs-target="#createrLessonModal-{{ $class->id }}" style="margin: 20px;"
                            class="p-2 bd-highlight">Tạo bài học</button>
                        <a href="{{ route('class.show-grade', [$class->id]) }}"><button
                                class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: purple" class="p-2 bd-highlight">Xem thống kê
                                điểm</button></a>
                    @endif
                </div>
                <hr class="horizontal dark">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">Thông báo lớp học</h6>
                                    @if (Auth::user()->role_id != 3)
                                        <button class="btn btn-primary btn-sm ms-auto button-float" data-bs-toggle="modal"
                                            data-bs-target="#createrAnnouncementModal-{{ $class->id }}"
                                            style="margin: 20px;" class="p-2 bd-highlight">Tạo thông báo</button>
                                        <div class="modal fade" id="createrAnnouncementModal-{{ $class->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="width:150%" style="width:150%">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                            Tạo thông báo</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('announcement.store', [$class->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="appt">Nội dung:</label>
                                                                <textarea id="summernoteContent" name="content">{{ old('content') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-danger">Tạo thông
                                                                báo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                        @foreach ($announcements as $announcement)
                                            <li
                                                class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-3 text-sm">{{ $announcement->formatTime }}</h6>
                                                    <span
                                                        class="mb-2 text-xs">{{ $announcement->user->firstname . ' ' . $announcement->user->lastname . ' (' . optional($announcement->user)->unique_id . ')' }}:
                                                        <span
                                                            class="text-dark font-weight-bold ms-sm-2">{!! $announcement->content !!}</span></span>
                                                </div>
                                                @if (Auth::user()->role_id != 3)
                                                    <div class="ms-auto text-end">
                                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                            href="javascript:;" data-toggle="modal"
                                                            data-target="#deleteCommentModal-{{ $announcement->id }}"><i
                                                                class="far fa-trash-alt me-2"></i>Xóa</a>
                                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"
                                                            data-toggle="modal"
                                                            data-target="#updateCommentModal-{{ $announcement->id }}"><i
                                                                class="fas fa-pencil-alt text-dark me-2"></i>Sửa</a>
                                                    </div>
                                                    <div class="modal fade" id="updateCommentModal-{{ $announcement->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:150%">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Sửa thông báo</h1>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <form method="POST"
                                                                    action={{ route('announcement.update', [$announcement->id]) }}
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="comment" class="form-label">Nội
                                                                                dung</label>
                                                                            <textarea class="summernoteEditContent" id="summernoteEditContent" name="editContent">{!! $announcement->content !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            data-id="{{ $announcement->id }}"
                                                                            data-url="{{ route('comment.update', [$announcement->id]) }}"
                                                                            id="editComment">Xác nhận</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade"
                                                        id="deleteCommentModal-{{ $announcement->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:150%">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 d-flex p-2"
                                                                        id="exampleModalLabel">
                                                                        Xóa thông báo</h1>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close"><span
                                                                            aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có chắc muốn xóa thông báo này không ?
                                                                </div>
                                                                <div class="modal-footer"
                                                                    style="display: flex; justify-content: space-between">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Đóng</button>
                                                                    <form
                                                                        action="{{ route('announcement.delete', [$announcement->id, $class->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Xóa
                                                                            thông báo</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $announcements->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role_id != 3)
                        <div class="modal fade" id="createrLessonModal-{{ $class->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width:150%">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                            Thêm bài học</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('lesson.store', [$class->id]) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="appt">Tên bài học:</label>
                                                <input class="form-control" type="text" id="appt"
                                                    name="name">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-danger">Tạo bài học</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <h3 class="mb-0" style="margin: 20px 0">Danh sách bài học</h3>
                    @if (count($lessons) == 0)
                        Không có dữ liệu
                    @endif
                    @foreach ($lessons as $lesson)
                        <h3 class="lesson_name" class="me-auto p-2 bd-highlight">
                            {{ $lesson->name }}
                            @if (Auth::user()->role_id != 3)
                                <span style="cursor: pointer; float: right" data-bs-toggle="modal"
                                    data-bs-target="#updatelessonModal-{{ $lesson->id }}" class="tt-icon-btn"><i
                                        class="fa-solid fa-pencil"></i></span>
                                <div class="modal fade" id="updatelessonModal-{{ $lesson->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="width:150%">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                    Sửa bài học</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('lesson.update', [$lesson->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="appt">Tên bài học:</label>
                                                        <input class="form-control" type="text" id="appt"
                                                            value="{{ $lesson->name }}" name="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-danger">Sửa bài học</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </h3>
                        @if (Auth::user()->role_id != 3)
                            <button class="btn btn-primary btn-sm ms-auto button-float" data-bs-toggle="modal"
                                data-bs-target="#createrLessonDetailModal-{{ $lesson->id }}"
                                style="margin: 0 20px; background-color: #6699FF" class="p-2 bd-highlight">Thêm tài
                                liệu</button>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <a href="{{ route('lessondetail.add-attendance', [$class->id, $lesson->id]) }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float"
                                    style="margin: 0 20px; background-color: #FFFF66; color: black"
                                    class="p-2 bd-highlight">Điểm danh</button></a>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <button class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: #2dce89; color: black" class="p-2 bd-highlight"
                                data-bs-toggle="modal" data-bs-target="#createrExamModal-{{ $lesson->id }}">Thêm đề
                                kiểm tra</button>
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <button class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 0 20px; background-color: purple; color: white" class="p-2 bd-highlight"
                                data-bs-toggle="modal"
                                data-bs-target="#createTeacherAttendanceModal-{{ $lesson->id }}">Chấm công giáo
                                viên</button>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <div class="modal fade" id="createrLessonDetailModal-{{ $lesson->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Thêm tài liệu cho
                                                {{ $lesson->name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('lessondetail.store', [$class->id, $lesson->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="content">Upfile ( Chỉ up file video, ảnh, pdf, word,
                                                        powerpoint, excel):</label>
                                                    <input class="form-control" type="file" id="content"
                                                        name="content">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-danger">Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role_id != 3)
                            <div class="modal fade" id="createrExamModal-{{ $lesson->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Thêm đề kiểm tra cho
                                                {{ $lesson->name }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('lesson.store-exam', [$class->id, $lesson->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="content">Thêm đề kiểm tra:</label>
                                                    <select name="exam_id" class="form-select" required>
                                                        <option class="not-select" value="" disabled selected>
                                                            -- Chọn --</option>
                                                        @foreach ($exams as $exam)
                                                            <option value="{{ $exam->id }}">
                                                                {{ $exam->name . ' - Số câu hỏi: ' . $exam->number_questions . ' - Thời gian: ' . $exam->time . ' phút ' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-danger">Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <div class="modal fade" id="createTeacherAttendanceModal-{{ $lesson->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Chấm công giáo viên</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form
                                            action="{{ route('teacher-attendance.store', [$class->id, $lesson->id, $class->teacher_id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="content">Chấm công giáo viên</label>
                                                    <select name="status" class="form-select" required>
                                                        <option class="not-select" value="" disabled selected>
                                                            -- Chọn --</option>
                                                        <option value="0" <?php if (
                                                            App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                                ->where('teacher_id', $class->teacher_id)
                                                                ->where('status', 0)
                                                                ->exists()
                                                        ) {
                                                            echo 'selected';
                                                        }
                                                        if (
                                                            App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                                ->where('teacher_id', $class->teacher_id)
                                                                ->first() == null
                                                        ) {
                                                            echo 'selected';
                                                        } ?>>
                                                            Đúng giờ
                                                        </option>
                                                        <option value="1" <?php if (
                                                            App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                                ->where('teacher_id', $class->teacher_id)
                                                                ->where('status', 1)
                                                                ->exists()
                                                        ) {
                                                            echo 'selected';
                                                        } ?>>
                                                            Muộn
                                                        </option>
                                                        <option value="2" <?php if (
                                                            App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                                ->where('teacher_id', $class->teacher_id)
                                                                ->where('status', 2)
                                                                ->exists()
                                                        ) {
                                                            echo 'selected';
                                                        } ?>>
                                                            Vắng
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Tiền phạt
                                                        (nếu có tính theo VND - muộn 1p phạt 5k)
                                                        :</label>
                                                    <input class="form-control" type="number" <?php if (
                                                        App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                            ->where('teacher_id', $class->teacher_id)
                                                            ->exists()
                                                    ) {
                                                        $money = App\Models\TeacherAttendance::where('lesson_id', $lesson->id)
                                                            ->where('teacher_id', $class->teacher_id)
                                                            ->first();
                                                        $penalty_money = -$money->penalty_money;
                                                        echo 'value="' . $penalty_money . '"';
                                                    } else {
                                                        echo 'value="0"';
                                                    } ?>
                                                        min="0" step="any" name="penalty_money"
                                                        rows="2" style="resize: none">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-danger">Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <h4 class="mb-0" style="margin: 20px 0">Tài liệu</h4>
                        @if (count($lesson->lesson_details) == 0)
                            <p>Không có tài liệu</p>
                        @endif
                        @foreach ($lesson->lesson_details as $lesson_detail)
                            <div style="display: flex; align-items: center; justify-content: space-between">
                                <a href="{{ route('lessondetail.download', [$class->id, $lesson->id, $lesson_detail->id]) }}"
                                    style="text-decoration: underline">
                                    <h5 class="me-auto p-2 bd-highlight" class="lesson-detail" style="margin-left: 20px">
                                        <i class="fa-regular fa-file" style="margin-right: 10px"></i>
                                        {{ $lesson_detail->content }}
                                    </h5>
                                </a>
                                @if (Auth::user()->role_id != 3)
                                    <a style="cursor: pointer" data-bs-toggle="modal"
                                        data-bs-target="#deletelsModal-{{ $lesson_detail->id }}" class="tt-icon-btn"><i
                                            class="fa-solid fa-trash"></i></a>
                                    <div class="modal fade" id="deletelsModal-{{ $lesson_detail->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width:150%">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                        Xóa</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có chắc muốn xóa không ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Xóa</button>
                                                    <form
                                                        action="{{ route('lessondetail.delete', [$lesson_detail->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <h4 class="mb-0" style="margin: 20px 0">Kiểm tra</h4>
                        @if (count($lesson->exams) == 0)
                            <p>Không có kiểm tra</p>
                        @endif
                        @foreach ($lesson->exams as $exam)
                            <div style="display: flex; align-items: center; justify-content: space-between">
                                @if (\App\Models\Grade::where('lesson_id', $lesson->id)->where('student_id', Auth::user()->id)->where('exam_id', $exam->id)->exists())
                                    <a href="{{ route('exam.result-exam', [$exam->id, $lesson->id, Auth::user()->id ]) }}"
                                        style="text-decoration: underline">
                                    @else
                                        <a href="{{ route('exam.warning-exam', [$exam->id, $lesson->id]) }}"
                                            style="text-decoration: underline">
                                @endif
                                <h5 class="me-auto p-2 bd-highlight" class="lesson-detail" style="margin-left: 20px">
                                    <i class="fa-solid fa-scroll" style="margin-right: 10px"></i>
                                    {{ $exam->name . ' - Số câu hỏi: ' . $exam->number_questions . ' - Thời gian: ' . $exam->time . ' phút ' }}
                                </h5>
                                </a>
                                @if (Auth::user()->role_id != 3)
                                    <a style="cursor: pointer" data-bs-toggle="modal"
                                        data-bs-target="#deleteExamModal-{{ $exam->id }}" class="tt-icon-btn"><i
                                            class="fa-solid fa-trash"></i></a>
                                    <div class="modal fade" id="deleteExamModal-{{ $exam->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="width:150%">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                        Xóa</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có chắc muốn xóa không ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Xóa</button>
                                                    <form
                                                        action="{{ route('lesson.delete-exam', [$lesson->id, $exam->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <hr class="horizontal dark">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernoteContent').summernote({
            height: 400,
        });
        $('#summernoteEditContent').summernote({
            height: 400,
        });
    </script>
@endsection
