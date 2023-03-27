@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Xem danh sách điểm danh'])
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
                        <h6 class="me-auto p-2 bd-highlight">{{ $class->name }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($class->students) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Mã học sinh</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Học sinh</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Thông tin</th>
                                                @foreach ($exams as $exam)
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        {{ $exam->exam_name . ' ( ' . $exam->lesson_name . ' ) ' }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($class->students as $student)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $student->unique_id }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="{{ asset('storage/avatar/' . $student->avatar) }}"
                                                                    class="avatar avatar-sm me-3" alt="user1">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">
                                                                    {{ $student->firstname . ' ' . $student->lastname }}
                                                                </h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    {{ $student->email }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            {{ $student->gender }}</p>
                                                        @if ($student->dobFormat != now()->day . '-' . now()->format('m') . '-' . now()->year)
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $student->dobFormat }}</p>
                                                        @endif
                                                    </td>
                                                    @foreach ($exams as $exam)
                                                        <td>
                                                            <?php
                                                            $userGrade = \App\Models\Grade::where('student_id', $student->id)
                                                                ->where('exam_id', $exam->exam_id)
                                                                ->first();
                                                            ?>
                                                            @if (optional($userGrade)->grade == null)
                                                                Chưa có dữ liệu
                                                            @else
                                                                {{ $userGrade->grade }}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                            @endforeach
                                            </tr>
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
