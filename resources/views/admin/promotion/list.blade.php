@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Danh sách ngân hàng</h3>
            <a href="{{ route('promotion.create') }}" class="btn btn-success float-right">Thêm mới</a>
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
                    <th>Mã  khuyến mãi</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Phần trăm</th>
                    <th>Ảnh</th>
                    <th>Thời gian bắt đầu</th>
                    <th>Thời gian kết thúc</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->code}}</td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>{{ $item->descripiton }}</td>
                        <td>{{ $item->rate }}</td>
                        <td><img src="{{ $item->image }}" width="100px" alt=""></td>
                        <td>{{ date('d-m-Y', strtotime($item->time_start)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->time_end)) }}</td>

                        <td style="width: 150px">

                            <a onclick="deleteItem(this);" url="{{ route('promotion.destroy', ['promotion' => $item->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $promotions->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
