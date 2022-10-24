<?php

namespace App\Http\Controllers;

use App\Models\ItemRincianInduk;
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
            'item_rincian_induks' => ItemRincianInduk::all()
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
    public function edit(Request $request, ItemRincianInduk $itemRincianInduk)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRincianIndukRequest  $request
     * @param  \App\Models\ItemRincianInduk  $itemRincianInduk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRincianIndukRequest $request, ItemRincianInduk $itemRincianInduk)
    {
        $rules = [

            'nama_kontrak' => 'required|max:250'

        ];

        $validatedData = $request->validate($rules);
        ItemRincianInduk::where('id', $itemRincianInduk->id)->update($validatedData);
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

        return redirect('/categories')->with('success', 'Data berhasil dihapus!');

        // ItemRincianInduk::destroy($itemRincianInduk->id);
        // return redirect('/categories')->with('success', 'post has been deleted');
    }
}
