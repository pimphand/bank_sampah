<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <img src="{{ asset('logo.png') }}" width="100px" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">BASIBA</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('jenis-sampah.index') }}">
        <i class="fas fa-fw fa-trash"></i>
        <span>Kategori Sampah</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('sampah.index') }}">
        <i class="fas fa-fw fa-trash"></i>
        <span>Sampah</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('nasabah.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Nasabah</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Admin</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Transaksi
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('transaksi.create') }}">
        <i class="fas fa-fw fa-plus"></i>
        <span>Tambah Transaksi</span>
    </a>
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        <i class="fas fa-fw fa-folder"></i>
        <span>List Transaksi</span>
    </a>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('report.index') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Report</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
