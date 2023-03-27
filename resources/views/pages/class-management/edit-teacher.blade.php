@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thay đổi giáo viên'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Thay đổi giáo viên {{ $class->name }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Giáo viên:</label>
                                    <form method="GET">
                                        @csrf
                                        <div class="input-group search" style="margin: 20px 0;">
                                            <span class="input-group-text text-body"><i class="fas fa-search"
                                                    aria-hidden="true"></i></span>
                                            <input type="text" name="q" class="form-control"
                                                value="{{ request()->get('q') }}"
                                                placeholder="Tìm kiếm giáo viên (theo mã - tên - email) ...">
                                            <button type="submit" style="display:none"></button>
                                        </div>
                                    </form>
                                    <form role="form" method="POST"
                                        action={{ route('class.update-teacher', [$class->id]) }}
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <table class="table align-items-center mb-0">
                                                            @if (count($teachers) > 0)
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-secondary opacity-7"></th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            Mã giáo viên</th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                            Giáo viên</th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            Thông tin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($teachers as $teacher)
                                                                        <tr>
                                                                            <td class="align-middle">
                                                                                <label><input type="radio"
                                                                                        id='radio-{{ $teacher->id }}'
                                                                                        name="teacher_id"
                                                                                        value="{{ $teacher->id }}"
                                                                                        <?php if ($class->teacher_id == $teacher->id) {
                                                                                            echo 'checked';
                                                                                        } ?>></label>
                                                                            </td>
                                                                            <td class="align-middle">
                                                                                <span
                                                                                    class="text-secondary text-xs font-weight-bold">{{ $teacher->unique_id }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex px-2 py-1">
                                                                                    <div>
                                                                                        <img src="{{ asset('storage/avatar/' . $teacher->avatar) }}"
                                                                                            class="avatar avatar-sm me-3"
                                                                                            alt="user1">
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex flex-column justify-content-center">
                                                                                        <h6 class="mb-0 text-sm">
                                                                                            {{ $teacher->firstname . ' ' . $teacher->lastname }}
                                                                                        </h6>
                                                                                        <p
                                                                                            class="text-xs text-secondary mb-0">
                                                                                            {{ $teacher->email }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                    {{ $teacher->gender }}</p>
                                                                                @if ($teacher->dobFormat != now()->day . '-' . now()->format('m') . '-' . now()->year)
                                                                                    <p class="text-xs text-secondary mb-0">
                                                                                        {{ $teacher->dobFormat }}</p>
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
                                                <button type="submit" class="btn btn-primary btn-sm ms-auto"
                                                    style="margin: 20px 0; float: right">Thay giáo viên</button>
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
