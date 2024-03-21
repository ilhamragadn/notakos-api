<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatatanPengeluaranResource;
use App\Models\CatatanPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CatatanPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPengeluaran = CatatanPengeluaran::all();

        return new CatatanPengeluaranResource(true, 'Daftar Catatan Pengeluaran', $dataPengeluaran);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatePengeluaran = Validator::make($request->all(), [
            'gambar' => 'image|mimes:png,jpg,jpeg,svg,gif|max:5120',
            'judul' => 'required',
            'jenis_pengeluaran' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'satuan_barang' => 'required|numeric',
            'uang_keluar' => 'required|numeric',
            'sumber_uang_keluar' => 'required',
            'kategori_uang_keluar' => 'required',
            'total_uang_keluar' => 'numeric'
        ]);

        if ($validatePengeluaran->fails()) {
            return response()->json($validatePengeluaran->errors(), 422);
        }

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/cttn_pengeluaran', $gambar->hashName());

        $dataPengeluaran = new CatatanPengeluaran;
        $dataPengeluaran->gambar = $gambar->hashName();
        $dataPengeluaran->judul = $request->judul;
        $dataPengeluaran->deskripsi = $request->deskripsi;
        $dataPengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $dataPengeluaran->nama_barang = $request->nama_barang;
        $dataPengeluaran->harga_barang = intval($request->harga_barang);
        $dataPengeluaran->satuan_barang = intval($request->satuan_barang);
        $dataPengeluaran->uang_keluar = intval($request->uang_keluar);
        $dataPengeluaran->sumber_uang_keluar = $request->sumber_uang_keluar;
        $dataPengeluaran->kategori_uang_keluar = $request->kategori_uang_keluar;
        $dataPengeluaran->total_uang_keluar = intval($request->total_uang_keluar);
        $dataPengeluaran->save();

        return new CatatanPengeluaranResource(true, 'Catatan Pengeluaran Berhasil Ditambahkan', $dataPengeluaran);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataPengeluaran = CatatanPengeluaran::find($id);

        return new CatatanPengeluaranResource(true, 'Detail Catatan Pengeluaran ID ' . $id, $dataPengeluaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatePengeluaran = Validator::make($request->all(), [
            'gambar' => 'image|mimes:png,jpg,jpeg,svg,gif|max:5120',
            'judul' => 'required',
            'jenis_pengeluaran' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|numeric',
            'satuan_barang' => 'required|numeric',
            'uang_keluar' => 'required|numeric',
            'sumber_uang_keluar' => 'required',
            'kategori_uang_keluar' => 'required',
            'total_uang_keluar' => 'numeric'
        ]);

        if ($validatePengeluaran->fails()) {
            return response()->json($validatePengeluaran->errors(), 422);
        }

        $dataPengeluaran = CatatanPengeluaran::find($id);
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/cttn_pengeluaran/', $gambar->hashName());

            Storage::delete('public/cttn_pengeluaran/' . basename($dataPengeluaran->gambar));
            $dataPengeluaran->gambar = $gambar->hashName();
            $dataPengeluaran->judul = $request->judul;
            $dataPengeluaran->deskripsi = $request->deskripsi;
            $dataPengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
            $dataPengeluaran->nama_barang = $request->nama_barang;
            $dataPengeluaran->harga_barang = intval($request->harga_barang);
            $dataPengeluaran->satuan_barang = intval($request->satuan_barang);
            $dataPengeluaran->uang_keluar = intval($request->uang_keluar);
            $dataPengeluaran->sumber_uang_keluar = $request->sumber_uang_keluar;
            $dataPengeluaran->kategori_uang_keluar = $request->kategori_uang_keluar;
            $dataPengeluaran->total_uang_keluar = intval($request->total_uang_keluar);
            $dataPengeluaran->update();
        } else {
            $dataPengeluaran->judul = $request->judul;
            $dataPengeluaran->deskripsi = $request->deskripsi;
            $dataPengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
            $dataPengeluaran->nama_barang = $request->nama_barang;
            $dataPengeluaran->harga_barang = intval($request->harga_barang);
            $dataPengeluaran->satuan_barang = intval($request->satuan_barang);
            $dataPengeluaran->uang_keluar = intval($request->uang_keluar);
            $dataPengeluaran->sumber_uang_keluar = $request->sumber_uang_keluar;
            $dataPengeluaran->kategori_uang_keluar = $request->kategori_uang_keluar;
            $dataPengeluaran->total_uang_keluar = intval($request->total_uang_keluar);
            $dataPengeluaran->update();
        }

        return new CatatanPengeluaranResource(true, 'Catatan Pengeluaran ID ' . $id . ' Berhasil Diperbarui', $dataPengeluaran);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataPengeluaran = CatatanPengeluaran::find($id);
        Storage::delete('public/cttn_pengeluaran/' . basename($dataPengeluaran->gambar));
        $dataPengeluaran->delete();

        return new CatatanPengeluaranResource(true, 'Catatan Pengeluaran ID ' . $id . ' Telah Dihapus', null);
    }
}
