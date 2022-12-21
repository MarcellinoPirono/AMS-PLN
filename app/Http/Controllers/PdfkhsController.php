<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfkhsController extends Controller
{
    
     public function index()
    {
        return view('layouts.surat', [
            'title' => 'PDF',
            'title1' => 'PDF',

        ]);
    }

}
