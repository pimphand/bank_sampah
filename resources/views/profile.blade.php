@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>

    <div class="row text-center">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{session('success')}}
                    </div>
                    @endif
                    <form id="form" action="{{ route('profile') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ auth()->user()->nama }}" name="nama"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ auth()->user()->username }}"
                                name="username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" autocomplete="off" name="password"
                                placeholder="Ganti password" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-success"> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection