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

<li class="nav-item">
    <a class="nav-link" href="{{ route('transaksi.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Transaksi</span>
    </a>
</li>
