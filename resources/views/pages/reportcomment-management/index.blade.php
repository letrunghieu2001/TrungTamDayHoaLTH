@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Bình luận bị báo cáo'])
    <style>
        .overflow {
            word-wrap: break-word;
            display: -webkit-box;
            max-height: 3.2rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 2;
            line-height: 1.6rem;
        }

        .reason {
            word-wrap: break-word;
            line-height: 1.6em;
            display: -webkit-box;
            max-height: 3.2rem;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
    <div class="row mt-4 mx-4">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex bd-highlight mb-3">
                        <h6 class="me-auto p-2 bd-highlight">Bình luận bị báo cáo</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <table class="table align-items-center mb-0">
                                    @if (count($reportComments) > 0)
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    STT</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Người bình luận</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nội dung bình luận</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nội dung báo cáo </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Người báo cáo</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reportComments as $reportComment)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span
                                                            class="text-secondary overflow text-xs font-weight-bold">{{ $reportComments->perPage() * ($reportComments->currentPage() - 1) + $loop->iteration }}</span>
                                                    </td>
                                                    <td>
                                                        @if (optional($reportComment->user_comment)->email != null)
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/avatar/' . optional($reportComment->user_comment)->avatar) }}"
                                                                        class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ optional($reportComment->user_comment)->firstname . ' ' . optional($reportComment->user_comment)->lastname }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ optional($reportComment->user_comment)->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="text-secondary overflow text-xs font-weight-bold">Tài
                                                                khoản đã bị xóa</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0 reason">{!! optional($reportComment->comment)->content !!}</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0 reason">
                                                            {{ $reportComment->reason }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        @if (optional($reportComment->user_created)->email != null)
                                                            <div class="d-flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('storage/avatar/' . optional($reportComment->user_created)->avatar) }}"
                                                                        class="avatar avatar-sm me-3" alt="user1">
                                                                </div>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">
                                                                        {{ optional($reportComment->user_created)->firstname . ' ' . optional($reportComment->user_created)->lastname }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ optional($reportComment->user_created)->email }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="text-secondary overflow text-xs font-weight-bold">Tài
                                                                khoản đã bị xóa</span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle">
                                                        <a style="cursor: pointer" data-bs-toggle="modal"
                                                            data-bs-target="#deletereportCommentModal-{{ $reportComment->id }}"
                                                            class="tt-icon-btn"><i class="fa-solid fa-trash"></i></a>
                                                        <div class="modal fade" id="deletereportCommentModal-{{ $reportComment->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content" style="width:150%">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5 d-flex p-2"
                                                                            id="exampleModalLabel">
                                                                            Xóa bình luận</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Bạn có chắc muốn xóa bình luận này không ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Đóng</button>
                                                                        <form
                                                                            action="{{ route('report-comment.delete', [$reportComment->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <p style="margin-left: 30px">Không có kết quả</p>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $reportComments->appends(Request::all())->links() }}
    </div>
@endsection
