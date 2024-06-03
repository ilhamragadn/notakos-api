<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Literatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiteraturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataLiteratur = Literatur::latest()->get();

        return new ApiResource(true, 'Daftar Literatur', $dataLiteratur);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateLiteratur = Validator::make($request->all(), [
            'judul' => 'required',
            'link' => 'required'
        ]);

        if ($validateLiteratur->fails()) {
            return response()->json($validateLiteratur->errors(), 422);
        }

        $dataLiteratur = new Literatur();
        $dataLiteratur->judul = $request->judul;
        $dataLiteratur->deskripsi = $request->deskripsi;
        $dataLiteratur->link = $request->link;
        $dataLiteratur->save();

        return new ApiResource(true, 'Data Literatur Berhasil Disimpan', $dataLiteratur);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataLiteratur = Literatur::find($id);

        return new ApiResource(true, 'Detail Literatur Berdasarkan ID ' . $id, $dataLiteratur);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateLiteratur = Validator::make($request->all(), [
            'judul' => 'required',
            'link' => 'required'
        ]);

        if ($validateLiteratur->fails()) {
            return response()->json($validateLiteratur->errors(), 422);
        }

        $dataLiteratur = Literatur::find($id);
        $dataLiteratur->judul = $request->judul;
        $dataLiteratur->deskripsi = $request->deskripsi;
        $dataLiteratur->link = $request->link;
        $dataLiteratur->update();

        return new ApiResource(true, 'Data Literatur ID ' . $id . ' Berhasil Diperbarui', $dataLiteratur);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataLiteratur = Literatur::find($id);
        $dataLiteratur->delete();

        return new ApiResource(true, 'Data Literatur ID ' . $id . ' Telah Dihapus', $dataLiteratur);
    }
}
