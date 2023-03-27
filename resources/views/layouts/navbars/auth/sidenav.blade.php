<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('/img/logos/logo.png') }}" class="navbar-brand-img h-100"
                style="display: flex; margin: auto" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Trang chủ</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Quản lý người dùng</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'myprofile' ? 'active' : '' }}"
                    href="{{ route('myprofile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Trang cá nhân</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="{{ route('user.admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý người dùng</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Quản lý blogs</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'myblog') == true ? 'active' : '' }}"
                    href="{{ route('myblog.active') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-blog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blogs của tôi</span>
                </a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'blog-management') == true ? 'active' : '' }}"
                        href="{{ route('blog.active') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-brands fa-blogger-b text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý blog</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 1)
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Quản lý trang chủ</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'news-management') == true ? 'active' : '' }}"
                        href="{{ route('news.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-newspaper text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tin tức</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Quản lý lớp học</h6>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'class-management') == true ? 'active' : '' }}"
                        href="{{ route('class.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-book-open text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý lớp học</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'calendar-management') == true ? 'active' : '' }}"
                        href="{{ route('calendar.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-calendar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý lịch học</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'class-management') == true ? 'active' : '' }}"
                        href="{{ route('class.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-book-open text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Danh sách lớp học</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'calendar-management') == true ? 'active' : '' }}"
                        href="{{ route('calendar.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-calendar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Thời khóa biểu</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'my-grade') == true ? 'active' : '' }}"
                        href="{{ route('grade.my-grade') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-chalkboard text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Bảng điểm</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Quản lý tài chính</h6>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'payment-management/student') == true ? 'active' : '' }}"
                        href="{{ route('payment.management-student') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-money-check-dollar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tài chính học sinh</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'payment-management/teacher') == true ? 'active' : '' }}"
                        href="{{ route('payment.management-teacher') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-chalkboard-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tài chính giáo viên</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'payment-management/admin') == true ? 'active' : '' }}"
                        href="{{ route('payment.management-admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file-invoice-dollar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tài chính trung tâm</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'payment-management') == true ? 'active' : '' }}"
                        href="{{ route('payment.show-teacher', [Auth::user()->id]) }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file-invoice-dollar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tài chính</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'payment-management') == true ? 'active' : '' }}"
                        href="{{ route('payment.show-student', [Auth::user()->id]) }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file-invoice-dollar text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý tài chính</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'billing') == true ? 'active' : '' }}"
                        href="{{ route('payment.billing') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-coins text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Nộp tiền học</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id == 1)
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Quản lý đề thi</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ str_contains(request()->url(), 'exam-management') == true ? 'active' : '' }}"
                        href="{{ route('exam.management') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-clipboard-question text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quản lý đề thi</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
