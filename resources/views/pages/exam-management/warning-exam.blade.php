@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Lưu ý kiểm tra'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Bạn đang chuẩn bị làm đề thi
                                <b>{{ $exam->name . ' - Số câu hỏi: ' . $exam->number_questions . ' - Thời gian: ' . $exam->time . ' phút ' }}</b>
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <h4 class="text-danger">Một vài lưu ý cơ bản trước khi làm bài thi</h4>
                            <li>Đồng hồ bấm giờ sẽ chạy ngay tại thời điểm bạn bấm nút bắt đầu làm bài
                            </li>
                            <li>Đừng cố gắng gian lận vì mọi hành động đều được lưu trên hệ thống và bài làm sẽ được nộp
                                ngay lập tức (
                                cảnh báo trước )
                            </li>
                            <li>Bạn sẽ chỉ được làm bài thi một và chỉ một lần duy nhất
                            </li>
                            <li>Mọi thắc mắc về bài thi xin hãy để sau, trong quá trình làm bài giám thị coi thi không giải
                                thích gì thêm
                            </li>
                            <li>Sau khi nhấn nộp bài, sẽ có điểm ( trên thang diểm 10 ), và đáp án của từng câu hỏi, hãy
                                liên hệ giáo viên để chữa chi tiết từng câu
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <p class="mb-0">Nếu bạn đã đọc kĩ toàn bộ lưu ý và hứa sẽ tuân thủ theo, vậy goodluck ^^</p>
                        <a href="{{ route('exam.do-exam', [$exam->id, $lesson->id]) }}"><button
                                class="btn btn-primary btn-sm ms-auto button-float"
                                style="margin: 30px; display: flex; align-items:center"
                                class="p-2 bd-highlight">Bắt đầu làm bài</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
@endsection
