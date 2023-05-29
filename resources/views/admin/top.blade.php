@extends('admin.master.layout')
@section('content')
    <div class="card  p-3">
        <div class="row">
            <div class="col-md-4 text-center">
                <label style=""><a href="{{ route('user.index') }}">Tài khoản chưa kích hoạt</a> <span
                        class="badge badge-danger">{{ $userNeedActive }}</span></label>
            </div>
            <div class="col-md-4 text-center">
                <label style="display: inline-block"><a href="{{ route('transaction_topup') }}">Duyệt nạp</a> <span
                        class="badge badge-danger">{{ $transTopupNeedActive }}</span></label>
            </div>
            <div class="col-md-4 text-center">
                <label style="display: inline-block"><a href="{{ route('transaction_withdraw') }}">Duyệt rút</a> <span
                        class="badge badge-danger">{{ $transWithdrawNeedActive }}</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Thống kê tài khoản</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartUser"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Thống kê giao dịch</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartTransaction"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 col-md-6 text-center">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalUser }}</h3>
                                <p>Tổng số người dùng</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">Chi tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 text-center">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $countUserToday }}</h3>
                                <p>Số người đăng ký trong ngày</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">Chi tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var userNeedActive = "{{$userNeedActive}}"
        var userActive = "{{$userActive}}"
        var donutChartCanvas = $('#chartUser').get(0).getContext('2d')
        var chartUser = {
            labels: [
                'Đã kích hoạt',
                'Chưa kích hoạt',
            ],
            datasets: [
                {
                    data: [
                        userActive,
                        userNeedActive
                    ],
                    backgroundColor: [
                        '#00a65a',
                        '#f56954',
                    ],
                }
            ]
        }
        var donutUserOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: chartUser,
            options: donutUserOptions
        })

    </script>

    <script>
        //- DONUT CHART -
        //-------------

        var transactionNeedConfirm = '{{ $transactionNeedConfirm }}';
        var transactionConfirm = '{{ $transactionConfirm }}';
        var transactionDeposit = '{{ $transactionDeposit }}';
        var transactionWithdraw = '{{ $transactionWithdraw }}';

        var donutTransactionChartCanvas = $('#chartTransaction').get(0).getContext('2d')
        var chartTransaction = {
            labels: [
                'Giao dịch cần duyệt',
                'Giao dịch đã duyệt',
                'Giao dịch nạp tiền',
                'Giao dịch rút tiền',
            ],
            datasets: [
                {
                    data: [
                        transactionNeedConfirm,
                        transactionConfirm,
                        transactionDeposit,
                        transactionWithdraw,
                    ],
                    backgroundColor: [
                        '#f56954',
                        '#d6df51',
                        '#2c8fb5',
                        '#10a65a',
                    ],
                }
            ]
        }
        var donutTransactionOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutTransactionChartCanvas, {
            type: 'doughnut',
            data: chartTransaction,
            options: donutTransactionOptions
        })

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

                        var a = this.angle(this.cv)  // Angle
                            ,
                            sa = this.startAngle          // Previous start angle
                            ,
                            sat = this.startAngle         // Start angle
                            ,
                            ea                            // Previous end angle
                            ,
                            eat = sat + a                 // End angle
                            ,
                            r = true

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
            var sparkline1 = new Sparkline($('#sparkline-1')[0], {
                width: 240,
                height: 70,
                lineColor: '#92c1dc',
                endColor: '#92c1dc'
            })
            var sparkline2 = new Sparkline($('#sparkline-2')[0], {
                width: 240,
                height: 70,
                lineColor: '#f56954',
                endColor: '#f56954'
            })
            var sparkline3 = new Sparkline($('#sparkline-3')[0], {
                width: 240,
                height: 70,
                lineColor: '#3af221',
                endColor: '#3af221'
            })

            sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
            sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
            sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

        })

    </script>
@endsection
