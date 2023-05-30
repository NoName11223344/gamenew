@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa đại lý</h3>
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
                        <label class="form-label" for="group_name">Tên đại lý</label>
                        <input type="text" id="group_name" name="group_name" class="form-control" value="{{ old('group_name') ?? $group->group_name }}">
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
