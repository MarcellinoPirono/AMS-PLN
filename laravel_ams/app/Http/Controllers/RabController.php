<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\ItemRincianInduk;
use App\Models\Prk;
use App\Models\Skk;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRabRequest;
use App\Http\Requests\UpdateRabRequest;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\Pejabat;
use Illuminate\Support\Facades\DB;


class RabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rab.index', [
            'title' => 'Rancangan Anggaran Biaya',
            'title1' => 'RAB',
            'rabs' => Rab::orderBy('id', 'DESC')->get(),
            'kontraks' => KontrakInduk::get(),
        ]);

       
    }

    public function buat_kontrak()
    {

        return view('rab.buat_kontrak', [
            'title' => 'Pilih Jenis Kontrak yang akan Dibuat',
            'title1' => 'RAB',
            'rabs' => Rab::orderBy('id', 'DESC')->get(),

        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = ItemRincianInduk::all();
        $data_kategori =[];
        foreach ($kategoris as $kategori) {            
            $data_kategori =  $kategori->nama_kategori;
        }

        $items = RincianInduk::all();
        $data_items =RincianInduk::all(['id','nama_item']);
        // foreach ($items as $item) {            
        //     $data_items =  $item->nama_item;
        // }


        return view(
            'rab.create',
            [
                'active1' => 'Buat KHS',
                'title' => 'Kontrak Harga Satuan (KHS)',
                'title1' => 'KHS',
                'active' => 'KHS',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'categories' => ItemRincianInduk::all(),
                'items' => RincianInduk::all(),
                'kontraks' => KontrakInduk::all(),
                'pejabats' => Pejabat::all(),
            ], compact('data_items', 'data_kategori')
        );
    }

    public function findPrice(Request $request)
    {

        //it will get price if its id match with product id
        $p = RincianInduk::select('harga_satuan')->where('id', $request->id)->first();

        return response()->json($p);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRabRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRabRequest $request)
    {
        $validatedData = $request->validate([

            'skk_id' => 'required|max:250',
            'prk_id' => 'required|max:250',
            'kategori_id' => 'required|max:250',
            'item_id' => 'required|max:250',
            'pekerjaan' => 'required|max:250',
            'lokasi' => 'required|max:250',
            'volume' => 'required|max:250',
            'isi_surat' => 'required|max:250'

        ]);
        Rab::create($validatedData);
        return redirect('/rab')->with('success', 'RAB Berhasil Dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function show(Rab $rab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function edit(Rab $rab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRabRequest  $request
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRabRequest $request, Rab $rab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rab  $rab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rab $rab, $id)
    {
        // $rab = Rab::find($id);
        // $rab->delete();

        // return redirect('/rab')->with('success', 'Data berhasil dihapus');
    }
    
}
