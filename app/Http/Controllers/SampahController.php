<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use App\Models\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.sampah.index', [
            "jenis" => Sampah::all(),
            'kategori' => JenisSampah::all()
        ]);
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
        $data = $request->validate([
            "nama" => 'required',
            "harga" => 'required|numeric',
        ]);
        $data['jenis_sampah_id'] = $request->kategori;
        $data['satuan'] = 'kg';
        $data['berat'] = 0;
        Sampah::create($data);
        return back();
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
        $data = $request->validate([
            "nama" => 'required',
            "harga" => 'required|numeric',
        ]);

        Sampah::find($id)->update($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Sampah::destroy($id);
    }
}
