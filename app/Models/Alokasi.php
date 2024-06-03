<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'variabel_alokasi',
        'persentase_alokasi',
        'user_id',
    ];

    /**
     * users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function alokasiPemasukans()
    {
        return $this->belongsToMany(Catatan::class, 'alokasi_pemasukans')->withPivot(['variabel_teralokasi', 'saldo_teralokasi'])->withTimestamps();
    }
}
