<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">
         CMS Quản lý
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(\Illuminate\Support\Facades\Auth::user()->role == 1)

                    <li class="nav-item">
                        <a href="{{ route('statistical') }}"
                           class="nav-link {{ Request::is('admin') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Tổng hợp
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('user.index') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Danh sách nguời dùng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('group.index') }}"
                           class="nav-link {{ Request::is('group') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Đại lý
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction.index') }}"
                       class="nav-link {{ Request::is('transaction') ? '' : '' }} ">
                        <i class=" fa fa-list"></i>
                        <p>
                            Danh sách giao dịch
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction_topup') }}" class="nav-link {{ Request::is('topup') ? '' : '' }} ">
                        <i class=" fa fa-list"></i>
                        <p>
                            Lệnh nạp
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction_withdraw') }}"
                       class="nav-link {{ Request::is('withdraw') ? '' : '' }} ">
                        <i class=" fa fa-list"></i>
                        <p>
                            Lệnh rút
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('transaction_pending') }}"
                       class="nav-link {{ Request::is('pending') ? '' : '' }} ">
                        <i class=" fa fa-list"></i>
                        <p>
                            Chờ duyệt
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('revenue') }}" class="nav-link {{ Request::is('revenue') ? '' : '' }} ">
                        <i class="fa fa-university"></i>
                        <p>
                            Doanh thu
                        </p>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->role == 1)

                    <li class="nav-item has-treeview">
                        <a href="{{ route('bank-user.index') }}"
                           class="nav-link {{ Request::is('bank-user') ? '' : '' }} ">
                            <i class="fa fa-info-circle "></i>
                            <p>
                                Danh sách tài khoản ngân hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('bank-admin.index') }}"
                           class="nav-link {{ Request::is('bank-admin') ? '' : '' }} ">
                            <i class="fa fa-university"></i>
                            <p>
                                Danh sách ngân hàng
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{ route('promotion.index') }}"
                           class="nav-link {{ Request::is('promotion') ? '' : '' }} ">
                            <i class="fa fa-university"></i>
                            <p>
                                Danh sách khuyến mãi
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ route('information.index') }}"
                           class="nav-link {{ Request::is('information') ? '' : '' }} ">
                            <i class="fa fa-user-tie"></i>
                            <p>
                                Thông tin chung
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
