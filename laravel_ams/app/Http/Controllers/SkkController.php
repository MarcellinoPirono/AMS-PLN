<?php

namespace App\Http\Controllers;

use App\Models\Skk;
use Illuminate\Http\Request;

class SKKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('skk.index', [
            'title' => 'SKK',
            'skks' => Skk::orderBy('id', 'DESC')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skk.create', [
            'title' => 'SKK',
            'active' => 'SKK',
            'active1' => 'Tambah SKK',
            'skks' => Skk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'nomor_skk' => 'required|max:250',
            'uraian_skk' => 'required|max:250',
            'pagu_skk' => 'required|max:250',
            'skk_terkontrak' => 'required|max:250',
            'skk_realisasi' => 'required|max:250',
            'skk_terbayar' => 'required|max:250',
            'skk_sisa' => 'required|max:250',

        ]);
        Skk::create($validatedData);
        return redirect('/skk')->with('success', 'Skk Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function show(SKK $sKK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skk = Skk::findOrFail($id);
        return view('skk.edit', [
            'title' => 'SKK',
            'active' => 'SKK',
            'active1' => 'Edit SKK',
            'skk' => $skk,
        ]);

        // return view('skk.edit', [

        //     'skk' => $sKK,
        //     'title' => 'SKK',
        //     'active' => 'SKK ',
        //     'active1' => 'Edit SKK ',
        //     'skks' => Skk::all(),
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SKK $sKK, $id)
    {
        $skk = Skk::find($id);
        // $rules = [

        //     'nomor_skk' => 'required|max:250',
        //     'uraian_skk' => 'required|max:250',
        //     'pagu_skk' => 'required|max:250',
        //     'skk_terkontrak' => 'required|max:250',
        //     'skk_realisasi' => 'required|max:250',
        //     'skk_terbayar' => 'required|max:250',
        //     'skk_sisa' => 'required|max:250',

        // ];
        $skk->update([

            'nomor_skk' => $request['nomor_skk'],
            'uraian_skk' => $request['uraian_skk'],
            'pagu_skk' => $request['pagu_skk'],
            'skk_terkontrak' => $request['skk_terkontrak'],
            'skk_realisasi' => $request['skk_realisasi'],
            'skk_terbayar' => $request['skk_terbayar'],
            'skk_sisa' => $request['skk_sisa'],
        ]);

        return redirect('/skk')->with('success', 'has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKK $sKK, $id)
    {
        $sKK = SKK::find($id);
        // $sKK->prk()->delete();
        $sKK->delete();

        return redirect('/skk')->with('success', 'post has been deleted');
    }
}
