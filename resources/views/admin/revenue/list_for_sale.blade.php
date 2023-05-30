@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Doanh thu</h3>
        </div>
        <div class="card-header">
            <form action="{{ route('revenue') }}" method="get">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="reservation">Thời gian giao dịch</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" name="time_range" id="reservation" value="{{ request('time_range') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-header">
            <h3 class="card-title">Doanh thu theo sale </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Tên</th>
                    <th>Đại lý</th>
                    <th>Tổng gd nạp</th>
                    <th>Số tiền nạp</th>
                    <th>Tổng gd rút</th>
                    <th>Số tiền rút</th>
                    <th>Doanh thu(Nạp - Rút)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $id = 0;
                ?>
                @foreach($revenues as $index => $item)
                <tr>
                    <td>{{ $id += 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ isset($item->group) ? $item->group : 'Không phân đại lý' }}</td>
                    <td>{{ number_format($item->total_topup) }}</td>
                    <td>{{ number_format($item->sum_topup) }}</td>
                    <td>{{ number_format($item->total_withdraw) }}</td>
                    <td>{{ number_format($item->sum_withdraw) }}</td>
                    <td>{{ number_format($item->revenue) }}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')

@endsection
