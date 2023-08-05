@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Report</h1>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Transaksi Minggu ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $minggu_ini }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Transaksi Munggu Lalu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $minggu_lalu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bulan_ini }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Bulan Lalu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bulan_lalu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('report.store') }}" method="post">
        @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-6">
                <label for="inputPassword4">Tanggal Mulai</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="start" placeholder="Masukan berat" value="{{ old('start') }}"
                        aria-label="Masukan berat" aria-describedby="basic-addon2">
                </div>
            </div>
            <div class="col-6">
                <label for="inputPassword4">Tanggal Selesai</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="end" placeholder="Masukan berat" value="{{ old('end') }}"
                        aria-label="Masukan berat" aria-describedby="basic-addon2">
                </div>
            </div>
        </div>

        <button class="btn btn-success">Export</button>
    </form>
</div>
@endsection
