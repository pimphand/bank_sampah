<table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info"
    style="width: 100%;" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Total</th>
            <th>Berat</th>
            <th>Tanggal</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $tran)
        <tr>
            <td>{{ $tran->id }}</td>
            <td>{{ $tran->nasabah->nama }}</td>
            <td>{{ $tran->total_harga }}</td>
            <td>{{ $tran->total_berat }}</td>
            <td>
                {{ $tran->created_at }}
            </td>
            <td>
                <ul>
                    @foreach ($tran->details as $detail)
                    <li>{{ $detail->jenis->nama }} - {{ $detail->sampah->nama }} | Rp. {{ number_format($detail->harga,2) }} | {{ $detail->berat }}Kg</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
