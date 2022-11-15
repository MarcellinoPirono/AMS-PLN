<?php

namespace App\Http\Controllers;

use App\Models\KontrakInduk;
use App\Models\Khs;
use Illuminate\Http\Request;

class KontrakIndukController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.kontrak_induk_khs.kontrak_induk', [
            'title' => 'Kontrak Induk KHS',
            'khss' => Khs::all(),
            'kontrakinduks' => KontrakInduk::all(),
        ]);
        
    }
}
