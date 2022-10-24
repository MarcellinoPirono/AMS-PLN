<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use App\Http\Requests\StoreRincianIndukRequest;
use App\Http\Requests\UpdateRincianIndukRequest;
use Illuminate\Support\Facades\Auth;

class RincianIndukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rincian.index', [
            'title' => 'Item Kontrak Induk',
            'items' => RincianInduk::all()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rincian.create', [
            'title' => 'Item Kontrak Induk',
            'active' => 'Rincian Item',
            'active1' => 'Tambah Rincian Item',
            'items' => RincianInduk::all(),
            'kontraks' => ItemRincianInduk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRincianIndukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRincianIndukRequest $request)
    {
        $validatedData = $request->validate([

            'nama_item' => 'required|max:250',
            'satuan' => 'required',
            'kontraks_id' => 'required',
            'harga_satuan' => 'required',

        ]);
        RincianInduk::create($validatedData);
        return redirect('/rincian')->with('success', 'Post has been edited');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function show(RincianInduk $rincianInduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function edit(RincianInduk $rincianInduk)
    {
        return view('rincian.edit', [

            'rincian' => $rincianInduk,
            'title' => 'Item Kontrak Induk',
            'active' => 'Rincian Item',
            'active1' => 'Edit Rincian Item',
            'kontraks' => ItemRincianInduk::all(),
            'items' => RincianInduk::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRincianIndukRequest  $request
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRincianIndukRequest $request, RincianInduk $rincianInduk)
    {
        $rules = [

            'nama_item' => 'required|max:250',
            'satuan' => 'required',
            'kontraks_id' => 'required',
            'harga_satuan' => 'required',

        ];

        $validatedData = $request->validate($rules);
        RincianInduk::where('id', $rincianInduk->id)->update($validatedData);
        return redirect('/rincian')->with('success', 'has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(RincianInduk $rincianInduk, $id)
    {

        $RincianInduk = RincianInduk::find($id);
        $RincianInduk->delete();

        return redirect('/rincian')->with('success', 'Data berhasil dihapus!');
        // RincianInduk::destroy($rincianInduk->id);
        // return redirect('/rincian')->with('success', 'post has been deleted');
    }
}
