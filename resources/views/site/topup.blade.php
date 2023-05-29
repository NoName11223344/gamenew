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
                                <h4 class="card-title">Nạp tiền</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('post_topup') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Chọn ngân hàng </label>
                                                <select class="select form-control select2" name="acc_no">
                                                    <option value="">Tất cả</option>
                                                    @foreach($banks as $bank)
                                                        <option
                                                            value="{{ $bank->acc_no }}" {{ isset($bankUser->acc_no) && old('acc_no') == $bank->acc_no ? "selected" : ''}}>
                                                            {{ $bank->bank->bank_name }} ({{ $bank->bank->bank_short_name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('acc_no')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số tiền</label>
                                                <input type="number" class="form-control" name="amount"
                                                       placeholder="Ghi đầy đủ số 0"
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
                                                <label for="memo">Nội dung chuyển tiền</label>
                                                <input type="text" class="form-control" name="memo"
                                                       placeholder="Ghi tên đăng nhập"
                                                       value="{{ old('memo') }}">
                                                @error('memo')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mã khuyến mãi</label>
                                                <input type="text" class="form-control" name="promotion_code"
                                                       placeholder="Mã khuyến mãi"
                                                       value="{{ old('promotion_code') }}">
                                                @error('amount')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-danger">
                                                Mức quy đổi:
                                                @switch($user->rate)
                                                    @case(1)
                                                    1đ = 25.000đ
                                                    @break
                                                    @case(2)
                                                    1đ = 50.000đ
                                                    @break
                                                    @case(3)
                                                    1đ = 100.000đ
                                                    @break
                                                @endswitch
                                            </p>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Nạp tiền</button>
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
