@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Nộp tiền học'])
    <style>
        .title-payment {
            text-align: center;
        }

        .payment-img {
            width: 100%;
            height: auto;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12" style="margin-bottom: 30px">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <h3 class="mb-0 title-payment text-danger">Một vài lưu ý khi nộp tiền</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <ul class="mb-0">
                            <li><b>Vui lòng nộp tiền theo cú pháp:</b> Tên học sinh: ....... - Mã học sinh: ....... - Nộp
                                học phí tháng: ..../....
                                <p><b>Ví dụ:</b> Tên học sinh: Lê Trung Hiếu - Mã học sinh: 11191941 - Nộp học phí tháng:
                                    04/2023
                            </li>
                            <li><b>Trung tâm chỉ nhận chuyển khoản nhanh, không nhận chuyển khoản chậm</b></li>
                            <li>Vui lòng nộp tiền học phí đúng hạn, muộn nhất là trong vòng 10 ngày kể từ khi sang tháng
                                mới, tránh nộp muộn, không thì tài khoản của học sinh sẽ bị khóa tạm thời
                            </li>
                            <li>Vui lòng nộp đúng số tiền học phí trong tháng đó, tránh nộp thừa hoặc thiếu
                            </li>
                            <li>Trong vòng 24h kể từ khi thanh toán, nếu học phí của học sinh vẫn chưa chuyển thành đã đóng,
                                hoặc có bất kì vấn đề gì liên quan đến học phí, vui lòng liên hệ qua số điện thoại hoặc
                                zalo: 0942225766 - hoặc email: letrunghieu2001@gmail.com
                            </li>
                            <li>Nếu sau khi chuyển tiền gửi trực tiếp hình ảnh bill thanh toán qua zalo trên thì học phí sẽ
                                được cập nhật nhanh hơn
                            </li>
                            <li>Hiện tại, trung tâm chỉ nhận thanh toán qua 2 phương thức dưới, nếu quý phụ huynh/học sinh
                                muốn thanh toán bằng hình thức khác, vui lòng liên hệ qua zalo trên để được hỗ trợ nhanh
                                nhất
                            </li>
                            <li>Nếu quý phụ huynh nộp thừa hoặc thiếu, vui lòng để ý điện thoại để trung tâm có thể liên lạc
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <h3 class="mb-0 title-payment">Thanh toán bằng thẻ ngân hàng</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <img class="payment-img" src="{{ asset('/img/payment/vib.jpg') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <h3 class="mb-0 title-payment">Thanh toán bằng momo</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <img class="payment-img" src="{{ asset('/img/payment/momo.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
