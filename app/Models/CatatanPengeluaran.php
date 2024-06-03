<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanPengeluaran extends Model
{
    use HasFactory;

    /*
    * fillable
    *
    * @var array
    */
    protected $fillable = [
        'nama_barang',
        'harga_barang',
        'satuan_barang',
        'uang_keluar', //anggap harga x satuan
        'jenis_pengeluaran', //makan minum jajan, transport, hiburan, dll
        'sumber_uang_keluar', //pakai gaji, atau sumber uang yg lain
        'kategori_uang_keluar', //cash or cashless
        'total_uang_keluar',
    ];

    /**
     * catatan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catatan(): BelongsTo
    {
        return $this->belongsTo(Catatan::class, 'catatan_id');
    }
}
