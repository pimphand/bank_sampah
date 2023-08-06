@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" role="grid"
                                aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 202px;"
                                            aria-label="Office: activate to sort column ascending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 102px;"
                                            aria-label="Age: activate to sort column ascending">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 191px;"
                                            aria-label="Start date: activate to sort column ascending">Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 191px;"
                                            aria-label="Start date: activate to sort column ascending">Berat</th>
                                        @if (auth()->user()->role == 'admin')
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 173px;"
                                                aria-label="Salary: activate to sort column ascending">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($transaksi as $key=> $item)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $key+1 }}</td>
                                        <td>{{ $item->nasabah->nama }}</td>
                                        <td>Rp. {{ number_format($item->total_harga) }}</td>
                                        <td>{{ $item->total_berat }}/Kg</td>
                                        @if (auth()->user()->role == 'admin')
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Contoh Button Group">
                                                   <a class="btn btn-info" target="_blank" href="{{ route('transaksi.show',$item->id) }}" data-edit="1"><i
                                                            class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>

                                                </div>
                                            </td>
                                            @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('jenis-sampah.store') }}" method="POST">
                    @csrf
                    <div class="put">

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama">
                            <div class="text-danger" id="error-nama"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga/kg</label>
                            <input type="number" min="1" class="form-control" id="harga" name="harga"
                                id="exampleInputharga1" placeholder="">
                            <div class="text-danger" id="error-harga"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('.btn-primary').click(function(e) {
        e.preventDefault();
        let data = $('form').serialize()
        let url = $("form").attr('action');
        let type = $('#modal-form .modal-title').text();
        if (type == "Tambah Data") {
            create(data, url)
        } else {
            update(data, url);
        }
    });

    $(".btn-danger").click(function (e) {
        e.preventDefault();
        let url = "{{ route('transaksi.destroy',':id') }}"
            url = url.replace(':id',$(this).data('id'))
        deleted(url)
    });
</script>
@endpush
