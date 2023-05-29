@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Thông tin chung</h3>
            <a href="{{ route('information.create') }}" class="btn btn-success float-right">Thêm mới</a>
        </div>
        <div class="card-header">

        </div>
        @if (session('success'))
            <div class="alert alert-success mx-2 mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
                <th>Nội dung</th>
                <th width="150px">Thao tác</th>
                </thead>
                <tbody>
                @foreach($informations as $id => $item)
                    <tr>
                        <td>{{ $id + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->content }}</td>

                        <td>
                            <a href="{{ route('information.edit', ['information' => $item->id]) }}" title="Chỉnh sửa">
                                <button class="btn btn-primary">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                            </a>
{{--                            <a onclick="deleteItem(this);" url="{{ route('information.destroy', ['information' => $item->id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $informations->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
@section('js')

@endsection
