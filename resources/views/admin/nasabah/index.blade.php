@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data {{ Str::ucfirst($role) }}</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-info">Tambah Data</button>
        </div>
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
                                            aria-label="Start date: activate to sort column ascending">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 191px;"
                                            aria-label="Start date: activate to sort column ascending">Username</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 191px;"
                                            aria-label="Start date: activate to sort column ascending">Saldo</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" style="width: 173px;"
                                            aria-label="Salary: activate to sort column ascending">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($nasabah as $key=> $item)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $key+1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->saldo }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Contoh Button Group">
                                                <button type="button" class="btn btn-info" data-edit="1"
                                                    data-nama="{{ $item->nama }}" data-username="{{ $item->username }}"
                                                    data-email="{{ $item->email }}" data-no_hp="{{ $item->no_hp }}"
                                                    data-alamat="{{ $item->alamat }}" data-id="{{ $item->id }}"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-success" data-id="{{ $item->id }}"
                                                    data-saldo="{{ $item->saldo }}"><i class="fa fa-coins"></i></button>
                                                <button type="button" class="btn btn-danger"
                                                    data-id="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
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
                <form id="form" action="{{ route($role.'.store') }}" method="POST">
                    @csrf
                    <div class="put"></div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan nama">
                                    <div class="text-danger" id="error-nama"></div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Masukan username">
                                    <div class="text-danger" id="error-username"></div>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Masukan email">
                                    <div class="text-danger" id="error-email"></div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputpassword1">No Telepon</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        placeholder="Masukan no_hp">
                                    <div class="text-danger" id="error-no_hp"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukan password">
                            <div class="text-danger" id="error-password"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpassword1">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Masukan alamat"></textarea>
                            <div class="text-danger" id="error-alamat"></div>
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
    <div class="modal fade" id="modal-saldo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-saldo">Tambah Saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputpassword1">Saldo</label>
                            <input type="text" class="form-control" id="saldo" name="saldo" placeholder="Masukan saldo">
                            <input type="text" class="form-control" id="id" name="id" placeholder="Masukan id" hidden>
                            <div class="text-danger" id="error-saldo"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-warning">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('.btn-info').click(function (e) {
        e.preventDefault();
        $("#form")[0].reset();
        if ($(this).data('edit') == 1) {
            let url = "{{ route($role.'.update',':id') }}"
                url = url.replace(':id',$(this).data('id'));
            $("form").attr('action',url);
            $('.put').html('@method("put")');
            $("#nama").val($(this).data('nama'))
            $("#username").val($(this).data('username'))
            $("#email").val($(this).data('email'))
            $("#no_hp").val($(this).data('no_hp'))
            $("#alamat").val($(this).data('alamat'))
            $('#exampleModalLabel').text('Edit Data')
        }else{
            $('.put').html('');
            let url = "{{ route($role.'.store') }}"
            $("form").attr('action',url);
            $('#exampleModalLabel').text('Tambah Data')
        }
        $('.text-danger').html('');
        $('.is-invalid').removeClass('is-invalid');
        $('#modal-form').modal('show');
    });

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
        let url = "{{ route($role.'.destroy',':id') }}"
            url = url.replace(':id',$(this).data('id'))
        deleted(url)
    });

    $('.btn-success').click(function(){
        $("#id").val($(this).data('id'));
        $("#saldo").val($(this).data('saldo'));
        $('#modal-saldo').modal('show');
    });

    $("#modal-saldo").on('click','.btn-warning',function (e) {
        e.preventDefault();
        let url = "{{ route('nasabah.saldo',':id') }}"
            url = url.replace(':id',$("#id").val())
            console.log(url);
        $.ajax({
            type: "post",
            url: url,
            data: {
                '_token':"{{ csrf_token() }}",
                'saldo' :$('#saldo').val(),
            },
            success: function (response) {
                toast('Data berhasil di ubah','success','Ubah data')
                setTimeout(function(){
                    window.location.reload();
                }, 3000);
            }
        });
    });
</script>
@endpush
