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
                    <div class="form-group col-md-4">
                        <label for="reservation">Người phụ trách</label>
                        <div class="input-group">
                            <select class="select form-control" name="agency_id">
                                <option value="">-- Tất cả --</option>
                                @foreach($sales as $sale)
                                    <option value="{{ $sale->id }}" {{ request('agency_id') == $sale->id ? "selected" : ''}}>{{ $sale->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="agency_id">Đại lý</label>
                        <div class="input-group">
                            <select class="select form-control" name="agency_id">
                                <option value="">-- Tất cả --</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ request('agency_id') == $group->id ? "selected" : ''}}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header">
            <h3 class="card-title">Doanh thu tổng </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Tổng gd nạp</th>
                    <th>Số tiền nạp</th>
                    <th>Tổng gd rút</th>
                    <th>Số tiền rút</th>
                    <th>Doanh thu(Nạp - Rút)</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ number_format($totalTopupAll) }}</td>
                        <td>{{ number_format($sumTopupAll) }}</td>
                        <td>{{ number_format($totalWithdrawAll) }}</td>
                        <td>{{ number_format($sumWithdrawAll) }}</td>
                        <td>{{ number_format($revenueAll) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        @if (session('success'))
            <div class="alert alert-success mx-2 mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Doanh thu theo đại lý </h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Tên</th>
                    <th>Nhóm</th>
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
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ isset( $dataNoSale['name']) ?  $dataNoSale['name'] : '' }}</td>
                    <td>{{ isset( $dataNoSale['group']) ?  $dataNoSale['group'] : '' }}</td>
                    <td>{{ isset($dataNoSale['total_topup']) ?  number_format($dataNoSale['total_topup']) : '' }}</td>
                    <td>{{ isset($dataNoSale['sum_topup']) ?   number_format($dataNoSale['sum_topup']) : '' }}</td>
                    <td>{{ isset($dataNoSale['total_withdraw']) ?   number_format($dataNoSale['total_withdraw']) : '' }}</td>
                    <td>{{ isset($dataNoSale['sum_withdraw']) ?   number_format($dataNoSale['sum_withdraw']) : '' }}</td>
                    <td>{{ isset($dataNoSale['revenue']) ?   number_format($dataNoSale['revenue']) : '' }}</td>
                </tr>
                @foreach($revenues as $index => $item)
                <tr>
                    <td>{{ $id += 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ isset($item->group) ? $item->group : '' }}</td>
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
    <script>
        $('#reservation').daterangepicker()
    </script>
    <script>
        $(function () {
            /* jQueryKnob */

            $('.knob').knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a   = this.angle(this.cv)  // Angle
                            ,
                            sa  = this.startAngle          // Previous start angle
                            ,
                            sat = this.startAngle         // Start angle
                            ,
                            ea                            // Previous end angle
                            ,
                            eat = sat + a                 // End angle
                            ,
                            r   = true

                        this.g.lineWidth = this.lineWidth

                        this.o.cursor
                        && (sat = eat - 0.3)
                        && (eat = eat + 0.3)

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value)
                            this.o.cursor
                            && (sa = ea - 0.3)
                            && (ea = ea + 0.3)
                            this.g.beginPath()
                            this.g.strokeStyle = this.previousColor
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                            this.g.stroke()
                        }

                        this.g.beginPath()
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                        this.g.stroke()

                        this.g.lineWidth = 2
                        this.g.beginPath()
                        this.g.strokeStyle = this.o.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                        this.g.stroke()

                        return false
                    }
                }
            })
            /* END JQUERY KNOB */

            //INITIALIZE SPARKLINE CHARTS
            var sparkline1 = new Sparkline($('#sparkline-1')[0], { width: 240, height: 70, lineColor: '#92c1dc', endColor: '#92c1dc' })
            var sparkline2 = new Sparkline($('#sparkline-2')[0], { width: 240, height: 70, lineColor: '#f56954', endColor: '#f56954' })
            var sparkline3 = new Sparkline($('#sparkline-3')[0], { width: 240, height: 70, lineColor: '#3af221', endColor: '#3af221' })

            sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
            sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
            sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

        })

    </script>
@endsection
