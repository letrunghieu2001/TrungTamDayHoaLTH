<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Báo cáo kết quả kinh doanh tháng {{ $date }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        header {
            padding: 31px 0;
            height: auto;
            width: 100%;
        }

        header .vn {
            text-align: center;
        }

        header .title {
            color: #cc0000;
            text-align: center;
            margin-top: 10px;
        }

        .assignment .assignment-place {
            text-align: center;
            bottom: 0;
        }

        .assignment .assignment-place .white-space {
            padding: 50px 0;
        }
    </style>
</head>

<body>
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ asset('img/logos/logo.png') }}">
                </div>
                <div class="col-md-4 vn">
                    <p><b>Cộng hòa xã hội chủ nghĩa Việt Nam</b></p>
                    <p><b>Độc lập - Tự do - Hạnh phúc</b></p>
                </div>
                <div class="col-md-12 title">
                    <h1>Báo cáo kết quả kinh doanh tháng {{ $date }}</h1>
                </div>
            </div>
        </div>
    </header>

    <section class="report-table">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Hạng mục</th>
                                <th scope="col">Số tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <th scope="row" style="font-weight: normal">{{ $payment->content }}</th>
                                    <td>{{ number_format($payment->money) }} VND</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th scope="row">Tổng</th>
                                <td style="font-weight: bold">
                                    {{ number_format(\App\Models\AdminPayment::where('date', $date)->sum('money')) }}
                                    VND</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
    <section class="assignment">
        <div class="container">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4 assignment-place">
                    <p>Hà Nội, ngày {{ now()->day }} tháng {{ now()->month }} năm {{ now()->year }}</p>
                    <p><b>Giám đốc trung tâm</b></p>
                    <div class="white-space"></div>
                    <p>Lê Trung Hiếu</p>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

</html>
