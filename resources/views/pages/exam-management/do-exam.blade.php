@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Đề thi'])
    <style>
        .scroll {
            position: fixed;
            height: auto;
            background-color: rgba(255, 255, 255, 0.65);
            box-shadow: 0 1px 14px rgba(0, 0, 0, 0.25);
            width: 50%;
            left: 55%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
    </style>
    <div id="alert">
        @include('components.alert')
    </div>
    <form role="form" method="POST" id="exam-form"
        action={{ route('grade.store-grade', [$exam->id, Auth::user()->id, $lesson->id]) }}>
        @csrf
        <div class="scroll">
            <div class="container-fluid py-4" id="question-button">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center ">
                            <p class="mb-0">{{ $exam->name }}</p>
                            <label class="mb-0" style="margin-left: 50px">Thời gian còn lại:</label>
                            <div id="countdown-timer"></div>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto" id="submit"
                                onclick="localStorage.removeItem('countdownEndTime');">Nộp
                                bài</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($questions as $question)
            <div class="container-fluid py-4" id="question-button">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <input class="form-control" type="text" name="id[{{ $question->id }}]"
                                    value="{{ $question->id }}" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Câu hỏi số
                                                {{ $loop->iteration }}
                                            </label>
                                            <p>{{ $question->question }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><input type="radio" id='radio-answer-1-{{ $question->id }}'
                                                    name="answer{{ $question->id }}" value="1"></label>
                                            <span>{{ $question->answer_1 }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><input type="radio" id='radio-answer-2-{{ $question->id }}'
                                                    name="answer{{ $question->id }}" value="2"></label>
                                            <span>{{ $question->answer_2 }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><input type="radio" id='radio-answer-3-{{ $question->id }}'
                                                    name="answer{{ $question->id }}" value="3"></label>
                                            <span>{{ $question->answer_3 }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><input type="radio" id='radio-answer-4-{{ $question->id }}'
                                                    name="answer{{ $question->id }}" value="4"></label>
                                            <span>{{ $question->answer_4 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </form>
    @include('layouts.footers.auth.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        function countdown(minutes) {
            let endTime = localStorage.getItem('countdownEndTime');
            if (!endTime) {
                endTime = new Date();
                endTime.setMinutes(endTime.getMinutes() + minutes);
                localStorage.setItem('countdownEndTime', endTime.getTime());
            } else {
                endTime = new Date(parseInt(endTime));
            }

            const timer = setInterval(function() {
                const currentTime = new Date().getTime();
                const distance = endTime - currentTime;
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('countdown-timer').innerHTML =
                    minutes + 'm ' + seconds + 's';

                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById('countdown-timer').innerHTML = 'Hết giờ';
                    document.getElementById('submit').click();
                    localStorage.removeItem('countdownEndTime');
                }
            }, 1000);
        }

        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                submitForm();
            }
        });

        function submitForm() {
            document.getElementById('submit').click();
        }

        countdown({{ $exam->time }});
    </script>
@endsection
