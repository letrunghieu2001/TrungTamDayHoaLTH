@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Thêm câu hỏi'])
    <div id="alert">
        @include('components.alert')
    </div>
    <form role="form" method="POST" action={{ route('exam.store-question', [$exam->id]) }}>
        @csrf
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $exam->name }}</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Lưu thay đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($questions) == 0)
            @for ($i = 1; $i <= $exam->number_questions; $i++)
                <div class="container-fluid py-4" id="question-button">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Câu hỏi số
                                                    {{ $i }}</label>
                                                <textarea class="form-control" type="text" name="question{{ $i }}" rows="2" style="resize: none"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Đáp án 1</label>
                                                <input class="form-control" type="text"
                                                    name="answer_1{{ $i }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Đáp án 2</label>
                                                <input class="form-control" type="text"
                                                    name="answer_2{{ $i }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Đáp án 3</label>
                                                <input class="form-control" type="text"
                                                    name="answer_3{{ $i }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Đáp án 4</label>
                                                <input class="form-control" type="text"
                                                    name="answer_4{{ $i }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Đáp án
                                                    đúng</label>
                                                <select name="answer_correct{{ $i }}" class="form-select"
                                                    required>
                                                    <option class="not-select" value="" disabled selected>
                                                        -- Chọn --</option>
                                                    <option value="1">
                                                        Đáp án 1</option>
                                                    <option value="2">
                                                        Đáp án 2</option>
                                                    <option value="3">
                                                        Đáp án 3</option>
                                                    <option value="4">
                                                        Đáp án 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        @else
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
                                                    <label for="example-text-input" class="form-control-label">Câu hỏi số {{ $loop->iteration }}
                                                    </label>
                                                    <textarea class="form-control" type="text" name="question{{ $question->id }}" rows="2" style="resize: none"
                                                        value="{{ $question->question ?? '' }}" required>{{ $question->question ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Đáp án
                                                        1</label>
                                                    <input class="form-control" type="text"
                                                        name="answer_1{{ $question->id }}"
                                                        value="{{ $question->answer_1 ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Đáp án
                                                        2</label>
                                                    <input class="form-control" type="text"
                                                        name="answer_2{{ $question->id }}"
                                                        value="{{ $question->answer_2 ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Đáp án
                                                        3</label>
                                                    <input class="form-control" type="text"
                                                        name="answer_3{{ $question->id }}"
                                                        value="{{ $question->answer_3 ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Đáp án
                                                        4</label>
                                                    <input class="form-control" type="text"
                                                        name="answer_4{{ $question->id }}"
                                                        value="{{ $question->answer_4 ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Đáp án
                                                        đúng</label>
                                                    <select name="answer_correct{{ $question->id }}" class="form-select"
                                                        value="{{ $question->answer_correct ?? '' }}" required>
                                                        <option class="not-select" value="" disabled selected>
                                                            -- Chọn --</option>
                                                        <option value="1"
                                                            @if ($question->answer_correct != null) @if ($question->answer_correct == '1') selected @endif
                                                            @endif>
                                                            Đáp án 1</option>
                                                        <option value="2"
                                                            @if ($question->answer_correct != null) @if ($question->answer_correct == '2') selected @endif
                                                            @endif>
                                                            Đáp án 2</option>
                                                        <option value="3"
                                                            @if ($question->answer_correct != null) @if ($question->answer_correct == '3') selected @endif
                                                            @endif>
                                                            Đáp án 3</option>
                                                        <option value="4"
                                                            @if ($question->answer_correct != null) @if ($question->answer_correct == '4') selected @endif
                                                            @endif>
                                                            Đáp án 4</option>
                                                    </select>
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
        @endif
    </form>
    @include('layouts.footers.auth.footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
@endsection
