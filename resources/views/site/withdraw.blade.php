@extends('site.master.layout')

@section('content')
    <div class="main-panel">
    @include('site.master.header')

    <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rút tiền</h4>
                            </div>
                            <div class="card-body">
                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                      <p>{!! \Session::get('success') !!}</p>
                                    </div>
                                @endif
                                <form method="post" action="{{ route('post_withdraw') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số tài khoản</label>
                                                <input type="text" class="form-control" disabled placeholder="Số tài khoản"
                                                       value="{{ isset($bankUser->acc_no) ? $bankUser->acc_no : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ngân hàng</label>
                                                <input type="text" class="form-control" disabled placeholder=""
                                                       value="{{ isset($bankUser->bank->bank_name) ? $bankUser->bank->bank_name : '' }} ({{ isset($bankUser->bank->bank_short_name) ? $bankUser->bank->bank_short_name : '' }})">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số tiền</label>
                                                <input type="number" class="form-control" name="amount" placeholder="Số tiền rút"
                                                       value="{{ old('amount') }}">
                                                @error('amount')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mã khuyến mãi</label>
                                                <input type="text" class="form-control" name="promotion_code" placeholder="Mã khuyến mãi"
                                                       value="{{ old('promotion_code') }}">
                                                @error('amount')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info btn-fill">Rút tiền</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>Hướng dẫn</h3>
                            </div>
                            <div class="card-body">
                                <p>1. Thời gian nạp tiền từ 09:00 - 22:00 hàng ngày</p>

                                <p>2. Nạp rút thấp nhất 20đ cho 1 lần nạp</p>
                                <ul>
                                    <li> Mức đô 25 = 500.000</li>
                                    <li> Mức đô 50 = 1.000.000</li>
                                    <li> Mức đô 100 = 2.000.000</li>
                                </ul>

                                <p>3. Tiền khi nạp sẽ được cập nhật trong vòng 1 phút ,nếu ghi đúng nội dung</p>

                                <p>4. Rút tiền về tài khoản ATM từ 3-5 phút</p>

                                <p>5. Mọi thắc mắc liên hệ :</p>
                                <ul>
                                    <li> Livechat</li>
                                    <li> Hotline : <a href="0393833327"></a>03938.333.27</li>
                                    <li> Telegram : @cskhalowin247</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
