@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Điểm'])
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
                        <h6 class="me-auto p-2 bd-highlight">Kết quả học tập học sinh:
                            {{ $user->firstname . ' ' . $user->lastname }} - {{ $user->unique_id }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border " id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($exams) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Tên bài kiểm tra</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Thông tin</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Điểm</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exams as $exam)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $exam->exam_name }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Tên lớp:
                                                            {{ $exam->class_name }}
                                                        </p>
                                                        <p class="text-xs text-secondary mb-0">
                                                            Tên buổi học: {{ $exam->lesson_name }}</p>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $exam->grade }}</span>
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ route('exam.result-exam', [$exam->exam_id, $exam->lesson_id, Auth::user()->id]) }}"><i
                                                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
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
