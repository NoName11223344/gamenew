@extends('site.master.layout')

@section('content')
    <div class="main-panel">
    @include('site.master.header')

    <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card strpied-tabled-with-hover">
                            <div class="card-header ">
                                <h4 class="card-title">Lịch sử nạp rút</h4>
                            </div>
                            <div class="card-body table-full-width table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>STT</th>
                                    <th>Mã giao dịch</th>
                                    <th>Số tiền</th>
                                    <th>Mã khuyến mãi</th>
                                    <th>Loại giao dịch</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian yêu cầu</th>
                                    <th>Thời gian duyệt</th>
                                    <th>Note</th>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $id => $item)
                                    <tr>
                                        <td>{{ $id + 1 }}</td>
                                        <td>{{ $item->trans_id }}</td>
                                        <td>{{ number_format($item->amount) }}</td>
                                        <td>{{ $item->promotion_code }}</td>
                                        <td>
                                            @switch($item->type)
                                                @case(0)
                                                <span class="badge badge-primary">Nạp tiền</span>
                                                @break;
                                                @case(1)
                                                <span class="badge badge-info">Rút tiền</span>
                                                @break;
                                            @endswitch
                                        </td>
                                        <td>
                                            @switch($item->status)
                                                @case(0)
                                                <span class="badge badge-warning">Chờ duyệt</span>
                                                @break;
                                                @case(1)
                                                <span class="badge badge-success">Đã duyệt</span>
                                                @break;
                                                @case(2)
                                                <span class="badge badge-danger">Đã hủy</span>
                                                @break;
                                            @endswitch
                                        </td>
                                        <td>
                                            {{ $item->note }}
                                        </td>
                                        <td>{{ isset($item->request_time) ? date('d-m-Y H:i', strtotime($item->request_time)) : ''  }}</td>
                                        <td>{{ isset($item->update_end_status_at) ? date('d-m-Y H:i', strtotime($item->update_end_status_at)) : ''  }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $transactions->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
        </footer>
    </div>

@endsection
