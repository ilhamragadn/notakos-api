<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LiteraturResources;
use App\Models\Literatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiteraturController extends Controller
{
    //
    public function index()
    {
        $dataLiteratur = Literatur::all();

        return new LiteraturResources(true, 'Daftar Literatur', $dataLiteratur);
    }

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

        return new LiteraturResources(true, 'Data Literatur Berhasil Disimpan', $dataLiteratur);
    }

    public function show($id)
    {
        $dataLiteratur = Literatur::find($id);

        return new LiteraturResources(true, 'Detail Literatur Berdasarkan ID ' . $id, $dataLiteratur);
    }

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

        return new LiteraturResources(true, 'Data Literatur ID ' . $id . ' Berhasil Diperbarui', $dataLiteratur);
    }

    public function destroy($id)
    {
        $dataLiteratur = Literatur::find($id);
        $dataLiteratur->delete();

        return new LiteraturResources(true, 'Data Literatur ID ' . $id . ' Telah Dihapus', $dataLiteratur);
    }
}
