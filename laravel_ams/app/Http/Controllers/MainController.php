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

        // $pemasangan = DB::table('rincian_induks')
        // -> DB:raw(SELECT count (*) AS Tes)
        // -> WHERE (kontraks_id = '20') 
        // -> get();

        // Query builder
        // $pemasangan = DB::table('rincian_induks')->where("kontraks_id = '20'", '<=', $rincian)
        //     ->count();

        // Eloquent
        // $wordCount = Wordlist::where('id', '<=', $correctedComparisons)->count();
    }
}
