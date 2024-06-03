<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Alokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $alokasi = Alokasi::with('alokasiPemasukans')
            ->where('alokasis.user_id', $user->id)
            ->get();

        return new ApiResource(true, 'Data Semua Alokasi', $alokasi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateAlokasi = Validator::make($request->all(), [
            '*.user_id' => 'required',
            '*.variabel_alokasi' => 'required',
            '*.persentase_alokasi' => 'required',
        ]);

        if ($validateAlokasi->fails()) {
            return response()->json($validateAlokasi->errors(), 422);
        }

        $alokasiData = $request->all();

        foreach ($alokasiData as $alokasi) {
            $newAlokasi = new Alokasi();
            $newAlokasi->user_id = intval($alokasi['user_id']);
            $newAlokasi->variabel_alokasi = $alokasi['variabel_alokasi'];
            $newAlokasi->persentase_alokasi = $alokasi['persentase_alokasi'];
            $newAlokasi->save();
        }

        return new ApiResource(true, 'Alokasi Berhasil Disimpan', $alokasiData);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateAlokasi = Validator::make($request->all(), [
            'variabel_alokasi' => 'required',
            'persentase_alokasi' => 'required'
        ]);

        if ($validateAlokasi->fails()) {
            return response()->json($validateAlokasi->errors(), 422);
        }

        $user = $request->user();
        $alokasi = Alokasi::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $alokasi->variabel_alokasi = $request->variabel_alokasi;
        $alokasi->persentase_alokasi = $request->persentase_alokasi;
        $alokasi->save();

        return new ApiResource(true, 'Alokasi Berhasil Diperbarui', $alokasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user = $request->user();
        $alokasi = Alokasi::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        $alokasi->delete();

        return new ApiResource(true, 'Alokasi berhasil dihapus', null);
    }
}
