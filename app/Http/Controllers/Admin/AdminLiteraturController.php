<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Literatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLiteraturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataLiteratur = Literatur::latest()->paginate(10);

        return view('admin.pages.literature.index', compact('dataLiteratur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.literature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'link' => 'required',
            'deskripsi' => 'nullable|max:255',
        ]);

        $dataLiteratur = new Literatur();
        $dataLiteratur->fill($request->all());
        $dataLiteratur->judul = $request->judul;
        $dataLiteratur->deskripsi = $request->deskripsi;
        $dataLiteratur->link = $request->link;
        $dataLiteratur->user_id = Auth::id();
        $dataLiteratur->save();

        return redirect()->route('admin-literature.index')->with(['success' => 'Data literatur berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataLiteratur = Literatur::findOrFail($id);

        return view('admin.pages.literature.show', compact('dataLiteratur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataLiteratur = Literatur::findOrFail($id);

        return view('admin.pages.literature.edit', compact('dataLiteratur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'link' => 'required',
            'deskripsi' => 'nullable|max:255',
        ]);

        $dataLiteratur = Literatur::findOrFail($id);

        $dataLiteratur->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->route('admin-literature.index')->with(['success' => 'Data literatur berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataLiteratur = Literatur::findOrFail($id);
        $dataLiteratur->delete();

        return redirect()->route('admin-literature.index')->with(['success' => 'Data literatur berhasil dihapus']);
    }
}
