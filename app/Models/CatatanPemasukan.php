<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanPemasukan extends Model
{
    use HasFactory;

    /*
    * fillable
    *
    * @var array
    */
    protected $fillable = [
        'uang_masuk', //besaran nominal dari tiap sumber uang
        'kategori_uang_masuk', //cash or cashless
        'total_uang_masuk'
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
