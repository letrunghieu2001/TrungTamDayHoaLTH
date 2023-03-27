@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thêm câu hỏi'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">{{ $exam->name }}</p>
                            <div class="btn btn-primary btn-sm ms-auto">Điểm của bạn:
                                {{ $grade->grade }}</div>
                        </div>
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
                                        <label><input type="radio" id='radio-answer-1-{{ $question->id }}' value="1"
                                                disabled @if ($result[$question->id]->answer == '1') checked @endif></label>
                                        <span>{{ $question->answer_1 }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><input type="radio" id='radio-answer-2-{{ $question->id }}' value="2"
                                                disabled @if ($result[$question->id]->answer == '2') checked @endif></label>
                                        <span>{{ $question->answer_2 }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><input type="radio" id='radio-answer-3-{{ $question->id }}' value="3"
                                                disabled @if ($result[$question->id]->answer == '3') checked @endif></label>
                                        <span>{{ $question->answer_3 }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><input type="radio" id='radio-answer-4-{{ $question->id }}' value="4"
                                                disabled @if ($result[$question->id]->answer == '4') checked @endif></label>
                                        <span>{{ $question->answer_4 }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>Đáp án đúng:
                                    </div>
                                    @if ($question->answer_correct == 1)
                                        <div class="btn btn-primary btn-sm ms-auto">
                                            {{ $question->answer_1 }}</div>
                                    @elseif ($question->answer_correct == 2)
                                        <div class="btn btn-primary btn-sm ms-auto">
                                            {{ $question->answer_2 }}</div>
                                    @elseif ($question->answer_correct == 3)
                                        <div class="btn btn-primary btn-sm ms-auto">
                                            {{ $question->answer_3 }}</div>
                                    @elseif ($question->answer_correct == 4)
                                        <div class="btn btn-primary btn-sm ms-auto">
                                            {{ $question->answer_4 }}</div>
                                    @endif
                                </div>
                            </div>
                            <hr class="horizontal dark">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @include('layouts.footers.auth.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
@endsection
