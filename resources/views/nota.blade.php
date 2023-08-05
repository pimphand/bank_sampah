<!DOCTYPE html>
<html>

<head>
    <title>Nota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 10px 0;
        }

        .section {
            margin-top: 10px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BASIBA</h1>
        <h2>NOTA #{{ $data->id }}</h2>
    </div>
    <div class="section">
        <p>Tanggal : {{ $data->created_at }}</p>
        <p>Nomor Nota : #{{ $data->id }}</p>
        <p>Pelanggan : {{ $data->nasabah->nama }}</p>
        <p>Alamat : {{ $data->nasabah->alamat }}</p>
        <p>Telepon : {{ $data->nasabah->no_hp }}</p>
    </div>
    <div class="section">
        <div class="item-row">
            <span>Sampah</span>
            <span>Berat</span>
            <span>Harga</span>
            <span>Subtotal</span>
        </div>
        @php
            $total = 0;
        @endphp
        @foreach ($data->details as $detail)
            <div class="item-row">
                <span>{{ $detail->jenis->nama }} - {{ $detail->sampah->nama }}</span>
                <span>{{ $detail->berat }}</span>
                <span>Rp.{{ number_format($detail->harga) }}</span>
                <span>Rp.{{ number_format($detail->harga * $detail->berat) }}</span>
            </div>

            @php
                $total += $detail->harga * $detail->berat;
            @endphp
        @endforeach
    </div>
    <div class="section">
        <p>Total: Rp.{{ number_format($total) }}</p>
        <p>Total Akhir: Rp.{{ number_format($data->total_harga) }}</p>
    </div>
    <div class="section">
        <p>Terima kasih atas kunjungan Anda!</p>
    </div>
</body>
<script>
    window.print();
</script>

</html>
