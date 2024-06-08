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
        'nominal_uang_keluar',
        'jenis_kebutuhan',
        'kategori_uang_keluar',
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
