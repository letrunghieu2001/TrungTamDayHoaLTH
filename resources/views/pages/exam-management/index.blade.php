@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tổng hợp đề thi'])
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
                        <h6 class="me-auto p-2 bd-highlight">Tổng hợp đề thi</h6>
                        @if (Auth::user()->role_id == 1)
                            <a style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#createExamModal"><button
                                    class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Tạo đề thi</button></a>
                            <div class="modal fade" id="createExamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Tạo đề thi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('exam.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Tên đề
                                                        thi:</label>
                                                    <textarea class="form-control" type="text" name="name" rows="2" style="resize: none"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Thời gian
                                                        (tính theo phút):</label>
                                                    <input class="form-control" type="number" min="1" step="1"
                                                        name="time" rows="2" style="resize: none">
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Số câu
                                                        hỏi</label>
                                                    <input class="form-control" type="number" min="1" step="1"
                                                        name="number_questions" rows="2" style="resize: none">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-danger">Tạo đề thi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
                <form method="GET">
                    @csrf
                    <div class="input-group search" style="margin: 20px 0;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                            placeholder="Tìm kiếm đề thi ...">
                    </div>
                </form>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <table class="table align-items-center mb-0">
                                @if (count($exams) > 0)
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                STT</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tên đề thi</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thời gian</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Số câu hỏi</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary overflow text-xs font-weight-bold">{{ $exams->perPage() * ($exams->currentPage() - 1) + $loop->iteration }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary overflow text-xs font-weight-bold">{{ $exam->name }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary overflow text-xs font-weight-bold">{{ $exam->time }}
                                                        phút</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary overflow text-xs font-weight-bold">{{ $exam->number_questions }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('exam.add-question', [$exam->id]) }}"><i
                                                            class="fa-solid fa-square-plus"></i></a>
                                                    <a style="cursor: pointer" data-bs-toggle="modal"
                                                        data-bs-target="#editclassModal-{{ $exam->id }}"
                                                        class="tt-icon-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <div class="modal fade" id="editclassModal-{{ $exam->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content" style="width:150%">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 d-flex p-2"
                                                                        id="exampleModalLabel">
                                                                        Chỉnh sửa form đề</h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('exam.update', [$exam->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="example-text-input" class="form-control-label">Tên đề
                                                                                thi:</label>
                                                                            <textarea class="form-control" type="text" name="name" rows="2" style="resize: none" required>{{ $exam->name ?? '' }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="example-text-input" class="form-control-label" >Thời gian
                                                                                (tính theo phút):</label>
                                                                            <input class="form-control" type="number" min="1" step="1"
                                                                                name="time" rows="2" style="resize: none" value="{{ $exam->time ?? '' }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-danger">Thay
                                                                            đổi</button>
                                                                    </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <a style="cursor: pointer" data-bs-toggle="modal"
                                                        data-bs-target="#deleteclassModal-{{ $exam->id }}"
                                                        class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                    <div class="modal fade" id="deleteclassModal-{{ $exam->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
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
                                                                    <p>Bạn có chắc muốn xóa đề thi này không ?
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Đóng</button>
                                                                    <form
                                                                        action="{{ route('exam.delete', [$exam->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Xóa</button>
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
        {{ $exams->appends(Request::all())->links() }}
    </div>
@endsection
