<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\ItemRincianInduk;
use App\Models\Prk;
use App\Models\Skk;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRabRequest;
use App\Http\Requests\UpdateRabRequest;
use App\Models\Khs;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\Pejabat;
use App\Models\OrderedRab;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


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
            'title' => 'PO KHS',
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
        // $kategoris = ItemRincianInduk::all();
        // $data_kategori =[];
        // foreach ($kategoris as $kategori) {            
        //     $data_kategori =  $kategori->nama_kategori;
        // }

        // $items = RincianInduk::all();
        $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan')->get();
        $data_kategori = ItemRincianInduk::select('id','khs_id','nama_kategori')->get();
        // $khs =Khs::all();

        // $data = $data_items->concat($data_kategori);
        // $data = DB::select('SELECT * FROM item_rincian_induks LEFT JOIN rincian_induks ON item_rincian_induks.id = rincian_induks.kategori_id');
        // $data = array_merge($data_items->toArray(), $data_kategori->toArray());

        // foreach ($items as $item) {            
        //     $data_items =  $item->nama_item;
        // }

        // $data =
        // [
        //     'active1' => 'Buat KHS',
        //     'title' => 'Kontrak Harga Satuan (KHS)',
        //     'title1' => 'KHS',
        //     'active' => 'KHS',
        //     'skks' => Skk::all(),
        //     'prks' => Prk::all(),
        //     'categories' => ItemRincianInduk::all(),
        //     'items' => RincianInduk::all(),
        //     'kontraks' => KontrakInduk::all(),
        //     'pejabats' => Pejabat::all(),
        // ];

        // return view('rab.create')->with($data);


        return view(
            'rab.create',
            [
                'active1' => 'Buat PO-KHS',
                'title' => 'Kontrak Harga Satuan (KHS)',
                'title1' => 'PO-KHS',
                'active' => 'PO-KHS',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'categories' => ItemRincianInduk::all(),
                'items' => RincianInduk::all(),
                'kontraks' => KontrakInduk::all(),
                'pejabats' => Pejabat::all(),
                'khs' => Khs::all(),
            ], compact('data_kategori', 'data_items')
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

    public function export_pdf_khs($id)
    {
        $values_pdf_page1 = Rab::where('id', $id)->get();
        $rab_id = Rab::where('id', $id)->get(['rab_id']);
        // $values_pdf_page2 = OrderedRab::where('rab_id', $rab_id)->get();
        $pdf = Pdf::loadView('pdf.kontrak', [
            "value" => $values_pdf_page1,
            // "orderedrabs" => $values_pdf_page2,
        ]);
        return $pdf->download('po_khs.pdf');
    }


    
}
