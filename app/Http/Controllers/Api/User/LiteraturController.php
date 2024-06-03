<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\Literatur;

class LiteraturController extends Controller
{
    //
    public function index()
    {
        $dataLiteratur = Literatur::latest()->get();

        return new ApiResource(true, 'Daftar Literatur', $dataLiteratur);
    }
}
