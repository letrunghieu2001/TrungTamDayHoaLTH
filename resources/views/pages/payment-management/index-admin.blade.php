@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tài chính'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12" style="margin: 20px 0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fas fa-landmark opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Vốn ban đầu</h6>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ number_format($firstMoney) }} VND</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-4">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fab fa-paypal opacity-10"></i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">Tổng tài sản hiện tại</h6>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">
                                            {{ number_format($firstMoney + \App\Models\AdminPayment::sum('money')) }} VND
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Thống kê tài chính</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        @foreach ($dates as $date)
                            @php
                                $dateMonth = explode('/', $date)[0];
                                $dateYear = explode('/', $date)[1];
                            @endphp
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column"
                                        style="display: flex; align-items:center; justify-content: center">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $date }}</h6>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        {{ number_format(\App\Models\AdminPayment::where('date', $date)->sum('money')) }}
                                        VND
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i
                                                class="fas fa-file-pdf text-lg me-1"><a
                                                    href="{{ route('payment.generate-pdf-admin', [$dateMonth, $dateYear]) }}"></i>
                                            PDF</a></button>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($dates as $date)
                @php
                    $dateMonth = explode('/', $date)[0];
                    $dateYear = explode('/', $date)[1];
                @endphp
                <div class="col-md-6 mt-4">
                    <div class="card h-100 mb-4">
                        <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Quản lý chi tiêu</h6>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <small>{{ $date }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3"><button
                                    class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight" data-bs-toggle="modal"
                                    data-bs-target="#createPaymentModal-{{ $dateMonth . $dateYear }}">Tạo chi tiêu
                                    mới</button></h6>
                            <div class="modal fade" id="createPaymentModal-{{ $dateMonth . $dateYear }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:150%">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 d-flex p-2" id="exampleModalLabel">
                                                Tạo chi tiêu mới</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('payment.store', [$dateMonth, $dateYear]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Nội dung chi
                                                        tiêu</label>
                                                    <input class="form-control" type="text" name="content"
                                                        value="{{ old('content') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Số tiền
                                                        (tính theo VND)
                                                        :</label>
                                                    <input class="form-control" type="number" value="{{ old('money') }}"
                                                        min="1" step="any" name="money" rows="2"
                                                        style="resize: none">
                                                </div>
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Loại</label>
                                                    <select name="status" class="form-select">
                                                        <option class="not-select" value="" disabled selected>
                                                            -- Loại --</option>
                                                        <option value="0"
                                                            @if (old('status') == '0') selected @endif>
                                                            Chi phí</option>
                                                        <option value="1"
                                                            @if (old('status') == '1') selected @endif>
                                                            Doanh thu</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-danger">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                @foreach ($payments as $payment)
                                    @if ($payment->date == $date && $payment->status == 0)
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-arrow-down"></i></button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{ $payment->content }}</h6><span>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#updateUserModal-{{ $payment->id }}"
                                                            class="tt-icon-btn"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUserModal-{{ $payment->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                        <div class="modal fade" id="updateUserModal-{{ $payment->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Sửa chi tiêu</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('payment.update', [$payment->id, $dateMonth, $dateYear]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Nội dung chi
                                                                                    tiêu</label>
                                                                                <input class="form-control" type="text"
                                                                                    name="content"
                                                                                    value="{{ $payment->content }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Số tiền
                                                                                    (tính theo VND)
                                                                                    :</label>
                                                                                <input class="form-control" type="number"
                                                                                    value="{{ -$payment->money }}"
                                                                                    min="1" step="any"
                                                                                    name="money" rows="2"
                                                                                    style="resize: none">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Loại</label>
                                                                                <select name="status"
                                                                                    class="form-select">
                                                                                    <option class="not-select"
                                                                                        value="" disabled selected>
                                                                                        -- Loại --</option>
                                                                                    <option value="0"
                                                                                        @if ($payment->status == '0') selected @endif>
                                                                                        Chi phí</option>
                                                                                    <option value="1"
                                                                                        @if ($payment->status == '1') selected @endif>
                                                                                        Doanh thu</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-danger">Xác
                                                                            nhận</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="deleteUserModal-{{ $payment->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Ẩn bài viết</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Bạn có chắc muốn xóa hóa đơn này không ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('payment.delete', [$payment->id, $dateMonth, $dateYear]) }}"
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
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                {{ number_format($payment->money) }} VND
                                            </div>
                                        </li>
                                    @elseif ($payment->date == $date && $payment->status == 1)
                                        <li
                                            class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button
                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                        class="fas fa-arrow-up"></i></button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">{{ $payment->content }}</h6><span>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#updateUserModal-{{ $payment->id }}"
                                                            class="tt-icon-btn"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deleteUserModal-{{ $payment->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                        <div class="modal fade" id="updateUserModal-{{ $payment->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Sửa chi tiêu</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('payment.update', [$payment->id, $dateMonth, $dateYear]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Nội dung chi
                                                                                    tiêu</label>
                                                                                <input class="form-control" type="text"
                                                                                    name="content"
                                                                                    value="{{ $payment->content }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Số tiền
                                                                                    (tính theo VND)
                                                                                    :</label>
                                                                                <input class="form-control" type="number"
                                                                                    value="{{ -$payment->money }}"
                                                                                    min="1" step="any"
                                                                                    name="money" rows="2"
                                                                                    style="resize: none">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="example-text-input"
                                                                                    class="form-control-label">Loại</label>
                                                                                <select name="status"
                                                                                    class="form-select">
                                                                                    <option class="not-select"
                                                                                        value="" disabled selected>
                                                                                        -- Loại --</option>
                                                                                    <option value="0"
                                                                                        @if ($payment->status == '0') selected @endif>
                                                                                        Chi phí</option>
                                                                                    <option value="1"
                                                                                        @if ($payment->status == '1') selected @endif>
                                                                                        Doanh thu</option>
                                                                                </select>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <button type="submit" class="btn btn-danger">Xác
                                                                            nhận</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="deleteUserModal-{{ $payment->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Ẩn bài viết</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Bạn có chắc muốn xóa hóa đơn này không ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('payment.delete', [$payment->id]) }}"
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
                                                    </span>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                                {{ number_format($payment->money) }} VND
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                                <hr class="horizontal dark">
                                @if (number_format(\App\Models\AdminPayment::where('date', $date)->sum('money')) >= 0)
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fa-solid fa-sack-xmark"></i></button>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Tổng</h6>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                            {{ number_format(\App\Models\AdminPayment::where('date', $date)->sum('money')) }}
                                            VND
                                        </div>
                                    @else
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button
                                                class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i
                                                    class="fa-solid fa-sack-xmark"></i></button>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">Tổng</h6>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                            {{ number_format(\App\Models\AdminPayment::where('date', $date)->sum('money')) }}
                                            VND
                                        </div>
                                @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
