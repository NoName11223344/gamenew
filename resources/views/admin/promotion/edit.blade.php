@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa ngân hàng</h3>
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
            <form method="post" action="{{ route('bank.update' , ['bank' => $bank->bank_id] )}}">
                @method('PUT')
                @csrf
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="bank_code">Mã BIN ngân hàng</label>
                        <input type="text" id="bank_no" name="bank_no" class="form-control" value="{{ old('bank_no') ?? $bank->bank_no }}">
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="bank_name">Tên ngân hàng</label>
                        <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ old('bank_name') ?? $bank->bank_name }}">
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="form-outline">
                        <label class="form-label" for="bank_short_name">Tên ngắn gọn</label>
                        <input type="text" id="bank_short_name" name="bank_short_name" class="form-control" value="{{ old('bank_short_name') ?? $bank->bank_short_name }}">
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
