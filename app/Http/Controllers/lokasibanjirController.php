<?php

namespace App\Http\Controllers;

use App\Models\kecamatan;
use Illuminate\Http\Request;
use App\Models\lokasi_banjir;
use App\Models\sejarah_banjir;
use Illuminate\Routing\Controller;

class lokasibanjirController extends Controller
{
    public function tabellokasibanjir()
    {
        $lokasi_banjirs = sejarah_banjir::all();
        return view('pages.lokasi_banjir.tb_lokasi_banjir', compact('lokasi_banjirs'));
    }

    public function formlokasibanjir(){
        $kecamatan = kecamatan::get();
        return view ('pages.lokasi_banjir.form_lokasi_banjir', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required',
            'kecamatan' => 'required',
            'koordinat_lat' => 'required|numeric',
            'koordinat_lon' => 'required|numeric',
            'tanggal_kejadian' => 'required|date',
            'penyebab' => 'required',
            'sumber_informasi' => 'required',
        ]);

        sejarah_banjir::create($request->all());

        return redirect()->route('formlokasibanjir')
                         ->with('success', 'Data Sejarah Banjir berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $lokasi_banjir = sejarah_banjir::find($id);
        return view('pages.lokasi_banjir.edit_lokasi_banjir', compact('lokasi_banjir'));
    }

    public function update(Request $request, $id)
    {
        $lokasi_banjir = sejarah_banjir::find($id);
        $request->validate([
            'nama_lokasi' => 'required',
            'kecamatan' => 'required',
            'koordinat_lat' => 'required|numeric',
            'koordinat_lon' => 'required|numeric',
            'tanggal_kejadian' => 'required|date',
            'penyebab' => 'required',
            'sumber_informasi' => 'required',
        ]);

        $lokasi_banjir->update($request->all());

        return redirect()->route('tabellokasibanjir')
                         ->with('success', 'Data Lokasi Banjir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $lokasi_banjir = sejarah_banjir::find($id);
        $lokasi_banjir->delete();
        return redirect()->route('tabellokasibanjir')
                         ->with('success', 'Data Lokasi Banjir berhasil dihapus.');
    }

}
