<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Carbon\Carbon;


class MainController extends Controller
{
    public function index()
    {
        $date = Carbon::now();


        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'date' => $date,
        ]);
        
    }
}
