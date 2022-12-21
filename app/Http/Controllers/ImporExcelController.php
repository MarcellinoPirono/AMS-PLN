<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemRincianInduk;

class ImporExcelController extends Controller
{
    function index()
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        // $itemRincian  = ItemRincianInduk::get();
        $data = DB::table('rincian_induks')->orderby('id', 'DESC')->get();
        return view('rincian.index', [
            'title' => 'Item KHS',
            'items' => RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get(),
            'jenis_khs' => $jenis_khs
        ]);
    }
}
