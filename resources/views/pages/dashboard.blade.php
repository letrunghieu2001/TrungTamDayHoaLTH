@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    @if (Auth::user()->role_id == 1)
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng số học sinh </p>
                                        <h5 class="font-weight-bolder">
                                            {{ App\Models\User::where('role_id', 3)->count() }}
                                        </h5>
                                        {{-- <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                        since last week
                                    </p> --}}
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="fa-solid fa-graduation-cap text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">Tổng quan học sinh {{ now()->year }}</h6>
                                <p class="text-sm mb-0">
                                    {{-- <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021 --}}
                                </p>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line-student" class="chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4" style="margin-top: 40px">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng số giáo viên </p>
                                        <h5 class="font-weight-bolder">
                                            {{ App\Models\User::where('role_id', 2)->count() }}
                                        </h5>
                                        {{-- <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p> --}}
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fa-solid fa-chalkboard-user text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 mb-lg-0 mb-4">
                        <div class="card z-index-2 h-100">
                            <div class="card-header pb-0 pt-3 bg-transparent">
                                <h6 class="text-capitalize">Tổng quan giáo viên {{ now()->year }}</h6>
                                <p class="text-sm mb-0">
                                    {{-- <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021 --}}
                                </p>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line-teacher" class="chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6" style="margin-top: 40px">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng số lớp học</p>
                                        <h5 class="font-weight-bolder">
                                            {{ App\Models\ChemistryClass::query()->count() }}
                                        </h5>
                                        {{-- <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p> --}}
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="fa-solid fa-book text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Tổng quan lớp học {{ now()->year }}</h6>
                            <p class="text-sm mb-0">
                                {{-- <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021 --}}
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line-class" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-12 col-sm-12 mb-xl-12 mb-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p>Chào mừng đến website quản lý lớp học LTH Chemistry</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script type="text/javascript">
        var ctx1 = document.getElementById("chart-line-student").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                datasets: [{
                    label: "Số học sinh",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [{{ App\Models\User::whereMonth('created_at', 1)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 2)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 3)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 4)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 5)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 6)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 7)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 8)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 9)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 10)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 11)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 12)->whereYear('created_at', now()->year)->where('role_id', 3)->count() }}
                    ],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx2 = document.getElementById("chart-line-teacher").getContext("2d");

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(127, 255, 212, 0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(127, 255, 212, 0.0)');
        gradientStroke2.addColorStop(0, 'rgba(127, 255, 212, 0)');
        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                datasets: [{
                    label: "Số giáo viên",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#2dce89",
                    backgroundColor: gradientStroke2,
                    borderWidth: 3,
                    fill: true,
                    data: [{{ App\Models\User::whereMonth('created_at', 1)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 2)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 3)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 4)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 5)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 6)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 7)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 8)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 9)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 10)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 11)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }},
                        {{ App\Models\User::whereMonth('created_at', 12)->whereYear('created_at', now()->year)->where('role_id', 2)->count() }}
                    ],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-class").getContext("2d");

        var gradientStroke3 = ctx3.createLinearGradient(0, 230, 0, 50);

        gradientStroke3.addColorStop(1, 'rgba(255, 140, 0, 0.2)');
        gradientStroke3.addColorStop(0.2, 'rgba(255, 140, 0, 0.0)');
        gradientStroke3.addColorStop(0, 'rgba(255, 140, 0, 0)');
        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],
                datasets: [{
                    label: "Số lớp học",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#ff8c00",
                    backgroundColor: gradientStroke3,
                    borderWidth: 3,
                    fill: true,
                    data: [{{ App\Models\ChemistryClass::whereMonth('created_at', 1)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 2)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 3)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 4)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 5)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 6)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 7)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 8)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 9)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 10)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 11)->whereYear('created_at', now()->year)->count() }},
                        {{ App\Models\ChemistryClass::whereMonth('created_at', 12)->whereYear('created_at', now()->year)->count() }}
                    ],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
