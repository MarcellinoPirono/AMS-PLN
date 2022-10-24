<?php

namespace App\Http\Controllers;

use App\Models\Spkk;
use App\Http\Requests\StoreSpkkRequest;
use App\Http\Requests\UpdateSpkkRequest;

class SpkkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spkk.index', [
            'title' => 'SPKK',
            'title1' => 'SPKK',
            'active' => 'SPKK'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spkk.create', [
            'title' => 'SPKK',
            'title1' => 'SPKK',
            'active' => 'SPKK',
            'active1' => 'Tambah SPKK'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpkkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpkkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spkk  $spkk
     * @return \Illuminate\Http\Response
     */
    public function show(Spkk $spkk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spkk  $spkk
     * @return \Illuminate\Http\Response
     */
    public function edit(Spkk $spkk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpkkRequest  $request
     * @param  \App\Models\Spkk  $spkk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpkkRequest $request, Spkk $spkk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spkk  $spkk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spkk $spkk)
    {
        // $spkk = Spkk::find($id)
        // $spkk->delete();

        // return redirect('/spkk')->with('success', 'Data berhasil dihapus');
    }
}
