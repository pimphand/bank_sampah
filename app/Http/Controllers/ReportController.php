<?php

namespace App\Http\Controllers;

use App\Exports\Transaksi as ExportsTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Str;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();

        // Count transactions for the current week
        $minggu_ini = Transaksi::whereBetween('created_at', [date('Y-m-d',strtotime($now->subDay(1))), date('Y-m-d', strtotime($now->endOfWeek()))])->count();

        // Count transactions for the previous week
        $minggu_lalu = Transaksi::whereBetween('created_at', [date('Y-m-d',strtotime($now->startOfWeek()->subWeek())), date('Y-m-d',strtotime($now->endOfWeek()->subWeek()))])->count();

        // Count transactions for the current month
        $start = Carbon::parse(now())->subDay(1)->format('Y-m-d');
        $end = Carbon::parse(now())->endOfMonth()->format('Y-m-d');

        $bulan_ini = Transaksi::whereBetween('created_at', [$start, $end])->count();

        // Count transactions for the previous month
        $bulan_lalu = Transaksi::whereYear('created_at', $now->subMonth()->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        return view('admin.report.index',compact(
'minggu_ini',
'minggu_lalu',
'bulan_ini',
'bulan_lalu',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start' => 'date',
            'end' => 'date|after_or_equal:start'
        ],[
            'start.date' =>'Tanggal mulai tidak valid',
            'end.date' =>'Tanggal selesai tidak valid',
            'end.after_or_equal' =>'Tanggal selesai tidak boleh besar dari tanggal mulai',
        ]);


        $start = Carbon::parse($request->start)->subDay(1)->format('Y-m-d');
        $end = Carbon::parse($request->end)->format('Y-m-d');

        $transaksi = Transaksi::whereBetween('created_at', [$start, $end])->get();

        // $transaksi = Transaksi::whereBetween('created_at', [date('Y-m-d', strtotime($request->start)), date('Y-m-d', strtotime($request->end))])->get();

        return Excel::download(new ExportsTransaksi($transaksi), 'transaksi_'. strtotime(now()).'.xlsx');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
