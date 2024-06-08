<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'kategori',
        'total_uang_masuk',
        'total_uang_keluar'
    ];

    /**
     * users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * catatan_pemasukan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catatanPemasukan(): HasMany
    {
        return $this->hasMany(CatatanPemasukan::class, 'catatan_id');
    }

    /**
     * catatan_pengeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function catatanPengeluaran(): HasMany
    {
        return $this->hasMany(CatatanPengeluaran::class, 'catatan_id');
    }

    /**
     * catatan_pengeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alokasis(): BelongsToMany
    {
        return $this->belongsToMany(Alokasi::class, 'alokasi_pemasukans')->withPivot(['catatan_id', 'alokasi_id', 'variabel_teralokasi', 'saldo_teralokasi'])->withTimestamps();
    }
}
