<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPemasukan extends Model
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
        'uang_masuk', //besaran nominal dari tiap sumber uang
        'sumber_uang_masuk', //gaji, ortu
        'kategori_uang_masuk', //cash or cashless
        'total_uang_masuk'
    ];
}
