@extends('layouts.home.app')

@section('title')
    {{ $new->title }}
@endsection

@section('content')
    <section class="probootstrap-section probootstrap-section-colored">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left section-heading probootstrap-animate">
                    <h1>{{ $new->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="probootstrap-section probootstrap-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row probootstrap-gutter0">
                        <div class="col-md-12 probootstrap-animate" id="probootstrap-content">
                            <div style="margin-bottom : 50px">
                                @if (optional($new->user)->email != null)
                                    <div class="d-flex px-2 py-1"
                                        style="display: flex; align-items: center; justify-content: space-between">
                                        <div>
                                            <img src="{{ asset('storage/avatar/' . optional($new->user)->avatar) }}"
                                                class="img-circle" style="width: 50px; height: 50px" alt="user1">
                                            <span class="mb-0 text-sm"
                                                style="margin:auto; margin-left: 20px; font-weight: bold">
                                                {{ optional($new->user)->firstname . ' ' . optional($new->user)->lastname }}
                                            </span>
                                        </div>
                                        <div style="float:right">
                                            <span style="margin-left: 20px">{{ $new->postTime }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex px-2 py-1"
                                        style="display: flex; align-items: center; justify-content: space-between">
                                        <div>
                                            <span class="text-secondary overflow text-xs font-weight-bold"
                                                style="font-weight:bold">Tài
                                                khoản viết bài viết này đã bị xóa</span>
                                        </div>
                                        <div style="float:right">
                                            <span style="margin-left: 20px">{{ $new->postTime }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div>{!! $new->content !!}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    
@endsection
