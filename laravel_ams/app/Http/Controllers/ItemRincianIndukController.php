<?php

namespace App\Http\Controllers;

use App\Models\ItemRincianInduk;
use App\Models\RincianInduk;
use App\Http\Requests\StoreItemRincianIndukRequest;
use App\Http\Requests\UpdateItemRincianIndukRequest;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class ItemRincianIndukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
             $kontraks = ItemRincianInduk::where('nama_kontrak','LIKE','%'.$request->search. '%');
        }

       

        $kontraks = ItemRincianInduk::orderBy('id', 'DESC')->get();
    
        return view('categories.index', [
            'title' => 'Kategori Kontrak Induk',
            'active' => 'Kategori Kontrak Induk',
            'active1' => 'Kategori Kontrak Induk',
            'kontraks' => compact('kontraks'),
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
        // return 'Joss';
        $itemRincianInduk = ItemRincianInduk::find($id);
        // $id->put();
        return response()->json(['result' => $itemRincianInduk]);

        // return redirect('/categories')->with('success', 'has been edited');
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

        return response()->json(['status' => 'Post has been edited!']);
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

        return response()->json(['status' => 'Post has been deleted!']);
    }

    public function categoriessearch(Request $request)
    {
        $datas = ItemRincianInduk::select('nama_kontrak')->where("nama_kontrak", "LIKE", "%{$request->terms}%")->get();
        return response()->json($datas);
    }
    

}
