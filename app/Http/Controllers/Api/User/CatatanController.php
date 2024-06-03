<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Catatan;
use App\Models\CatatanPemasukan;
use App\Models\CatatanPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $catatan = Catatan::with('catatanPemasukan', 'catatanPengeluaran', 'alokasis')
            ->where('catatans.user_id', $user->id)
            ->latest()->get();

        return new ApiResource(true, 'Data Semua Catatan', $catatan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateCatatan = Validator::make($request->all(), [
            'user_id' => 'required',
            'kategori' => 'required',
            'total_uang_masuk' => 'required_if:kategori,Catatan Pemasukan',
            'total_uang_keluar' => 'required_if:kategori,Catatan Pengeluaran',
        ]);

        if ($validateCatatan->fails()) {
            return response()->json($validateCatatan->errors(), 422);
        }

        $catatan = new Catatan();
        $kategori = $request->kategori;
        $catatan->user_id = intval($request->user_id);
        $catatan->deskripsi = $request->deskripsi;
        $catatan->kategori = $request->kategori;
        if ($kategori == 'Catatan Pemasukan') {
            $catatan->total_uang_masuk = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $request->total_uang_masuk));

            if (!empty($pemasukanData['alokasis'])) {
                $alokasiData = [];
                foreach ($pemasukanData['alokasis'] as $alokasi) {
                    $alokasiData[$alokasi['alokasi_id']] = [
                        'variabel_teralokasi' => $alokasi['variabel_teralokasi'] ?? null,
                        'saldo_teralokasi' => intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '',  $alokasi['saldo_teralokasi'] ?? null)),
                    ];
                }
                // Sync alokasi data
                $catatan->alokasis()->sync($alokasiData);
            }
        } else {
            $catatan->total_uang_keluar = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $request->total_uang_keluar));
        }
        $catatan->save();

        if ($kategori == 'Catatan Pemasukan' && !empty($request->alokasis)) {
            $alokasiData = [];
            foreach ($request->alokasis as $alokasi) {
                $alokasiData[$alokasi['alokasi_id']] = [
                    'variabel_teralokasi' => $alokasi['variabel_teralokasi'] ?? null,
                    'saldo_teralokasi' => intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $alokasi['saldo_teralokasi'] ?? '0')),
                ];
            }
            // Sync alokasi data
            $catatan->alokasis()->sync($alokasiData);
        }

        if ($kategori == 'Catatan Pemasukan') {
            $catatanPemasukanData = $request->catatan_pemasukan;
            $catatanPemasukan = [];

            foreach ($catatanPemasukanData as $pemasukanData) {
                $validatePemasukan = Validator::make($pemasukanData, [
                    'nominal_uang_masuk' => 'required',
                    'kategori_uang_masuk' => 'required',
                ]);

                if ($validatePemasukan->fails()) {
                    return response()->json($validatePemasukan->errors(), 422);
                }

                $catatanPemasukan = new CatatanPemasukan();
                $catatanPemasukan->nominal_uang_masuk = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pemasukanData['nominal_uang_masuk']));
                $catatanPemasukan->kategori_uang_masuk = $pemasukanData['kategori_uang_masuk'];
                $catatanPemasukan->catatan_id = $catatan->id; // Set kunci asing

                $catatanPemasukan->save();
            }

            return new ApiResource(true, 'Catatan Berhasil Disimpan', ['catatan' => $catatan, 'kategori_pemasukan' => $catatanPemasukan]);
        } else {
            $catatanPengeluaranData = $request->catatan_pengeluaran;
            $catatanPengeluaran = [];

            foreach ($catatanPengeluaranData as $pengeluaranData) {
                $validatePengeluaran = Validator::make($pengeluaranData, [
                    'nama_barang' => 'required',
                    'harga_barang' => 'required',
                    'satuan_barang' => 'required',
                    'nominal_uang_keluar' => 'required',
                    'jenis_kebutuhan' => 'required',
                    'kategori_uang_keluar' => 'required',
                ]);

                if ($validatePengeluaran->fails()) {
                    return response()->json($validatePengeluaran->errors(), 422);
                }

                $catatanPengeluaran = new CatatanPengeluaran();
                $catatanPengeluaran->catatan_id = $catatan->id;
                $catatanPengeluaran->nama_barang = $pengeluaranData['nama_barang'];
                $catatanPengeluaran->harga_barang = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pengeluaranData['harga_barang']));
                $catatanPengeluaran->satuan_barang = intval($pengeluaranData['satuan_barang']);
                $catatanPengeluaran->nominal_uang_keluar = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pengeluaranData['nominal_uang_keluar']));
                $catatanPengeluaran->jenis_kebutuhan = $pengeluaranData['jenis_kebutuhan'];
                $catatanPengeluaran->kategori_uang_keluar = $pengeluaranData['kategori_uang_keluar'];

                $catatanPengeluaran->save();
            }

            return new ApiResource(true, 'Catatan Berhasil Disimpan', ['catatan' => $catatan, 'kategori_pemasukan' => $catatanPengeluaran]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $user = $request->user();
        $catatan = Catatan::with('catatanPemasukan', 'catatanPengeluaran', 'alokasis')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        return new ApiResource(true, 'Detail Catatan Id ' . $id, $catatan);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateCatatan = Validator::make($request->all(), [
            'kategori' => 'required',
            'total_uang_masuk' => 'required_if:kategori,Catatan Pemasukan',
            'total_uang_keluar' => 'required_if:kategori,Catatan Pengeluaran',
        ]);

        if ($validateCatatan->fails()) {
            return response()->json($validateCatatan->errors(), 422);
        }

        $user = $request->user();
        $catatan = Catatan::with('catatanPemasukan', 'catatanPengeluaran', 'alokasis')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$catatan) {
            return response()->json(['error' => 'Catatan tidak ditemukan'], 404);
        }

        $kategori = $request->kategori;
        $catatan->deskripsi = $request->deskripsi;
        $catatan->kategori = $request->kategori;
        if ($kategori == 'Catatan Pemasukan') {
            $catatan->total_uang_masuk = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $request->total_uang_masuk));

            if (!empty($pemasukanData['alokasis'])) {
                $alokasiData = [];
                foreach ($pemasukanData['alokasis'] as $alokasi) {
                    $alokasiData[$alokasi['alokasi_id']] = [
                        'variabel_teralokasi' => $alokasi['variabel_teralokasi'] ?? null,
                        'saldo_teralokasi' => intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '',  $alokasi['saldo_teralokasi'] ?? null)),
                    ];
                }
                // Sync alokasi data
                $catatan->alokasis()->sync($alokasiData);
            }
        } else {
            $catatan->total_uang_keluar = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $request->total_uang_keluar));
        }
        $catatan->save();

        if ($kategori == 'Catatan Pemasukan' && !empty($request->alokasis)) {
            $alokasiData = [];
            foreach ($request->alokasis as $alokasi) {
                $alokasiData[$alokasi['alokasi_id']] = [
                    'variabel_teralokasi' => $alokasi['variabel_teralokasi'] ?? null,
                    'saldo_teralokasi' => intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $alokasi['saldo_teralokasi'] ?? '0')),
                ];
            }
            // Sync alokasi data
            $catatan->alokasis()->sync($alokasiData);
        }

        if ($kategori == 'Catatan Pemasukan') {
            $catatanPemasukanData = $request->catatan_pemasukan;
            $catatanPemasukan = [];

            foreach ($catatanPemasukanData as $pemasukanData) {
                $validatePemasukan = Validator::make($pemasukanData, [
                    'nominal_uang_masuk' => 'required',
                    'kategori_uang_masuk' => 'required',
                ]);

                if ($validatePemasukan->fails()) {
                    return response()->json($validatePemasukan->errors(), 422);
                }

                $catatanPemasukan = CatatanPemasukan::where('catatan_id', $catatan->id)
                    ->where('id', $pemasukanData['id'] ?? null)
                    ->first();

                $catatanPemasukan->nominal_uang_masuk = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pemasukanData['nominal_uang_masuk']));
                $catatanPemasukan->kategori_uang_masuk = $pemasukanData['kategori_uang_masuk'];
                $catatanPemasukan->catatan_id = $catatan->id; // Set kunci asing

                $catatanPemasukan->save();
            }

            return new ApiResource(true, 'Catatan Berhasil Diperbarui', ['catatan' => $catatan, 'kategori_pemasukan' => $catatanPemasukan]);
        } else {
            $catatanPengeluaranData = $request->catatan_pengeluaran;
            $catatanPengeluaran = [];

            foreach ($catatanPengeluaranData as $pengeluaranData) {
                $validatePengeluaran = Validator::make($pengeluaranData, [
                    'nama_barang' => 'required',
                    'harga_barang' => 'required',
                    'satuan_barang' => 'required',
                    'nominal_uang_keluar' => 'required',
                    'jenis_kebutuhan' => 'required',
                    'kategori_uang_keluar' => 'required',
                ]);

                if ($validatePengeluaran->fails()) {
                    return response()->json($validatePengeluaran->errors(), 422);
                }

                $catatanPengeluaran = CatatanPengeluaran::where('catatan_id', $catatan->id)
                    ->where('id', $pengeluaranData['id'] ?? null)
                    ->first();

                $catatanPengeluaran->catatan_id = $catatan->id;
                $catatanPengeluaran->nama_barang = $pengeluaranData['nama_barang'];
                $catatanPengeluaran->harga_barang = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pengeluaranData['harga_barang']));
                $catatanPengeluaran->satuan_barang = intval($pengeluaranData['satuan_barang']);
                $catatanPengeluaran->nominal_uang_keluar = intval(str_replace(['Rp', "\u{A0}", '.', ',00'], '', $pengeluaranData['nominal_uang_keluar']));
                $catatanPengeluaran->jenis_kebutuhan = $pengeluaranData['jenis_kebutuhan'];
                $catatanPengeluaran->kategori_uang_keluar = $pengeluaranData['kategori_uang_keluar'];

                $catatanPengeluaran->save();
            }

            return new ApiResource(true, 'Catatan Berhasil Disimpan', ['catatan' => $catatan, 'kategori_pemasukan' => $catatanPengeluaran]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $catatan = Catatan::findOrFail($id);

        // Pastikan $catatan tidak null sebelum melanjutkan
        if ($catatan) {
            $kategori = $catatan->kategori;

            if ($kategori == 'Catatan Pemasukan') {
                $catatan->catatanPemasukan()->delete();
            } else {
                $catatan->catatanPengeluaran()->delete();
            }

            $catatan->delete();

            return new ApiResource(true, 'Catatan berhasil dihapus', null);
        } else {
            return new ApiResource(false, 'Catatan tidak ditemukan', null);
        }
    }
}
