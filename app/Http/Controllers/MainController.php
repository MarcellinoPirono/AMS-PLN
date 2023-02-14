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
        $po_khs_diterima = Rab::where('status', 'Disetujui')->count();
        $po_khs_on_progress = Rab::where('status', 'Progress')->count();
        $non_po_ditolak = NonPo::where('status', 'Ditolak')->count();
        $non_po_diterima = NonPo::where('status', 'Disetujui')->count();
        $non_po_waiting_list = NonPo::where('status', 'Waiting List')->count();
        $non_po_on_progress = NonPo::where('status', 'Progress')->count();
        $non_po_all_on_progress = $non_po_waiting_list + $non_po_on_progress;
        $all_skk_ai = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AI')->get();
        $all_skk_ao = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AO')->get();
        // dd($all_skk_ai);

        //SKK AI
        $nomor_skk_ai_this_year = [];
        $percentage_sisa_skk_ai_this_year = [];
        $nominal_sisa_skk_ai_this_year = [];

        //SKK AO
        $nomor_skk_ao_this_year = [];
        $percentage_sisa_skk_ao_this_year = [];
        $nominal_sisa_skk_ao_this_year = [];

        // $this_year_skk = $all_skk->created_at->format('y');
        for($i = 0; $i < count($all_skk_ai); $i++){
            $nomor_skk_ai_this_year[$i] = $all_skk_ai[$i]->nomor_skk;
            $percentage_sisa_skk_ai_this_year[$i] = (float)bcdiv(($all_skk_ai[$i]->skk_sisa) / ($all_skk_ai[$i]->pagu_skk) * 100, 1, 2);
            if($percentage_sisa_skk_ai_this_year[$i] < 0) {
                $percentage_sisa_skk_ai_this_year[$i] = 0;
            }
            $nominal_sisa_skk_ai_this_year[$i] = (int)$all_skk_ai[$i]->skk_sisa;
            if($nominal_sisa_skk_ai_this_year[$i] < 0) {
                $nominal_sisa_skk_ai_this_year[$i] = 0;
            }
        }
        for($i = 0; $i < count($all_skk_ao); $i++){
            $nomor_skk_ao_this_year[$i] = $all_skk_ao[$i]->nomor_skk;
            $percentage_sisa_skk_ao_this_year[$i] = (float)bcdiv(($all_skk_ao[$i]->skk_sisa) / ($all_skk_ao[$i]->pagu_skk) * 100, 1, 2);
            if($percentage_sisa_skk_ao_this_year[$i] < 0) {
                $percentage_sisa_skk_ao_this_year[$i] = 0;
            }
            $nominal_sisa_skk_ao_this_year[$i] = (int)$all_skk_ao[$i]->skk_sisa;
            if($nominal_sisa_skk_ao_this_year[$i] < 0) {
                $nominal_sisa_skk_ao_this_year[$i] = 0;
            }
        }
        // dd($nomor_skk_this_year);
        // dd($percentage_sisa_skk_ao_this_year, $percentage_sisa_skk_ai_this_year);


        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'date' => $date,
            'po_khs_ditolak' => $po_khs_ditolak,
            'po_khs_diterima' => $po_khs_diterima,
            'po_khs_on_progress' => $po_khs_on_progress,
            'non_po_ditolak' => $non_po_ditolak,
            'non_po_diterima' => $non_po_diterima,
            'non_po_all_on_progress' => $non_po_all_on_progress,
            'nomor_skk_ai_this_year' => $nomor_skk_ai_this_year,
            'percentage_sisa_skk_ai_this_year' => $percentage_sisa_skk_ai_this_year,
            'nominal_sisa_skk_ai_this_year' => $nominal_sisa_skk_ai_this_year,
            'nomor_skk_ao_this_year' => $nomor_skk_ao_this_year,
            'percentage_sisa_skk_ao_this_year' => $percentage_sisa_skk_ao_this_year,
            'nominal_sisa_skk_ao_this_year' => $nominal_sisa_skk_ao_this_year,
            // 'all_skk' => $all_skk,
        ]);

    }

    public function getPersentaseAI(){
        $date = Carbon::now();
        $this_year = $date->year;
        $all_skk_ai = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AI')->get();

        $percentage_sisa_skk_ai_this_year = [];

        for($i = 0; $i < count($all_skk_ai); $i++){
            $percentage_sisa_skk_ai_this_year[$i] = (float)bcdiv(($all_skk_ai[$i]->skk_sisa) / ($all_skk_ai[$i]->pagu_skk) * 100, 1, 2);
            if($percentage_sisa_skk_ai_this_year[$i] < 0) {
                $percentage_sisa_skk_ai_this_year[$i] = 0;
            }
        }
        return response()->json($percentage_sisa_skk_ai_this_year);
    }
    
    public function getNominalAI(){
        $date = Carbon::now();
        $this_year = $date->year;
        $all_skk_ai = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AI')->get();
        
        $nominal_sisa_skk_ai_this_year = [];

        for($i = 0; $i < count($all_skk_ai); $i++){
            $nominal_sisa_skk_ai_this_year[$i] = (int)$all_skk_ai[$i]->skk_sisa;
            if($nominal_sisa_skk_ai_this_year[$i] < 0) {
                $nominal_sisa_skk_ai_this_year[$i] = 0;
            }
        }
        
        return response()->json($nominal_sisa_skk_ai_this_year);
    }

    public function getPersentaseAO(){
        $date = Carbon::now();
        $this_year = $date->year;
        $all_skk_ao = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AO')->get();
    
        $percentage_sisa_skk_ao_this_year = [];
    
        for($i = 0; $i < count($all_skk_ao); $i++){
            $percentage_sisa_skk_ao_this_year[$i] = (float)bcdiv(($all_skk_ao[$i]->skk_sisa) / ($all_skk_ao[$i]->pagu_skk) * 100, 1, 2);
            if($percentage_sisa_skk_ao_this_year[$i] < 0) {
                $percentage_sisa_skk_ao_this_year[$i] = 0;
            }
        }
        return response()->json($percentage_sisa_skk_ao_this_year);
    }

    public function getNominalAO(){
        $date = Carbon::now();
        $this_year = $date->year;
        $all_skk_ao = Skk::whereYear('created_at', '=', $this_year)->whereNot('pagu_skk', '0')->where('ai_ao', 'AO')->get();
        
        $nominal_sisa_skk_ao_this_year = [];

        for($i = 0; $i < count($all_skk_ao); $i++){
            $nominal_sisa_skk_ao_this_year[$i] = (int)$all_skk_ao[$i]->skk_sisa;
            if($nominal_sisa_skk_ao_this_year[$i] < 0) {
                $nominal_sisa_skk_ao_this_year[$i] = 0;
            }
        }
        
        return response()->json($nominal_sisa_skk_ao_this_year);
    }
}
