@extends('site.master.layout')

@section('content')
    <div class="main-panel">
    @include('site.master.header')

    <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thay đổi thông tin</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('update_user') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên đăng nhập</label>
                                                <input type="text" class="form-control" disabled placeholder=""
                                                       value="{{ $user->user_name }}">
                                                @error('user_name')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Họ Tên</label>
                                                <input type="text" class="form-control" name="name" placeholder="Họ tên"
                                                       value="{{ $user->name }}">
                                                @error('name')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số điện thoại</label>
                                                <input type="text" class="form-control" name="phone" placeholder="phone"
                                                       value="{{ $user->phone }}">
                                                @error('phone')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mức quy đổi </label>
                                                <select class="select form-control select2" name="rate">
                                                    <option value="1" {{ $user->rate == 1 ? 'selected' :'' }}>1đ = 25.000đ</option>
                                                    <option value="2" {{ $user->rate == 2 ? 'selected' :'' }}>1đ = 50.000đ</option>
                                                    <option value="3" {{ $user->rate == 3 ? 'selected' :'' }}>1đ = 100.000đ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật thông tin</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin tài khoản thanh toán</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('update_bank_account') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tên tài khoản</label>
                                                <input type="text" class="form-control" name="acc_name" placeholder="Tên tài khoản"
                                                       value="{{ isset($bankUser->acc_name) ? $bankUser->acc_name : '' }}">
                                                @error('acc_name')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số tài khoản</label>
                                                <input type="text" class="form-control" name="acc_no" placeholder="Số tài khoản"
                                                       value="{{ isset($bankUser->acc_no) ? $bankUser->acc_no : '' }}">
                                                @error('acc_no')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> Chọn ngân hàng </label>
                                                <select class="select form-control select2" name="bank_no">
                                                    <option value="">Tất cả</option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{ $bank->bank_no }}" {{ isset($bankUser->bank_no) && $bankUser->bank_no == $bank->bank_no ? "selected" : ''}}>
                                                            {{ $bank->bank_name }} ({{ $bank->bank_short_name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('bank_no')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật thông tin</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
