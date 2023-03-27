@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tài chính học sinh'])
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Quản lý tài chính học sinh</h6>
                    </div>
                    <form method="GET">
                        @csrf
                        <div class="input-group search" style="margin: 20px 0;">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}"
                                placeholder="Tìm kiếm học sinh (theo mã - tên - email) ...">
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                STT</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Mã người dùng</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Người dùng</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Thông tin</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary overflow text-xs font-weight-bold">{{ $users->perPage() * ($users->currentPage() - 1) + $loop->iteration }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->unique_id }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('storage/avatar/' . $user->avatar) }}"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $user->firstname . ' ' . $user->lastname }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $user->email }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->gender }}</p>
                                                    @if ($user->dobFormat != now()->day . '-' . now()->format('m') . '-' . now()->year)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $user->dobFormat }}</p>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('payment.show-student', [$user->id]) }}"><i
                                                            class="fa-solid fa-magnifying-glass-dollar"></i></a>
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
    <div class="d-flex justify-content-center">
        {{ $users->appends(Request::all())->links() }}
    </div>
@endsection
