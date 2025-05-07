<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menu dashboard -->
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
            </a>
        </li>
    
        @php
            $userRole = Auth::user()->level->level_kode;
        @endphp
    
        <!-- Menu Level hanya untuk Administrator -->
        @if($userRole == 'ADM')
            <li class="nav-header">Data Pengguna</li>
    
            <li class="nav-item">
            <a href="{{ url('/level') }}" class="nav-link {{ Request::is('level*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>Level User</p>
            </a>
            </li>
    
            <li class="nav-item">
            <a href="{{ url('/user') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Data User</p>
            </a>
            </li>
        @endif
    
        <!-- Menu Barang untuk Administrator dan Manager -->
        @if(in_array($userRole, ['ADM', 'MNG']))
            <li class="nav-header">Data Barang</li>
    
            <li class="nav-item">
            <a href="{{ url('/kategori') }}" class="nav-link {{ Request::is('kategori*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cube"></i>
                <p>Kategori Barang</p>
            </a>
            </li>
    
            <li class="nav-item">
            <a href="{{ url('/barang') }}" class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cubes"></i>
                <p>Data Barang</p>
            </a>
            </li>
        @endif
    
        <!-- Menu Transaksi untuk semua user -->
        <li class="nav-header">Data Transaksi</li>
    
        <li class="nav-item">
            <a href="{{ url('/stok') }}" class="nav-link {{ Request::is('stok*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>Stok Barang</p>
            </a>
        </li>
    
        <li class="nav-item">
            <a href="{{ url('/penjualan') }}" class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>Transaksi Penjualan</p>
            </a>
        </li>
    
        <!-- Menu logout -->
        <li class="nav-header">User</li>
        <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link text-danger">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->  
</div>

    