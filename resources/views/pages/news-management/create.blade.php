@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tạo tin tức'])
    <style>
        .custom-profile-pic {
            color: transparent;
            transition: all .3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: all .3s ease;
        }

        .custom-profile-pic input {
            display: none;
        }

        .custom-profile-pic img {
            position: absolute;
            object-fit: cover;
            width: 100px;
            height: 100px;
            box-shadow: 0 0 10px 0 rgba(255, 255, 255, .35);
            border-radius: 100px;
            z-index: 0;
        }

        .custom-profile-pic .avatar-label {
            cursor: pointer;
            height: 100px;
            width: 100px;
        }

        .custom-profile-pic:hover .avatar-label {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, .8);
            z-index: 10000;
            color: rgb(250, 250, 250);
            transition: rgb(25, 24, 21) .2s ease-in-out;
            border-radius: 100px;
            margin: 10px -2px;
        }

        .custom-profile-pic span {
            display: flex;
            padding: .2em;
            height: 2em;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form role="form" method="POST" action={{ route('news.store') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Tạo tin tức mới</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Tạo tin tức</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <hr class="horizontal dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Tiêu đề</label>
                                        <textarea class="form-control" type="text" name="title" rows="2" style="resize: none">{{ old('title') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nội dung</label>
                                        <textarea id="summernoteContent" name="content">{{ old('content') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script type="text/javascript">
            $('#summernoteContent').summernote({
                height: 400
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
