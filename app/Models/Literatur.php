<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Literatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'link'
    ];
}