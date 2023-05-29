@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Danh sách ngân hàng </h3>
            <a href="{{ route('bank-admin.create') }}" class="btn btn-success float-right">Thêm mới</a>
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
                    <th>Tên</th>
                    <th>Ngân hàng</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bankAdmins as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $item->acc_no }}</td>
                    <td>{{ $item->acc_name }}</td>
                    <td>
                        {{ isset($item->bank->bank_name) ? $item->bank->bank_name : '' }}({{ isset($item->bank->bank_short_name) ? $item->bank->bank_short_name : '' }})
                    </td>
                    <td style="width: 150px">
                        <a href="{{ route('bank-admin.edit', ['bank_admin' => $item->id]) }}" title="Chỉnh sửa">
                            <button class="btn btn-primary">
                                <i class="fa fa-pencil-alt"></i>
                            </button>
                        </a>
                        <a onclick="deleteItem(this);" url="{{ route('bank-admin.destroy', ['bank_admin' => $item->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $bankAdmins->appends(request()->query())->links() }}
    </div>
@endsection
