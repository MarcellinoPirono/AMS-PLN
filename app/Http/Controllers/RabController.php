<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\lokasi;
use App\Models\Prk;
use App\Models\ItemRincianInduk;
use App\Models\Skk;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRabRequest;
use App\Http\Requests\UpdateRabRequest;
use App\Models\Khs;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\Pejabat;
use App\Models\Addendum;
use App\Models\Vendor;
// use App\Models\OrderedRab;
use App\Models\OrderKhs;
use App\Models\OrderRedaksiKHS;
use App\Models\PpnModel;
use App\Models\Redaksi;
use App\Models\SubRedaksi;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Cast\Double;
use Riskihajar\Terbilang\Facades\Terbilang;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

use App\Http\Controllers\PdfkhsController;

// use Carbon\Carbon
// use Carbon\Carbon;

// use Illuminate\Support\Carbon;


class RabController extends Controller
{
    // use Storage;
    // use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gate::allows('Supervisor');

        $id = auth()->user()->id;
        // dd($id);
        if(auth()->user()->role == "Supervisor") {
            return view('rab.index', [
                'title' => 'PO KHS',
                'title1' => 'RAB',
                'rabs' => Rab::orderBy('id', 'DESC')->where('user_id', $id)->get(),
                'kontraks' => Rab::get("nomor_kontrak_induk")->unique("nomor_kontrak_induk"),
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'kontrakinduks' => KontrakInduk::all(),
            ]);
        } else {
            return view('rab.index', [
                'title' => 'PO KHS',
                'title1' => 'RAB',
                'rabs' => Rab::orderBy('id', 'DESC')->get(),
                'kontraks' => Rab::get("nomor_kontrak_induk")->unique("nomor_kontrak_induk"),
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'kontrakinduks' => KontrakInduk::all(),
            ]);
        }



    }


    public function buat_po_khs()
    {
        // $ppn = PpnModel::all();
        // dd($ppn);
        $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan_id')->get();
        $data_kategori = ItemRincianInduk::select('id', 'khs_id', 'nama_kategori')->get();
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
            'rab.buat_po_khs',
            [
                'active1' => 'Buat PO-KHS',
                'title' => 'PO-KHS',
                'title1' => 'PO-KHS',
                'active' => 'PO-KHS',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'categories' => ItemRincianInduk::all(),
                'items' => RincianInduk::all(),
                'kontraks' => KontrakInduk::all(),
                'pejabats' => Pejabat::all(),
                'khs' => Khs::all(),
                'redaksis'=>Redaksi::all(),
                'ppn'=>PpnModel::all(),
            ],
            compact('data_kategori', 'data_items')
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     // $kategoris = ItemRincianInduk::all();
    //     // $data_kategori =[];
    //     // foreach ($kategoris as $kategori) {
    //     //     $data_kategori =  $kategori->nama_kategori;
    //     // }

    //     // $items = RincianInduk::all();
    //     $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan_id')->get();
    //     $data_kategori = ItemRincianInduk::select('id','khs_id','nama_kategori')->get();
    //     // $kontrak_induk_id = KontrakInduk::select('id')->get();
    //     // $latest_addendum = Addendum::groupBy('kontrak_induk_id')->latest('tanggal_addendum')->get();
    //     // $khs =Khs::all();

    //     // $data = $data_items->concat($data_kategori);
    //     // $data = DB::select('SELECT * FROM item_rincian_induks LEFT JOIN rincian_induks ON item_rincian_induks.id = rincian_induks.kategori_id');
    //     // $data = array_merge($data_items->toArray(), $data_kategori->toArray());

    //     // foreach ($items as $item) {
    //     //     $data_items =  $item->nama_item;
    //     // }

    //     // $data =
    //     // [
    //     //     'active1' => 'Buat KHS',
    //     //     'title' => 'Kontrak Harga Satuan (KHS)',
    //     //     'title1' => 'KHS',
    //     //     'active' => 'KHS',
    //     //     'skks' => Skk::all(),
    //     //     'prks' => Prk::all(),
    //     //     'categories' => ItemRincianInduk::all(),
    //     //     'items' => RincianInduk::all(),
    //     //     'kontraks' => KontrakInduk::all(),
    //     //     'pejabats' => Pejabat::all(),
    //     // ];

    //     // return view('rab.create')->with($data);


    //     return view(
    //         'rab.create',
    //         [
    //             'active1' => 'Buat PO-KHS',
    //             'title' => 'Kontrak Harga Satuan (KHS)',
    //             'title1' => 'PO-KHS',
    //             'active' => 'PO-KHS',
    //             'skks' => Skk::all(),
    //             'prks' => Prk::all(),
    //             'categories' => ItemRincianInduk::all(),
    //             'items' => RincianInduk::all(),
    //             'kontraks' => KontrakInduk::all(),
    //             'pejabats' => Pejabat::all(),
    //             'khs' => Khs::all(),
    //             // 'latest_addendum' => $latest_addendum
    //         ], compact('data_kategori', 'data_items')
    //     );
    // }



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
    // public function store(StoreRabRequest $request)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'nomor_po' => 'required|max:250',
    //         'tanggal_po' => 'required|max:250',
    //         'skk_id' => 'required|max:250',
    //         'prk_id' => 'required|max:250',
    //         'pekerjaan' => 'required|max:250',
    //         'lokasi' => 'required|max:250',
    //         'startdate' => 'required|max:250',
    //         'enddate' => 'required|max:250',
    //         'nomor_kontrak_induk' => 'required|max:250',
    //         'addendum_id' => 'required|max:250',
    //         'pejabat_id' => 'required|max:250',
    //         'pengawas' => 'required|max:250',
    //         'total_harga' => 'required|max:250',
    //         'kategori_order' => 'required|max:250',
    //         'item_order' => 'required|max:250',
    //         'satuan_id' => 'required|max:250',
    //         'harga_satuan' => 'required|max:250',
    //         'volume' => 'required|max:250',
    //         'jumlah_harga' => 'required|max:250',
    //     ]);

    //     $rab = [
    //         'nomor_po' => $request->nomor_po,
    //         'tanggal_po' => $request->tanggal_po,
    //         'skk_id' => $request->skk_id,
    //         'prk_id' => $request->prk_id,
    //         'pekerjaan' => $request->pekerjaan,
    //         'lokasi' => $request->lokasi,
    //         'startdate' => $request->startdate,
    //         'enddate' => $request->enddate,
    //         'nomor_kontrak_induk' => $request->nomor_kontrak_induk,
    //         'addendum_id' => $request->addendum_id,
    //         'pejabat_id' => $request->pejabat_id,
    //         'pengawas' => $request->pengawas,
    //         'total_harga' => $request->total_harga,
    //     ];

    //     Rab::create($rab);

    //     $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

    //     $total_tabel = $request->click;

    //     $rab_id = [];

    //     for($i=0; $i<$total_tabel; $i++)
    //     {
    //         $rab_id[$i]=$id;
    //     }

    //     for($j=0; $j<$total_tabel; $j++)
    //     {
    //         $order_khs = [
    //             'rab_id' => $rab_id[$j],
    //             'kategori_order' => $request->kategori_order[$j],
    //             'item_order' => $request->item_order[$j],
    //             'satuan_id' => $request->satuan_id[$j],
    //             'harga_satuan' => $request->harga_satuan[$j],
    //             'volume' => $request->volume[$j],
    //             'jumlah_harga' => $request->jumlah_harga[$j],
    //         ];
    //         OrderKhs::create($order_khs);
    //     }

    //     //Update PRK 1
    //     // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
    //     // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
    //     // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

    //     // Update PRK 2
    //     $updated_prk_terkontrak = 0;
    //     $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
    //     foreach($previous_prk_terkontrak as $prk_terkontrak)
    //         $updated_prk_terkontrak += (Double)$prk_terkontrak->total_harga;
    //     Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

    //     //Update SKK
    //     $updated_skk_terkontrak = 0;
    //     $previous_skk_terkontrak = Prk::where('no_skk_prk', $request->skk_id)->get('prk_terkontrak');
    //     foreach($previous_skk_terkontrak as $skk_terkontrak)
    //         $updated_skk_terkontrak += (Double)$skk_terkontrak->prk_terkontrak;
    //     Skk::where('id', $request->skk_id)->update(array('skk_terkontrak'=>(Double)$updated_skk_terkontrak));


    //     return redirect('/po-khs')->with('status', 'PO KHS Berhasil Ditambah!');

    // }{{  }}{{  }}
    public function simpan_po_khs(StoreRabRequest $request)
    {
        // dd($request);
        $request->validate([
            'nomor_po' => 'required|unique:rabs|max:250',
            'tanggal_po' => 'required|max:250',
            'skk_id' => 'required|max:250',
            'prk_id' => 'required|max:250',
            'pekerjaan' => 'required|max:250',
            'lokasi' => 'nullable|max:250',
            'startdate' => 'required|max:250',
            'enddate' => 'required|max:250',
            'nomor_kontrak_induk' => 'required|max:250',
            'addendum_id' => 'nullable|max:250',
            'pejabat_id' => 'required|max:250',
            'pengawas' => 'required|max:250',
            'total_harga' => 'required|max:250',
            'kategori_order' => 'required|max:250',
            'item_order' => 'required|max:250',
            'satuan_id' => 'required|max:250',
            'harga_satuan' => 'required|max:250',
            'volume' => 'required|max:250',
            'jumlah_harga' => 'required|max:250',
            // 'jumlah_harga' => 'required',
        ]);



        $addendum_id = Addendum::where('nomor_addendum', $request->addendum_id)->value('id');

        $nama_pdf = $request->nomor_po;
        $ubah_pdf = str_replace('.', '_', $nama_pdf);
        $ubah_pdf2 = str_replace('/','-', $ubah_pdf);
        $ubah_pdf2 = str_replace(' ','-', $ubah_pdf);


        $mypdf = 'public/storage/file-pdf-khs/'.$ubah_pdf2.'.pdf';

        $rab = [
            'nomor_po' => $request->nomor_po,
            'tanggal_po' => $request->tanggal_po,
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'pekerjaan' => $request->pekerjaan,
            // 'lokasi' => $request->lokasi,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'nomor_kontrak_induk' => $request->nomor_kontrak_induk,
            'addendum_id' => $addendum_id,
            'pejabat_id' => $request->pejabat_id,
            'pengawas_pekerjaan' => $request->pengawas,
            'total_harga' => $request->total_harga,
            'pdf_file' =>$mypdf,
        ];

        Rab::create($rab);
        // dd($rab);

        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;


        $rab_id = [];
        $satuan_id = [];

        for ($i = 0; $i < $total_tabel; $i++) {
            $rab_id[$i] = $id;
            $satuan_id[$i] = Satuan::where('kepanjangan', $request->satuan_id[$i])->value('id');
        }

        for ($j = 0; $j < $total_tabel; $j++) {
            $order_khs = [
                'rab_id' => $rab_id[$j],
                'kategori_order' => $request->kategori_order[$j],
                'item_order' => $request->item_order[$j],
                'satuan_id' => $satuan_id[$j],
                'harga_satuan' => $request->harga_satuan[$j],
                'volume' => $request->volume[$j],
                'jumlah_harga' => $request->jumlah_harga[$j],
            ];
            OrderKhs::create($order_khs);
        }


        $redaksi_click = $request->clickredaksi;
        for ($i = 0; $i < $redaksi_click; $i++) {
            $rab_id[$i] = $id;
        }
        for ($j = 0; $j < $redaksi_click; $j++) {
            $order_redaksi = [
                'rab_id' => $rab_id[$j],
                'redaksi_id' => $request->redaksi_id[$j],
                'deskripsi_id' => $request->deskripsi_id[$j],
                'sub_deskripsi_id' => $request->sub_deskripsi_id[$j],
            ];
            OrderRedaksiKHS::create($order_redaksi);
        }

        $lokasi_click = $request->clicklokasi;
        for ($i = 0; $i < $lokasi_click; $i++) {
            $rab_id[$i] = $id;
        }
        for ($j = 0; $j < $lokasi_click; $j++) {
            $order_lokasi = [
                'rab_id' => $rab_id[$j],
                'nama_lokasi' => $request->lokasi[$j],

            ];
            lokasi::create($order_lokasi);
        }



        $redaksis = OrderRedaksiKHS::where('rab_id', $rab_id)->get();
        $lokasis = lokasi::where('rab_id', $rab_id)->get();
        // dd($redaksis);

        $values_pdf_page1 = Rab::where('id', $id)->get();

        $startdate = Rab::where('id', $id)->value('startdate');
        $enddate = Rab::where('id', $id)->value('enddate');
        $datetime1 = new DateTime($startdate);
        $datetime2 = new DateTime($enddate);
        $interval = new DatePeriod($datetime1, new DateInterval('P1D'), $datetime2);
        $d = 0;
        $days = 0;
        $datetime2 = 1;

        foreach($interval as $date) {
            $interval = $date->format("Y-m-d");
            $datetime = DateTime::createFromFormat('Y-m-d', $interval);

            $day = $datetime->format('D');

            if($day != "Sun" && $day != "Sat") {
                $days += $datetime2 - $d;
            }

            $datetime2++;
            $d++;
        }

        $rab_id = Rab::where('id', $id)->value('id');
        $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id)->get();

        $jasa = [];
        $jasa_volume = [];
        $ubah_volume_jasa = [];
        $material = [];
        $material_volume = [];
        $ubah_volume_material = [];

        for($i = 0; $i < count($values_pdf_page2); $i++) {
            if($values_pdf_page2[$i]->kategori_order == "Jasa") {
                $jasa[$i] = $values_pdf_page2[$i];
                $jasa_volume[$i] = $jasa[$i]->volume;
                $ubah_volume_jasa[$i] = str_replace(".", ",", "$jasa_volume[$i]");
                $jasa[$i]->volume = $ubah_volume_jasa[$i];
                // $jasa[$i]->volume = str_replace()
            } else {
                $material[$i] = $values_pdf_page2[$i];
                $material_volume[$i] = $material[$i]->volume;
                $ubah_volume_material[$i] = str_replace(".", ",", "$material_volume[$i]");
                $material[$i]->volume = $ubah_volume_material[$i];
            }
        }
        // dd($jasa);
        // $jabatan = Pejabat::select('jabatan');

        $jabatan_manager = Pejabat::where('jabatan', 'Manager UP3')->value('jabatan');
        $nama_manager = Pejabat::where('jabatan', 'Manager UP3')->value('nama_pejabat');

        $jumlah = OrderKhs::where('rab_id', $rab_id)->sum('jumlah_harga');
        $ppn = $jumlah * 0.11;


        $pdf = Pdf::loadView('layouts.surat',[
            "po_khs" => $values_pdf_page1,
            "kategori_jasa" => $jasa,
            "kategori_material" => $material,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "days" => $days,
            "jabatan_manager" => $jabatan_manager,
            "nama_manager" => $nama_manager,
            "title" => $ubah_pdf2,
            "redaksis" => $redaksis,
            "lokasis" => $lokasis,
        ]);

        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/storage/file-pdf-khs/'.$ubah_pdf2.'.pdf',$content);

        $updated_prk_terkontrak = 0;
        $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
        foreach ($previous_prk_terkontrak as $prk_terkontrak)
            $updated_prk_terkontrak += (float)$prk_terkontrak->total_harga;
        Prk::where('id', $request->prk_id)->update(array('prk_terkontrak' => (float)$updated_prk_terkontrak));

        //Update PRK Sisa
        $pagu_prk = Prk::where('id', $request->prk_id)->value('pagu_prk');
        $prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        $updated_prk_sisa = (float)$pagu_prk - (float)$prk_terkontrak;
        Prk::where('id', $request->prk_id)->update(array('prk_sisa' => (float)$updated_prk_sisa));

        //Update SKK Terkontrak
        $updated_skk_terkontrak = 0;
        $previous_skk_terkontrak = Prk::where('no_skk_prk', $request->skk_id)->get('prk_terkontrak');
        foreach ($previous_skk_terkontrak as $skk_terkontrak)
            $updated_skk_terkontrak += (float)$skk_terkontrak->prk_terkontrak;
        Skk::where('id', $request->skk_id)->update(array('skk_terkontrak' => (float)$updated_skk_terkontrak));

        //Update SKK Sisa
        $pagu_skk = Skk::where('id', $request->skk_id)->value('pagu_skk');
        $skk_terkontrak = Skk::where('id', $request->skk_id)->value('skk_terkontrak');
        $updated_skk_sisa = (float)$pagu_skk - (float)$skk_terkontrak;
        Skk::where('id', $request->skk_id)->update(array('skk_sisa' => (float)$updated_skk_sisa));
        // $id = compact('id');
        return response()->json($id);
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
    public function edit_po_khs(Rab $rab, Request $request)
    {
        $id = $request->id;

        $rabs = Rab::findOrFail($id);
        $kontrak_induk_id = Rab::where('id', $id)->value('nomor_kontrak_induk');
        $khs_id = KontrakInduk::where('id', $kontrak_induk_id)->value('khs_id');
        $nama_item = RincianInduk::where('khs_id', $khs_id)->get();
        $order_khs = OrderKhs::where('rab_id', $id)->get();
        // dd($rabs);
        // $order_khs = OrderKhs::where('rab_id', $id)->get();
        // dd($order_khs);
        // dd($rabs);
        // $item = RincianInduk::where('khs_id', $khs_id)->get();

        return view(
            'rab.edit_po_khs',
            [
                'active1' => 'Edit PO-KHS',
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
                'redaksis' => Redaksi::all(),
                // 'rabs'=> $rabs,
                'id' => $id
            ],
            compact('order_khs', 'nama_item', 'rabs')
        );

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

    public function searchpokhs(Request $request)
    {
        $output ="";


       $rabs= Rab::where('nomor_po', 'LIKE', '%'. $request->search.'%')->orWhere('tanggal_po', 'LIKE', '%' . $request->search . '%')->orWhere('pekerjaan', 'LIKE', '%' . $request->search . '%')->get();
        // dd($prks);

       foreach($rabs as $rab){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $rab->id .'>
            <td>'. $rab->id.'</td>
            <td>'. $rab->nomor_po.'</td>
            <td>'. $rab->tanggal_po.' </td>
            <td>'. $rab->skks->nomor_skk.' </td>
            <td>'. $rab->prks->no_prk.' </td>
            <td>'. $rab->pekerjaan.' </td>
            <td>'. $rab->lokasi.' </td>
            <td>'. $rab->startdate.' </td>
            <td>'. $rab->enddate.' <td>
            <td>'. $rab->nomor_kontraks->nomor_kontrak_induk.' <td>
            <td>'. $rab->total_harga.' <td>
            <td>'. '
            <div class="dropdown">
                <button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="preview-pdf-khs/{{$rab->id}}">Preview</a>
                    <a class="dropdown-item" href="export-pdf-khs/{{ $rab->id }}">Export (pdf) <i class="bi bi-file-earmark-pdf-fill"></i></a>
                    <a class="dropdown-item" href="export-excel-khs/{{ $rab->id }}">Export (excel) <i class="bi bi-file-earmark-excel-fill"></i></a>
                </div>
            </div>
            '.'</td>
            </tr>';
       }

       return response($output);
    }

    public function export_pdf_khs(Request $request, $id)
    {
        // $document = Rab::findorFail($id);

        // $filePath = $document->pdf_file;

        // return Storage::download($filePath);

      $values_pdf_page1 = Rab::where('id', $id)->get();

        $startdate = Rab::where('id', $id)->value('startdate');
        $enddate = Rab::where('id', $id)->value('enddate');
        $datetime1 = new DateTime($startdate);
        $datetime2 = new DateTime($enddate);
        $interval = new DatePeriod($datetime1, new DateInterval('P1D'), $datetime2);
        $d = 0;
        $days = 0;
        $datetime2 = 1;

        foreach($interval as $date) {
            $interval = $date->format("Y-m-d");
            $datetime = DateTime::createFromFormat('Y-m-d', $interval);

            $day = $datetime->format('D');

            if($day != "Sun" && $day != "Sat") {
                $days += $datetime2 - $d;
            }

            $datetime2++;
            $d++;
        }
        // $days = $interval->format('%a');

        $rab_id = Rab::where('id', $id)->value('id');
        $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id)->get();
        $redaksis = OrderRedaksiKHS::where('rab_id', $rab_id)->get();
        $lokasis = lokasi::where('rab_id', $rab_id)->get();

        // dd($values_pdf_page2[0]->kategori_order);
        $jasa = [];
        $material = [];

        for($i = 0; $i < count($values_pdf_page2); $i++) {
            if($values_pdf_page2[$i]->kategori_order == "Jasa") {
                $jasa[$i] = $values_pdf_page2[$i];
            } else {
                $material[$i] = $values_pdf_page2[$i];
            }
        }

        $jabatan_manager = Pejabat::where('jabatan', 'Manager UP3')->value('jabatan');
        $nama_manager = Pejabat::where('jabatan', 'Manager UP3')->value('nama_pejabat');

        $jumlah = OrderKhs::where('rab_id', $rab_id)->sum('jumlah_harga');
        $ppn = $jumlah * 0.11;


        $pdf = Pdf::loadView('layouts.surat',[
            "po_khs" => $values_pdf_page1,
            "kategori_jasa" => $jasa,
            "kategori_material" => $material,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "days" => $days,
            "jabatan_manager" => $jabatan_manager,
            "nama_manager" => $nama_manager,
            "redaksis" => $redaksis,
            "lokasis" => $lokasis,
            "title" => 'PO-KHS (SP-APP)',
        ]);

        return $pdf->download('po_khs.pdf');

    }

    public function preview_pdf_khs($nama_pdf)
    {

        $document = Rab::where('slug', $nama_pdf)->value('pdf_file');
        // dd($document);

        $filePath = $document;

        // dd($filePath);

        // file not found
        // if (!Storage::exists($filePath)) {
        //     abort(404);
        // }

        $pdfContent = Storage::get($filePath);

        $fileName = Rab::where('slug', $nama_pdf)->value('nomor_po');
        $id = Rab::where('slug', $nama_pdf)->value('id');

        $rabs = Rab::find($id);

        $fileName = str_replace('/', '-', $fileName);
        $fileName = str_replace('.', '_', $fileName);
        $fileName = str_replace(' ', '-', $fileName);

        // dd($fileName);
        // for pdf, it will be 'application/pdf'
        $type = Storage::mimeType($filePath);
        // $fileName   = Storage::name(''.$fileName.'.pdf');

        $pdf =  Response::make($pdfContent, 200, [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="' . $fileName . '.pdf"'
        ]);


        // dd($pdf);
        // dd($filePath);

        return view('layouts.preview', [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="' . $fileName . '.pdf"',
            'filePath' => $filePath,
            'title' =>'Preview PO-KHS '.$fileName,
            'filename' => $fileName,
            'pdf' => $pdf,
            'rabs' => $rabs,
            'slug' => $nama_pdf,
            'active' => $fileName

        ]);

        // return Storage::response($filePath);





    }

    public function getAddendum(Request $request)
    {
        $kontrak_induk_id = $request->post('kontrak_induk');
        // $kontrak_induk = KontrakInduk::where('nomor_kontrak_induk', $nomor_kontrak_induk)->value('id');
        $latest_addendum = Addendum::find($kontrak_induk_id)->where('kontrak_induk_id', $kontrak_induk_id)->latest('tanggal_addendum')->latest('created_at')->get();
        return response()->json($latest_addendum);
    }

    public function getVendor(Request $request)
    {
        $kontrak_induk = $request->post('kontrak_induk');
        // dd($kontrak_induk);
        // $vendor = KontrakInduk::where('vendor_id', $request->vendor_)->where('id', $kontrak_induk)->get();
        $vendor_id = KontrakInduk::where('id', $kontrak_induk)->value('vendor_id');
        // dd($vendor_id);
        $vendor = Vendor::where('id', $vendor_id)->value('nama_vendor');
        // dd($vendor);

        return response()->json($vendor);
    }

    public function getRedaksi(Request $request){
        $redaksi = Redaksi::all();

        return response()->json($redaksi);
    }

    public function getDeskripsi(Request $request){
        $redaksi_id = $request->post('redaksi_id');

        // dd($redaksi_id);
        $deskripsi_redaksi = Redaksi::where('id', $redaksi_id)->value('deskripsi_redaksi');

        $deskripsi = DB::table('redaksis')->where('deskripsi_redaksi', $deskripsi_redaksi)->first();
        // dd($deskripsi);

        return response()->json($deskripsi);
    }


    public function getSubDeskripsi(Request $request){
        $redaksi_id = $request->post('redaksi_id');

        // dd($redaksi_id);
        $sub_deskripsi = SubRedaksi::where('redaksi_id', $redaksi_id)->get('sub_deskripsi');


        // $sub_redaksi = DB::table('sub_redaksis')->where('sub_deskripsi', $sub_deskripsi)->get();
        // dd($sub_deskripsi);

        return response()->json($sub_deskripsi);
    }

    public function checkPO(Request $request) {
        $nomor_po = $request->post('po');
        $check_nomor_po = Rab::where('nomor_po', $nomor_po)->get();

        // if(count($check_nomor_po) > 0) {
        return response()->json($check_nomor_po);
        // } else {
        //     echo json_encode(true);
        // }
    }
    public function setuju(Request $request){
        // dd($request);

        $id = Rab::where('slug', $request->slug)->value('id');
        $total_harga = Rab::where('slug', $request->slug)->value('total_harga');
        $prk_id = Rab::where('slug', $request->slug)->value('prk_id');
        $skk_id = Rab::where('slug', $request->slug)->value('skk_id');
        $status = Rab::where('slug', $request->slug)->value('status');
        $jenis_cetak = Rab::where('slug', $request->slug)->value('jenis_cetak');
        $values_pdf_page1 = Rab::where('slug', $request->slug)->get();

        $prk = Prk::where('id', $prk_id)->get();
        $skk = Skk::where('id', $skk_id)->get();

        //update prk progress
        $updated_prk_progress = (float)$prk[0]->prk_progress - (float)$total_harga;
        Prk::where('id', $prk_id)->update(array('prk_progress'=>(Double)$updated_prk_progress));

        //update skk progress
        $updated_skk_progress = (float)$skk[0]->skk_progress - (float)$total_harga;
        Skk::where('id', $skk_id)->update(array('skk_progress'=>(Double)$updated_skk_progress));

        if($request->terima == "Disetujui") {
            //update prk terkontrak
            $updated_prk_terkontrak = (float)$prk[0]->prk_terkontrak + (float)$total_harga;
            Prk::where('id', $prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

            //update skk terkontrak
            $updated_skk_terkontrak = (float)$skk[0]->skk_terkontrak + (float)$total_harga;
            Skk::where('id', $skk_id)->update(array('skk_terkontrak'=>(Double)$updated_skk_terkontrak));
        } else {
            //update prk sisa
            $updated_prk_sisa = (float)$prk[0]->prk_sisa + (float)$total_harga;
            Prk::where('id', $prk_id)->update(array('prk_sisa'=>(Double)$updated_prk_sisa));

            //update skk sisa
            $updated_skk_sisa = (float)$skk[0]->skk_sisa + (float)$total_harga;
            Skk::where('id', $skk_id)->update(array('skk_sisa'=>(Double)$updated_skk_sisa));
        }

        // $nama_pdf = Rab::where('slug', $request->slug)->value('nomor_po');
        // $nama_pdf = str_replace('.', '_', $nama_pdf);
        // $nama_pdf = str_replace('/','-', $nama_pdf);
        // $nama_pdf = str_replace(' ','-', $nama_pdf);

        // $mypdf = 'storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf';

        $rab = Rab::find($id);

        $data = [
            'status' => $request->terima,
            // 'pdf_file' => $mypdf,
        ];

        $rab->update($data);

        // $nama_pdf = $request->nomor_po;
        // $pdf = (new PdfkhsController)->load_view_redaksi_spapp($id, $id, $id, $nama_pdf);
        // $path1 = 'SPBJ.pdf';
        // Storage::disk('local')->put($path1, $pdf->output());
        // if($jenis_cetak == "tkdn"){
        //     $pdf2 = (new PdfkhsController)->load_view_rab_tkdn($id, $id, $id, $nama_pdf, $values_pdf_page1);
        //     $pdf2->setPaper('A4', 'landscape');
        //     (new PdfkhsController)->make_watermark($pdf2, $values_pdf_page1);
        //     $path2 = 'RAB.pdf';
        //     Storage::disk('local')->put($path2, $pdf2->output());

        //     $oMerger = PDFMerger::init();
        //     $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        //     $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        //     $oMerger->merge();
        //     $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf');
        // }

        // dd($rab);





        return response()->json([
            'success'   => true
        ]);


        // if($request->terima === "Disetujui"){

        // $data = [
        //     'status' => $request->acc,
        // ];

        // $rab->update($data);

        // return redirect('po-khs')->withSuccess('Po disetujui');

        // }
        // else {

        //     $data = [
        //         'status' => $request->acc,
        //     ];

        //     $rab->update($data);

        //     return redirect('po-khs')->with('error','Po Ditolak');

        // }


    }
}
