@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Thông tin ngân hàng người dùng</h3>
            <a href="{{ route('bank-user.create') }}" class="btn btn-success float-right">Thêm mới</a>
        </div>
        <div class="card-header">
            <form action="{{ route('bank-user.index') }}" method="get">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="type">Tài khoản</label>
                        <select class="select form-control select2" name="user_id">
                            <option value="">-- Tất cả --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? "selected" : ''}}>{{ $user->user_name }} ({{ $user->name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>

    @if (session('success'))
            <div class="alert alert-success mx-2 mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Số tài khoản</th>
                    <th>User Name</th>
                    <th>Ngân hàng</th>
                    <th>Tên tài khoản</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bankUsers as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $item->acc_no }}
                    </td>
                    <td>{{ isset($item->user->user_name) ? $item->user->user_name : '' }}</td>
                    <td>{{ isset($item->bank->bank_short_name) ? $item->bank->bank_short_name : '' }}</td>
                    <td>
                        {{ $item->acc_name }}
                    </td>
                    <td style="width: 150px">
                        <a href="{{ route('bank-user.edit', ['bank_user' => $item->id]) }}" title="Chỉnh sửa">
                            <button class="btn btn-primary">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </a>
                        <a onclick="deleteItem(this);" url="{{ route('bank-user.destroy', ['bank_user' => $item->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $bankUsers->appends(request()->query())->links() }}
    </div>
@endsection
