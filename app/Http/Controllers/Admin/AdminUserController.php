<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataUser = User::where('role', 'user')->latest()->paginate(10);

        return view('admin.pages.user.index', compact('dataUser'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataUser = User::with(['catatans', 'alokasis'])->findOrFail($id);
        $jumlahCatatan = $dataUser->catatans->count();
        $jumlahCatatanPemasukan = $dataUser->catatans
            ->where('kategori', 'Catatan Pemasukan')
            ->count();

        $jumlahCatatanPengeluaran = $dataUser->catatans
            ->where('kategori', 'Catatan Pengeluaran')
            ->count();

        return view('admin.pages.user.show', compact('dataUser', 'jumlahCatatan', 'jumlahCatatanPemasukan', 'jumlahCatatanPengeluaran'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dataUser = User::with(['catatans', 'alokasis'])->findOrFail($id);

        foreach ($dataUser->catatans as $catatan) {
            $catatan->delete();
        }

        foreach ($dataUser->alokasis as $alokasi) {
            $alokasi->delete();
        }

        $dataUser->delete();

        return redirect()->route('admin-user.index')->with('success', 'User dan semua data terkait berhasil dihapus.');
    }
}
