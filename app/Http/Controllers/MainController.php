<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Models\Rab;
use App\Models\NonPo;
use App\Models\Skk;


class MainController extends Controller
{
    public function index()
    {
        $date = Carbon::now();
        $this_year = $date->year;
        // dd($this_year);
        $po_khs_ditolak = Rab::where('status', 'Ditolak')->count();
        $po_khs_diterima = Rab::where('status', 'Diterima')->count();
        $po_khs_on_progress = Rab::where('status', 'Progress')->count();
        $non_po_ditolak = NonPo::where('status', 'Ditolak')->count();
        $non_po_diterima = NonPo::where('status', 'Diterima')->count();
        $non_po_waiting_list = NonPo::where('status', 'Waiting List')->count();
        $all_skk = Skk::whereYear('created_at', '=', $this_year)->get();
        // dd($all_skk);

        $nomor_skk_this_year = [];
        $sisa_skk_this_year = [];

        // $this_year_skk = $all_skk->created_at->format('y');
        for($i = 0; $i < count($all_skk); $i++){
            $nomor_skk_this_year[$i] = $all_skk[$i]->nomor_skk;
            $sisa_skk_this_year[$i] = $all_skk[$i]->skk_sisa;
        }
        // dd($nomor_skk_this_year);
        // dd($sisa_skk_this_year);


        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'date' => $date,
            'po_khs_ditolak' => $po_khs_ditolak,
            'po_khs_diterima' => $po_khs_diterima,
            'po_khs_on_progress' => $po_khs_on_progress,
            'non_po_ditolak' => $non_po_ditolak,
            'non_po_diterima' => $non_po_diterima,
            'non_po_waiting_list' => $non_po_waiting_list,
            'nomor_skk_this_year' => $nomor_skk_this_year,
            // 'all_skk' => $all_skk,
        ]);

    }
    public function data()
    {
    }
}
