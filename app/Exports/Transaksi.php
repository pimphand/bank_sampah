<?php

namespace App\Exports;

use App\Models\Transaksi as ModelTransaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Transaksi implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct($request)
    {
        $this->data = $request;
    }

    public function view(): View
    {

        dd($this->data);
        return view('report', [
            'transaksi' => $this->data
        ]);
    }
}
