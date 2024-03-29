<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\JenisSampah;
use App\Models\Sampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $transaksi = Transaksi::all();
        } else {
            $transaksi = Transaksi::whereUserId(auth()->id())->get();
        }

        return view('admin.transaksi.index', [
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi.create', [
            'nasabah' => User::whereRole('nasabah')->get(),
            'jenis_sampah' => Sampah::all(),
            'data' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = DB::transaction(function () use ($request) {

            $transaksi = Transaksi::create([
                "user_id" => $request->nasabah,
                "keterangan" => $request->keterangan,
                "total_harga" => 0,
                "total_berat" => 0,
            ]);
            $total = 0;
            foreach ($request->jenis_sampah as $key => $harga) {
                $jenis = Sampah::find($request->jenis_sampah[$key]);
                $transaksi->details()->create([
                    "jenis_sampah_id" => $jenis->kategori->id,
                    "sampah_id" => $jenis->id,
                    "harga" => $jenis->harga,
                    "berat" => $request->berat[$key],
                ]);

                $total += $jenis->harga * $request->berat[$key];
            }

            $transaksi->update([
                "total_harga" => $total,
                "total_berat" => $transaksi->details->sum('berat'),
            ]);

            $user = User::find($transaksi->user_id);
            $saldo = $user->saldo;
            $user->saldo = $total;
            $user->save();

            $user->histories()->create([
                'saldo_awal' => $saldo,
                'debit' => $user->saldo,
                'credit' => 0,
                'description' => "Hasil Penjualan Sampah"
            ]);

            return $transaksi;
        });

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Transaksi::find($id);
        return view('nota',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Transaksi::find($id);
        return view('admin.transaksi.create', [
            'nasabah' => User::whereRole('nasabah')->get(),
            'jenis_sampah' => JenisSampah::all(),
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return response($request->delete, 400);
        $data = DB::transaction(function () use ($request, $id) {

            $transaksi = Transaksi::find($id);

            $transaksi->update([
                "user_id" => $request->nasabah,
                "keterangan" => $request->keterangan,
                "total_harga" => 0,
                "total_berat" => 0,
            ]);

            $total = 0;
            foreach ($request->detail_id as $i => $id) {
                DetailTransaksi::find($id)->update([
                    "jenis_sampah_id" => $request->detail_jenis_sampah[$i],
                    "berat" => $request->detail_berat[$i],
                    "harga" => $request->detail_harga[$i],
                ]);
            }

            if (isset($request->delete)) {
                foreach ($request->delete as $in => $delete) {
                    DetailTransaksi::destroy($delete);
                }
            }

            if (isset($request->harga) && !empty($request->harga)) {
                $jenis_sampah = array_filter($request->harga, function ($harga) {
                    return $harga !== null;
                });
                foreach ($jenis_sampah as $key => $harga) {
                    $jenis = JenisSampah::find($request->jenis_sampah[$key]);
                    $transaksi->details()->create([
                        "jenis_sampah_id" => $jenis->id,
                        "harga" => $jenis->harga,
                        "berat" => $request->berat[$key],
                    ]);
                }
            }

            $details = DetailTransaksi::whereTransaksiId($transaksi->id)->get();
            foreach ($details as $detail) {
                $total += $detail->harga * $detail->berat;
            }

            $transaksi->update([
                "total_harga" => $total,
                "total_berat" => $transaksi->details->sum('berat'),
            ]);

            $user = User::find($transaksi->user_id);
            $user->saldo += $total;
            $user->save();
            return $transaksi;
        });


        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->details()->delete();

        return $transaksi->delete();
    }
}
