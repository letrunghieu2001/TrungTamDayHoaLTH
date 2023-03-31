@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Quản lý tất cả lịch học'])
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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridWeek',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridWeek,dayGridDay' // user can switch between the two
                },
                locale: 'vie',
                events: [
                    @if (Auth::user()->role_id == 1)
                        @foreach ($calendars as $calendar)
                            @foreach ($calendar->classes as $class)
                                <?php $teacher = App\Models\User::join('classes', 'classes.teacher_id', '=', 'users.id')
                                    ->where('classes.id', $class->id)
                                    ->select('users.firstname as firstname', 'users.lastname as lastname')
                                    ->first();
                                $teacher_name = $teacher->firstname . ' ' . $teacher->lastname
                                ?> {
                                    title: "{{ $class->name . ' - GV: ' . $teacher_name }}",
                                    daysOfWeek: [{{ $calendar->day_of_the_week }}],
                                    startTime: "{{ $calendar->start_hour }}",
                                    endTime: "{{ $calendar->end_hour }}",
                                },
                            @endforeach
                        @endforeach
                    @elseif (Auth::user()->role_id == 2)
                        @foreach ($calendars as $calendar)
                            @foreach ($calendar->classes as $class)
                                @if (Auth::user()->id == $class->teacher_id)
                                    {
                                        title: "{{ $class->name }}",
                                        daysOfWeek: [{{ $calendar->day_of_the_week }}],
                                        startTime: "{{ $calendar->start_hour }}",
                                        endTime: "{{ $calendar->end_hour }}",
                                    },
                                @endif
                            @endforeach
                        @endforeach
                    @elseif (Auth::user()->role_id == 3)
                        @foreach ($calendars as $calendar)
                            @foreach ($calendar->classes as $class)
                                @if (App\Models\StudentsInClass::where('class_id', $class->id)->where('student_id', Auth::user()->id)->exists())
                                    {
                                        title: "{{ $class->name }}",
                                        daysOfWeek: [{{ $calendar->day_of_the_week }}],
                                        startTime: "{{ $calendar->start_hour }}",
                                        endTime: "{{ $calendar->end_hour }}",
                                    },
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                ]
            });
            calendar.render();

        });
    </script>
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        @if (Auth::user()->role_id == 1)
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex bd-highlight mb-3">
                            <h6 class="me-auto p-2 bd-highlight">Quản lý lịch học</h6>
                            <a href="{{ route('calendar.create') }}"><button
                                    class="btn btn-primary btn-sm ms-auto button-float" style="margin: 0 20px;"
                                    class="p-2 bd-highlight">Tạo lịch học mới</button></a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex bd-highlight mb-3">
                            <h6 class="me-auto p-2 bd-highlight">Thời khóa biểu</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center">
        {{ $calendars->appends(Request::all())->links() }}
    </div>
@endsection
