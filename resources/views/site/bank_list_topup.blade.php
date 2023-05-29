@extends('site.master.layout')

@section('content')
    <div class="main-panel">
    @include('site.master.header')

    <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card strpied-tabled-with-hover">
                            <div class="card-header ">
                                <h4 class="card-title">Nội dung thanh toán</h4>
                            </div>
                            <div class="content text-center">
                                <hr>
                                <p>
                                    Để thanh toán giao dịch. Vui lòng chuyển tiền vào tài khoản
                                    <span class="text-danger">{{ $trans->acc_no }} - {{ isset($trans->bankAdmin->acc_name) ? $trans->bankAdmin->acc_name : '' }}</span>
                                    -
                                    {{ isset($trans->bank->bank_name) ? $trans->bank->bank_name : '' }}
                                    ({{ isset($trans->bank->bank_short_name) ? $trans->bank->bank_short_name : '' }}) .

                                </p>
                                <p>
                                    Chuyển khoản với nội dung: <span class="text-danger"> {{ $trans->memo }}</span>
                                </p>
                            </div>
                            <div class="content">
                                <hr>
                                <p style="text-align: left !important;">
                                    <p>Các bước để được cập nhật điểm</p>
                                    <p>1.Thoát ra vào app ngân hàng</p>
                                    <p>2.Chuyển tiền qua số tài khoản trên</p>
                                    <p>3.Nội dung ghi đúng như hiển thị trên web</p>
                                    <p>=> Tài khoản sẽ được cộng điểm trong vòng 1 phút ,khi hệ thống nhận được tiền </p>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
        </footer>
    </div>
    <style>
        .content{
            padding: 5px;
        }
    </style>
@endsection
