@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Danh sách đại lý</h3>
            <a href="{{ route('group.create') }}" class="btn btn-success float-right">Thêm mới</a>
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
                    <th>Tên đại lý</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->group_name}}</td>
                        <td style="width: 150px">
                            <a href="{{ route('group.edit', ['group' => $item->id]) }}" title="Chỉnh sửa">
                                <button class="btn btn-primary">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>
                            <a onclick="deleteItem(this);" url="{{ route('group.destroy', ['group' => $item->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
