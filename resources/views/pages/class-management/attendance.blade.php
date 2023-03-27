@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Điểm danh'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Điểm danh cho
                                {{ $lesson->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Học sinh:</label>
                                    <form role="form" method="POST"
                                        action={{ route('lessondetail.store-attendance', [$class->id, $lesson->id]) }}
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <table class="table align-items-center mb-0">
                                                            @if (count($studentsList) > 0)
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
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            Có</th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            Vắng</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($studentsList as $student)
                                                                        <tr>
                                                                            <td class="align-middle">
                                                                                <span
                                                                                    class="text-secondary text-xs font-weight-bold">{{ $student->unique_id }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex px-2 py-1">
                                                                                    <div>
                                                                                        <img src="{{ asset('storage/avatar/' . $student->avatar) }}"
                                                                                            class="avatar avatar-sm me-3"
                                                                                            alt="user1">
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex flex-column justify-content-center">
                                                                                        <h6 class="mb-0 text-sm">
                                                                                            {{ $student->firstname . ' ' . $student->lastname }}
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-xs text-secondary mb-0">
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
                                                                            <td>
                                                                                <label><input type="radio"
                                                                                        name="status[{{ $student->student_id }}]"
                                                                                        value="0"
                                                                                        <?php if (
                                                                                            App\Models\Attendance::where('lesson_id', $lesson->id)
                                                                                                ->where('student_id', $student->student_id)
                                                                                                ->where('status', 0)
                                                                                                ->exists()
                                                                                        ) {
                                                                                            echo 'checked';
                                                                                        }
                                                                                        if (
                                                                                            App\Models\Attendance::where('lesson_id', $lesson->id)
                                                                                                ->where('student_id', $student->student_id)
                                                                                                ->first() == null
                                                                                        ) {
                                                                                            echo 'checked';
                                                                                        } ?>></label>
                                                                            </td>
                                                                            <td>
                                                                                <label><input type="radio"
                                                                                        name="status[{{ $student->student_id }}]"
                                                                                        value="1"
                                                                                        <?php if (
                                                                                            App\Models\Attendance::where('lesson_id', $lesson->id)
                                                                                                ->where('student_id', $student->student_id)
                                                                                                ->where('status', 1)
                                                                                                ->exists()
                                                                                        ) {
                                                                                            echo 'checked';
                                                                                        } ?>></label>
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
                                                <button type="submit" class="btn btn-primary btn-sm ms-auto"
                                                    style="margin: 20px 0; float: right">Lưu điểm danh</button>
                                            </div>
                                        </div>
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
@endsection
