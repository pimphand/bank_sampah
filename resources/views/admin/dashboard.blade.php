@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    @if (auth()->user()->role == 'admin')
    <x-dashboard_admin :user='$user' :transaksi='$transaksi'></x-dashboard_admin>
    @else
    <x-dashboard_nasabah :user='$user' :transaksi='$transaksi'></x-dashboard_nasabah>
    @endif
</div>
@endsection