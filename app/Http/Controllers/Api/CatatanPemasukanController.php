<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatatanPemasukanResource;
use App\Models\CatatanPemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CatatanPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPemasukan = CatatanPemasukan::all();

        return new CatatanPemasukanResource(true, 'Daftar Catatan Pemasukan', $dataPemasukan);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePemasukan = Validator::make([
            'gambar' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5120',
            'judul' => 'required|min:5',
            'uang_masuk' => 'numeric',
            'sumber_uang_masuk' => 'required',
            'kategori_uang_masuk' => 'required',
            'total_uang_masuk' => 'numeric'
        ]);

        if ($validatePemasukan->fails()) {
            return response()->json($validatePemasukan->errors(), 422);
        }

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/cttn_pemasukan', $gambar->hashName());

        $dataPemasukan = new CatatanPemasukan;
        $dataPemasukan->gambar = $gambar->hashName();
        $dataPemasukan->judul = $request->judul;
        $dataPemasukan->uang_masuk = intval($request->uang_masuk);
        $dataPemasukan->sumber_uang_masuk = $request->sumber_uang_masuk;
        $dataPemasukan->kategori_uang_masuk = $request->kategori_uang_masuk;
        $dataPemasukan->total_uang_masuk = intval($request->total_uang_masuk);
        $dataPemasukan->save();

        return new CatatanPemasukanResource(true, 'Catatan Pemasukan Berhasil Ditambahkan', $dataPemasukan);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPemasukan = CatatanPemasukan::find($id);

        return new CatatanPemasukanResource(true, 'Detail Catatan Pemasukan Berdasarkan Id', $dataPemasukan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatePemasukan = Validator::make([
            'gambar' => 'image|mimes:png,jpg,jpeg,gif,svg|max:5120',
            'judul' => 'required|min:5',
            'uang_masuk' => 'numeric',
            'sumber_uang_masuk' => 'required',
            'kategori_uang_masuk' => 'required',
            'total_uang_masuk' => 'numeric'
        ]);

        if ($validatePemasukan->fails()) {
            return response()->json($validatePemasukan->errors(), 422);
        }

        $dataPemasukan = CatatanPemasukan::find($id);
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/cttn_pemasukan', $gambar->hashName());

            Storage::delete('public/cttn_pemasukan/' . basename($dataPemasukan->gambar));
            $dataPemasukan->gambar = $gambar->hashName();
            $dataPemasukan->judul = $request->judul;
            $dataPemasukan->uang_masuk = intval($request->uang_masuk);
            $dataPemasukan->sumber_uang_masuk = $request->sumber_uang_masuk;
            $dataPemasukan->kategori_uang_masuk = $request->kategori_uang_masuk;
            $dataPemasukan->total_uang_masuk = intval($request->total_uang_masuk);
            $dataPemasukan->update();
        } else {
            $dataPemasukan->judul = $request->judul;
            $dataPemasukan->uang_masuk = intval($request->uang_masuk);
            $dataPemasukan->sumber_uang_masuk = $request->sumber_uang_masuk;
            $dataPemasukan->kategori_uang_masuk = $request->kategori_uang_masuk;
            $dataPemasukan->total_uang_masuk = intval($request->total_uang_masuk);
            $dataPemasukan->update();
        }

        return new CatatanPemasukanResource(true, 'Catatan Pemasukan Berhasil Diperbarui', $dataPemasukan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPemasukan = CatatanPemasukan::find($id);
        Storage::delete('public/cttn_pemasukan/' . basename($dataPemasukan->gambar));
        $dataPemasukan->delete();

        return new CatatanPemasukanResource(true, 'Catatan Pemasukan Telah Dihapus', null);
    }
}
