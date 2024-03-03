<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPengeluaran extends Model
{
    use HasFactory;

    /*
    * fillable
    *
    * @var array
    */
    protected $fillable = [
        'gambar',
        'judul',
        'deskripsi',
        'jenis_pengeluaran', //makan minum jajan, transport, hiburan, dll
        'nama_barang',
        'harga_barang',
        'satuan_barang',
        'uang_keluar', //anggap harga x satuan
        'sumber_uang_keluar', //pakai gaji, atau sumber uang yg lain
        'kategori_uang_keluar', //cash or cashless
        'total_uang_keluar',
    ];
}
