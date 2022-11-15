<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addendum;
use App\Models\KontrakInduk;
use Illuminate\Support\Facades\DB;

class AddendumController extends Controller
{
    public function index()
    {
        // $addendums = DB::table('addendums')->join('kontrak_induks', 'addendums.nomor_kontrak_induk', '=', 'kontrak_induks.nomor_kontrak_induk')->join('khs', 'kontrak_induks.jenis_khs', '=', 'khs.jenis_khs')->get(['addendums.*', 'kontrak_induks.*', 'khs.*']);
        // dd($addendums);
        // $addendums = Khs::with();
        return view('khs.detail_khs.addendum_khs.addendum_khs', [
            'title' => 'Addendum',
            'active' => 'Addendum',
            'active1' => 'Addendum KHS',
            'addendums' => Addendum::all(),
        ]);
    }

    public function create()
    {
        return view('khs.detail_khs.addendum_khs.buat_addendum', [
            'title' => 'Addendum',
            'active' => 'Tambah Addendum',
            'active1' => 'Tambah Addendum KHS',
            'kontrakinduks' => KontrakInduk::all()
        ]);
    }

    public function getNoKontrakInduk(Request $request)
    {
        $no_kontrak_induk = $request->post('no_kontrak_induk');
        $jenis_khs = KontrakInduk::find($request->no_kontrak_induk)->where('nomor_kontrak_induk', $no_kontrak_induk)->value('jenis_khs');
        dd($jenis_khs);
        return response()->json($jenis_khs);           
    }


}
