<?php

namespace App\Http\Controllers;

use App\Models\ItemRincianInduk;
use App\Models\RincianInduk;
use App\Http\Requests\StoreItemRincianIndukRequest;
use App\Http\Requests\UpdateItemRincianIndukRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ItemRincianIndukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index', [
            'title' => 'Kategori Kontrak Induk',
            'active' => 'Kategori Kontrak Induk',
            'active1' => 'Kategori Kontrak Induk',
            'kontraks' => ItemRincianInduk::all(),
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
        // return view('categories.index', [
        //     'active' => 'pages.induk.tambah_induk_item',
        //     'title' => 'Tambah Item Kontrak Induk',
        //     'item_rincian_induks' => ItemRincianInduk::all()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRincianIndukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRincianIndukRequest $request)
    {
        $validatedData = $request->validate([

            'nama_kontrak' => 'required|max:250',

        ]);
        ItemRincianInduk::create($validatedData);
        return redirect('/categories')->with('success', 'Kategori Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemRincianInduk  $itemRincianInduk
     * @return \Illuminate\Http\Response
     */
    public function show(ItemRincianInduk $itemRincianInduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemRincianInduk  $itemRincianInduk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemRincianInduk = ItemRincianInduk::find($id);
        $id->put();
        return redirect('/categories')->with('success', 'has been edited');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRincianIndukRequest  $request
     * @param  \App\Models\ItemRincianInduk  $itemRincianInduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $itemRincianInduk = ItemRincianInduk::find($id);
        $itemRincianInduk->nama_kontrak = $request->input('nama_kontrak');
        $itemRincianInduk->update();

        return redirect('/categories')->with('success', 'has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemRincianInduk  $itemRincianInduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemRincianInduk $itemRincianInduk, $id)
    {
        $itemRincianInduk = ItemRincianInduk::find($id);
        $itemRincianInduk->rincian_induks()->delete();
        $itemRincianInduk->delete();

        return redirect('/categories')->with('success', 'post has been deleted');
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $itemRincianInduk = ItemRincianInduk::where('title', 'LIKE', '%' . $search_text . '%')->with('nama_kontrak')->get();

        return view('categories.search', compact('categories'));
    }
}
