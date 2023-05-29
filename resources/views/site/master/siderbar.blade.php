<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">

        <div class="logo">
            <a href="/" class="simple-text">
                <img src="{{ asset('assset/img/logo1.png') }}" width="150px" alt="">
            </a>
            <ul class="nav" style="padding: 0px 15px">
                <li>
                    Tên đăng nhập : <b>{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</b>
                </li>
                <li>
                    <label>Họ Tên :  <b>{{ \Illuminate\Support\Facades\Auth::user()->name }}</b></label>
                </li>
                <li>
                    <label>
                        Mức quy đổi:
                        <b>
                            @switch(\Illuminate\Support\Facades\Auth::user()->rate)
                                @case(1)
                                1đ = 25.000đ
                                @break;
                                @case(2)
                                1đ = 50.000đ
                                @break;
                                @case(3)
                                1đ = 100.000đ
                                @break;
                            @endswitch
                        </b>
                    </label>
                </li>
            </ul>
        </div>

        <div class="logo">
            <a href="#" class="simple-text">
                Quản lý chung
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item {{  url()->current() == route('users') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Trang chủ</p>
                </a>
            </li>
            <li class="nav-item {{  url()->current() == route('transactions') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('transactions') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Lịch sử nạp rút</p>
                </a>
            </li>
            <li class="nav-item {{  url()->current() == route('topup') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('topup') }}">
                    <i class="nc-icon nc-cloud-upload-94"></i>
                    <p>Nạp tiền</p>
                </a>
            </li>
            <li class="nav-item {{  url()->current() == route('withdraw') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('withdraw') }}">
                    <i class="nc-icon nc-cloud-download-93"></i>
                    <p>Rút tiền</p>
                </a>
            </li>
            <li class="nav-item {{  url()->current() == route('bank_user') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('bank_user') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Tài khoản Ngân hàng</p>
                </a>
            </li>
            <li class="nav-item {{  url()->current() == route('promotion') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('promotion') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Khuyến mãi</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{!! isset($information['link-choi-game']) ? $information['link-choi-game'] : '' !!}">
                    <i class="nc-icon nc-controller-modern"></i>
                    <p>Vào chơi</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="nc-icon nc-tap-01"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    .nav-mobile-menu{
        display: none !important;
    }
</style>
