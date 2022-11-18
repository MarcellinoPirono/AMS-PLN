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
use App\Models\OrderKhs;
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
        $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan_id')->get();
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
        // dd($request);
        $request->validate([
            'nomor_po' => 'required|max:250',
            'tanggal_po' => 'required|max:250',
            'skk_id' => 'required|max:250',
            'prk_id' => 'required|max:250',
            'pekerjaan' => 'required|max:250',
            'lokasi' => 'required|max:250',
            'startdate' => 'required|max:250',
            'enddate' => 'required|max:250',
            'nomor_kontrak_induk' => 'required|max:250',
            'addendum_id' => 'required|max:250',
            'pejabat_id' => 'required|max:250',
            'pengawas' => 'required|max:250',
            'total_harga' => 'required|max:250',
            'kategori_order' => 'required|max:250',
            'item_order' => 'required|max:250',
            'satuan_id' => 'required|max:250',
            'harga_satuan' => 'required|max:250',
            'volume' => 'required|max:250',
            'jumlah_harga' => 'required|max:250',
        ]);

        $rab = [
            'nomor_po' => $request->nomor_po,
            'tanggal_po' => $request->tanggal_po,
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'pekerjaan' => $request->pekerjaan,
            'lokasi' => $request->lokasi,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'nomor_kontrak_induk' => $request->nomor_kontrak_induk,
            'addendum_id' => $request->addendum_id,
            'pejabat_id' => $request->pejabat_id,
            'pengawas' => $request->pengawas,
            'total_harga' => $request->total_harga,
        ];

        Rab::create($rab);

        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;

        $rab_id = [];

        for($i=0; $i<$total_tabel; $i++)
        {
            $rab_id[$i]=$id;
        }

        for($j=0; $j<$total_tabel; $j++)
        {
            $order_khs = [
                'rab_id' => $rab_id[$j],
                'kategori_order' => $request->kategori_order[$j],
                'item_order' => $request->item_order[$j],
                'satuan_id' => $request->satuan_id[$j],
                'harga_satuan' => $request->harga_satuan[$j],
                'volume' => $request->volume[$j],
                'jumlah_harga' => $request->jumlah_harga[$j],
            ];
            OrderKhs::create($order_khs);
        }

        return redirect('/po-khs')->with('status', 'PO KHS Berhasil Ditambah!');

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
