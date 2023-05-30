@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa thông tin : {{ $user->email }}</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="post" action="{{ route('user.update', ['user' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="userName">Tên đăng nhập</label>
                            <input type="text" id="userName" class="form-control" name="user_name" value="{{  $user->user_name }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input type="text" id="password" name="password" class="form-control" value="{{ old('password') ?? \Illuminate\Support\Facades\Crypt::decrypt($user->password)}}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="name">Họ tên</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ??  $user->name }}">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') ??  $user->phone }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="rate">Mức quy đổi </label>
                            <select class="form-control" name="rate">
                                <option value="1" {{ old('rate') ?? $user->rate == 1 ? "selected" : ''}}>1đ = 25.000đ</option>
                                <option value="2" {{ old('rate') ?? $user->rate  == 2 ? "selected" : ''}}>1đ = 50.000đ</option>
                                <option value="3" {{ old('rate') ?? $user->rate  == 3 ? "selected" : ''}}>1đ = 100.000đ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="role">Vai trò</label>
                            <select class="select form-control" name="role">
                                <option value="0" {{ old('role') ?? $user->role == 0 ? "selected='true'" : '' }}>Người dùng</option>
                                <option value="1" {{ old('role') ?? $user->role == 1 ? "selected='true'" : '' }}>Admin</option>
                                <option value="2" {{ old('role') ?? $user->role == 2 ? "selected='true'" : '' }}>Sale</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="sale_id">Sale</label>
                            <select class="select form-control" name="sale_id">
                                <option value="">-- Chọn sale phụ trách --</option>
                                @foreach($sales as $sale)
                                    <option value="{{ $sale->id }}" {{ old('sale_id') ?? $user->sale_id == $sale->id ? "selected" : ''}}>{{ $sale->name }} - {{ isset($sale->group->group_name) ?  $sale->group->group_name : 'Sale Chưa có đại lý' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="group_id">Đại lý</label>
                            <select class="select form-control" name="group_id">
                                <option value="">-- Chọn đại lý --</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ old('group_id') ?? $user->group_id == $group->id ? "selected" : ''}}>{{ $group->group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input class="btn btn-primary" type="submit" value="Đăng ký">
                    </div>

                </form>

        </div>
    </div>
@endsection

@section('js')

@endsection
