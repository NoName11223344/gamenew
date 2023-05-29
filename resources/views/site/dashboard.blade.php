@extends('site.master.layout')

@section('content')
    <style>
        .card-item {
            height: 200px;
            background: #3a0a0278;
            color: #fff;
            box-shadow: #f1a6a669 0px 5px 15px;
            /*box-shadow: rgb(237 229 229 / 35%) 0px 5px 15px;*/
        }
        .card-item i{
            font-size: 80px;
        }

        .card-body{
            text-align: center;
        }
        .card-body h4{
            font-weight: bold;
        }
    </style>
    <div class="main-panel">
        @include('site.master.header')
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{!! isset($information['link-choi-game']) ? $information['link-choi-game'] : '' !!}">
                            <div class="card card-item" style="background: url('assset/img/img.jpg') no-repeat center; background-size: cover">
                                <div class="card-body">
                                    <i class="fa fa-play-circle"></i>
                                    <h4>Vào chơi</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('topup') }}">
                            <div class="card card-item">
                                <div class="card-body">
                                    <i class="fa fa-money"></i>
                                    <h4>Nạp tiền</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('withdraw') }}">
                            <div class="card card-item">
                                <div class="card-body">
                                    <i class="fa fa-credit-card"></i>
                                    <h4>Rút tiền</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('bank_user') }}">
                            <div class="card card-item">
                                <div class="card-body">
                                    <i class="fa fa-university"></i>
                                    <h4>Quản lý thẻ ngân hàng</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('promotion') }}">
                            <div class="card card-item">
                                <div class="card-body">
                                    <i class="fa fa-address-book"></i>
                                    <h4>Khuyến mãi</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('transactions') }}">
                            <div class="card card-item">
                                <div class="card-body">
                                    <i class="fa fa-bars"></i>
                                    <h4>Lịch sử giao dịch</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
