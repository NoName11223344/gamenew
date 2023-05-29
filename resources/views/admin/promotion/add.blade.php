@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Danh sách khuyến mãi</h3>
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
                <form method="post" action="{{ route('promotion.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="code">Mã khuyến mãi</label>
                                <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="name">Tên khuyến mãi</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="descripiton">Nội dung mô tả</label>
                                <textarea id="descripiton" name="descripiton" class="form-control">{{ old('descripiton') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="image">Ảnh</label>
                                <input type="file" id="image" name="image" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="rate">Phần trăm khuyến mãi</label>
                                <input type="text" id="rate" name="rate" class="form-control" value="{{ old('rate') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="time_start">Thời gian bắt đầu</label>
                                <input type="date" id="time_start" name="time_start" class="form-control" value="{{ old('time_start') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-outline">
                                <label class="form-label" for="time_end">Thời gian kết thúc</label>
                                <input type="date" id="time_end" name="time_end" class="form-control" value="{{ old('time_end') }}">
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
