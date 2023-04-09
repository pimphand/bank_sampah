@extends('app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="form" method="POST">
                @if ($data)
                @method('put')
                @endif
                @csrf
                @php
                $user = 0;
                if (isset($data)) {
                $user = $data->user_id;
                }
                @endphp
                <div class="form-group">
                    <label for="inputEmail4">Nasabah</label>
                    <select class="form-control" name="nasabah" id="nasabah" placeholder="Email">
                        <option value="" hidden>Pilih nasabah</option>
                        @foreach ($nasabah as $item)
                        <option value="{{ $item->id }}" @if ($user==$item->id)
                            selected
                            @endif>{{ $item->nama }}
                        </option>
                        @endforeach
                    </select>
                    <div class="text-danger" id="error-nasabah"></div>
                </div>
                <div class="form-group ">
                    <label for="inputPassword4">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan"
                        placeholder="Masukan keterangan"></textarea>
                    <div class="text-danger" id="error-keterangan"></div>
                </div>
                <h4><strong>Detail Transaksi</strong></h4>
                @if (isset($data))
                @foreach ($data->details as $detail)
                <div class="row">
                    <div class="col-4">
                        <label for="inputPassword4">Jenis Sampah</label>
                        <select class="form-control" name="detail_jenis_sampah[]" id="jenis_sampah" placeholder="Email">
                            @foreach ($jenis_sampah as $jenis)
                            <option value="{{ $jenis->id }}" {{ $detail->jenis_sampah_id == $jenis->id ? "selected" : ""
                                }}>{{ $jenis->nama }} | Rp. {{ number_format($jenis->harga,2)
                                }}
                            </option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="error-jenis_sampah"></div>
                    </div>
                    <div class="col-4">detail
                        <label for="inputPassword4">Berat</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="detail_berat[]" placeholder="Masukan berat"
                                value="{{ $detail->berat }}" aria-label="Masukan berat" aria-describedby="basic-addon2">
                            <input type="text" hidden name="detail_id[]" value="{{ $detail->id }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="inputPassword4">Harga</label>
                        <div class="input-group mb-3"><input type="text" class="form-control" name="detail_harga[]"
                                value="{{ $detail->harga }}" placeholder="Search" aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button" data-id="{{ $detail->id }}">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @endif
                <div class="row clone">
                    <div class="col-4">
                        <label for="inputPassword4">Jenis Sampah</label>
                        <select class="form-control" name="jenis_sampah[]" id="jenis_sampah" placeholder="Email">
                            <option value="" data-harga=" ">Pilih jenis sampah</option>
                            @foreach ($jenis_sampah as $jenis)
                            <option value="{{ $jenis->id }}" data-harga="{{ number_format($jenis->harga,2)}}">
                                {{ $jenis->nama }} | Rp. {{ number_format($jenis->harga,2) }}
                            </option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="error-jenis_sampah"></div>
                    </div>
                    <div class="col-4">detail
                        <label for="inputPassword4">Berat</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="berat[]" placeholder="Masukan berat"
                                aria-label="Masukan berat" aria-describedby="basic-addon2">

                        </div>
                    </div>
                    <div class="col-4" id="harga-show">
                        <label for="inputPassword4">Harga</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="harga[]" disabled id="harga" value="Rp. "
                                placeholder="Masukan harga" aria-label="Masukan harga" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
                <div id="detail">
                </div>
                <div class="delete"></div>
                <button type="button" class="btn btn-primary">Tambah Detail</button>
                <button type="button" class="btn btn-success" data-edit="{{ $data != null ? 1 : 0 }}">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $('.btn-primary').click(function (e) { 
         var clonedRow = $(".clone:last").clone();
        // Clear input values
        clonedRow.find("input[type='number']").val("");
        // Replace element with id "harga-show" with new input group element
        clonedRow.find("#harga-show").replaceWith('<div class="col-4"><label for="inputPassword4">Harga</label><div class="input-group mb-3"><input type="text" class="form-control" name="harga[]" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-danger" type="button">Hapus</button></div></div></div>');
        // Append cloned row to container with id "details_container"
        clonedRow.appendTo("#detail");
    });

    $(".btn-danger").on('click', function () {
        $(".delete").append(`<input type="text" value="${$(this).data('id')}" name="delete[]">`);
        $(this).closest('.row').remove();
    });

    $("#detail").on('click','.btn-danger', function () {
        $(this).closest('.clone').remove();
    });

    $('#jenis_sampah').change(function (e) {
        e.preventDefault();
        console.log($(this).find(':selected').data('harga'));
        $(this).closest('.row').find('#harga').val("Rp. "+$(this).find(':selected').data('harga'));
    });
</script>

@if (isset($data))
<script>
    $('.btn-success').click(function (e) {
            let data = $('form').serialize()
            let url = "{{ route('transaksi.update',$data->id) }}";
            update(data, url)
        });
</script>
@else
<script>
    $('.btn-success').click(function (e) {
            let data = $('form').serialize()
            let url = "{{ route('transaksi.store') }}";
            create(data, url)
        });
</script>
@endif
@endpush