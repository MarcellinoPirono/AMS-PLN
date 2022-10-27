<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrkRequest;
use App\Http\Requests\UpdatePrkRequest;
use App\Models\Prk;
use App\Models\Skk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $prks = DB::select('SELECT * FROM prks LEFT JOIN skks ON prks.no_skk_prk = skks.id');
        return view('prk.index', [
            'title' => 'PRK',
            'prks' => Prk::orderby('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prk.create', [
            'title' => 'PRK',
            'active' => 'PRK',
            'active1' => 'Tambah PRK',
            'skss' => Skk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrkRequest $request)
    {
        $validatedData = $request->validate([

            'no_skk_prk' => 'required|max:250',
            'no_prk' => 'required|max:250',
            'uraian_prk' => 'required|max:250',
            'pagu_prk' => 'required|max:250',
            'prk_terkontrak' => 'required|max:250',
            'prk_realisasi' => 'required|max:250',
            'prk_terbayar' => 'required|max:250',
            'prk_sisa' => 'required|max:250'

        ]);
        Prk::create($validatedData);
        return redirect('/prk')->with('success', 'Prk Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function show(Prk $prk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prk = Prk::findOrFail($id);
        return view('prk.edit', [
            'title' => 'PRK',
            'active' => 'PRK',
            'active1' => 'Edit PRK',
            'prk' => $prk,
            'skks' =>  Skk::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrkRequest $request, Prk $prk, $id)
    {
        $prk = Prk::find($id);
        $prk->update([

            'no_skk_prk' => $request['no_skk_prk'],
            'no_prk' => $request['no_prk'],
            'uraian_prk' => $request['uraian_prk'],
            'pagu_prk' => $request['pagu_prk'],
            'prk_terkontrak' => $request['prk_terkontrak'],
            'prk_realisasi' => $request['prk_realisasi'],
            'prk_terbayar' => $request['prk_terbayar'],
            'prk_sisa' => $request['prk_sisa'],

        ]);
        return redirect('/prk')->with('status', 'PRK Berhasil Diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prk $prk, $uraian_prk)
    {
        // $prk = Prk::find($no_skk_prk);
        // // $sKK->prk()->delete();
        // $prk->delete();
        Prk::where('uraian_prk', $uraian_prk)->delete();

        return redirect('/prk')->with('success', 'Data berhasil dihapus!');
    }
}
