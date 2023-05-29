@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Danh sách ngân hàng</h3>
            <a href="{{ route('bank.create') }}" class="btn btn-success float-right">Thêm mới</a>
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
                    <th>Mã ngân hàng</th>
                    <th>Tên Ngân hàng</th>
                    <th>Tên viết tắt</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banks as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->bank_no}}</td>
                        <td>
                            {{ $item->bank_name }}
                        </td>
                        <td>{{ $item->bank_short_name }}</td>

                        <td style="width: 150px">
                            <a href="{{ route('bank.edit', ['bank' => $item->bank_id]) }}" title="Chỉnh sửa">
                                <button class="btn btn-primary">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>
                            <a onclick="deleteItem(this);" url="{{ route('bank.destroy', ['bank' => $item->bank_id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
