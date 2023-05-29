@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa nhóm</h3>
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
            <form method="post" action="{{ route('group.update', ['group' => $group->id ]) }}">
                @method('PUT')
                @csrf
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="name">Tên đại lý</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $group->name }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <input class="btn btn-primary" type="submit" value="Lưu">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
