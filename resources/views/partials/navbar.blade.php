<!-- Side Nav START -->
<div class="side-nav vertical-menu nav-menu-light scrollable">
    <div class="nav-logo">
        <div class="w-100 logo">
            <img class="img-fluid" src="/assets/images/logo/logo.png" style="max-height: 70px;" alt="logo">
        </div>
        <div class="mobile-close">
            <i class="icon-arrow-left feather"></i>
        </div>
    </div>
    <ul class="nav-menu">
        <li class="nav-group-title">Dashboard</li>
        <li class="nav-menu-item {{ Request::is('dashboard') ? 'router-link-active' : '' }}">
            <a href="/dashboard">
                <i class="feather icon-home"></i>
                <span class="nav-menu-item-title">Dashboard</span>

            </a>
        </li>
        @can('kasir')
            <li class="nav-group-title">Penjualan</li>
            <li class="nav-menu-item {{ Request::is('kasir/create') ? 'router-link-active' : '' }}">
                <a href="/kasir/create">
                    <i class="icon-shopping-cart feather"></i>
                    <span class="nav-menu-item-title">Penjualan Tiket</span>
                </a>
            </li>
            <li class="nav-menu-item {{ Request::is('kasir') ? 'router-link-active' : '' }}">
                <a href="/kasir">
                    <i class="feather icon-bar-chart"></i>
                    <span class="nav-menu-item-title">Riwayat Penjualan</span>
                </a>
            </li>
        @endcan
        @can('gate')
            <li class="nav-group-title">Scan</li>
            <li class="nav-menu-item {{ Request::is('scan/create') ? 'router-link-active' : '' }}">
                <a href="/scan/create">
                    <i class="la-ticket-alt la"></i>
                    <span class="nav-menu-item-title">Scan Tiket</span>
                </a>
            </li>
            {{-- <li class="nav-menu-item">
            <a href="/scan">
                <i class="la-history la"></i>
                <span class="nav-menu-item-title">Riwayat Scan Tiket</span>
            </a>
        </li> --}}
            <li class="nav-submenu">
                <a class="nav-submenu-title">
                    <i class="la-barcode la"></i>
                    <span>Riwayat Scan Tiket</span>
                    <i class="nav-submenu-arrow"></i>
                </a>
                <ul class="nav-menu menu-collapse">
                    <li class="nav-menu-item {{ Request::is('scan') ? 'router-link-active' : '' }}">
                        <a href="/scan">Simple</a>
                    </li>
                    <li class="nav-menu-item">
                        <a href="/scan">Detail</a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('admin')
            <li class="nav-group-title">Administrasi</li>
            <li class="nav-menu-item {{ Request::is('admin/tickets') ? 'router-link-active' : '' }}">
                <a href="/admin/tickets">
                    <i class="icon-list feather"></i>
                    <span class="nav-menu-item-title">Management Tiket</span>
                </a>
            </li>
            <li class="nav-menu-item {{ Request::is('admin/user') ? 'router-link-active' : '' }}">
                <a href="/admin/user">
                    <i class="icon-users feather"></i>
                    <span class="nav-menu-item-title">Management User</span>
                </a>
            </li>
            <li class="nav-menu-item {{ Request::is('admin/settings') ? 'router-link-active' : '' }}">
                <a href="/admin/settings">
                    <i class="icon-settings feather"></i>
                    <span class="nav-menu-item-title">Pengaturan</span>
                </a>
            </li>
        @endcan
    </ul>
</div>
<!-- Side Nav END -->
