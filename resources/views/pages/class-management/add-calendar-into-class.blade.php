@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thêm lịch học'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Thêm lịch học cho lớp học</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Lịch học:</label>
                                    <form role="form" method="POST"
                                        action={{ route('class.store-calendar', [$class->id]) }}
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body px-0 pt-0 pb-2">
                                            <div class="table-responsive p-0">
                                                <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                                                    <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                                        aria-labelledby="nav-home-tab">
                                                        <table class="table align-items-center mb-0">
                                                            @if (count($calendars) > 0)
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-secondary opacity-7"></th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            STT</th>
                                                                        <th
                                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                                            Thời gian</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($calendars as $calendar)
                                                                        <tr>
                                                                            <td class="align-middle">
                                                                                <label><input type="checkbox"
                                                                                        id='checkbox-{{ $calendar->id }}'
                                                                                        name="class_calendar_id[]"
                                                                                        value="{{ $calendar->id }}"
                                                                                        <?php if (
                                                                                            App\Models\CalendarsInClass::where('calendar_id', $calendar->id)
                                                                                                ->where('class_id', $class->id)
                                                                                                ->first() != null
                                                                                        ) {
                                                                                            echo 'checked';
                                                                                        } ?>></label>
                                                                            </td>
                                                                            <td class="align-middle">
                                                                                <span
                                                                                    class="text-secondary overflow text-xs font-weight-bold">{{ $calendars->perPage() * ($calendars->currentPage() - 1) + $loop->iteration }}</span>
                                                                            </td>
                                                                            <td class="align-middle">
                                                                                @if (optional($calendar)->day_of_the_week == 0)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Chủ Nhật' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 1)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ hai' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 2)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ ba' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 3)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ tư' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 4)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ năm' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 5)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ sáu' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
                                                                                @endif
                                                                                @if (optional($calendar)->day_of_the_week == 6)
                                                                                    <span
                                                                                        class="text-secondary overflow text-xs font-weight-bold">{{ 'Thứ bảy' . ' ' . $calendar->start_hour . ' - ' . $calendar->end_hour }}</span>
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
                                                    style="margin: 20px 0; float: right">Thêm lịch học</button>
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
