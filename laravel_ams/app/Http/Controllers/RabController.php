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
use App\Models\Addendum;
// use App\Models\OrderedRab;
use App\Models\OrderKhs;
use App\Models\Redaksi;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Cast\Double;
use Riskihajar\Terbilang\Facades\Terbilang;
use DateTime;
// use Carbon\Carbon
// use Carbon\Carbon;

// use Illuminate\Support\Carbon;


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


    public function buat_po_khs()
    {

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
                'redaksis'=>Redaksi::all(),
            ],
            compact('data_kategori', 'data_items')
        );
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
        // $kontrak_induk_id = KontrakInduk::select('id')->get();
        // $latest_addendum = Addendum::groupBy('kontrak_induk_id')->latest('tanggal_addendum')->get();
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
                // 'latest_addendum' => $latest_addendum
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

        //Update PRK 1
        // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        // Update PRK 2
        $updated_prk_terkontrak = 0;
        $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
        foreach($previous_prk_terkontrak as $prk_terkontrak)
            $updated_prk_terkontrak += (Double)$prk_terkontrak->total_harga;
        Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        //Update SKK
        $updated_skk_terkontrak = 0;
        $previous_skk_terkontrak = Prk::where('no_skk_prk', $request->skk_id)->get('prk_terkontrak');
        foreach($previous_skk_terkontrak as $skk_terkontrak)
            $updated_skk_terkontrak += (Double)$skk_terkontrak->prk_terkontrak;
        Skk::where('id', $request->skk_id)->update(array('skk_terkontrak'=>(Double)$updated_skk_terkontrak));


        return redirect('/po-khs')->with('status', 'PO KHS Berhasil Ditambah!');

    }
    public function simpan_po_khs(StoreRabRequest $request)
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

        for ($i = 0; $i < $total_tabel; $i++) {
            $rab_id[$i] = $id;
        }

        for ($j = 0; $j < $total_tabel; $j++) {
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

        //Update PRK 1
        // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        // Update PRK Terkontrak
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
        // dd($id);
        // $startdate = [];
        // $enddate = [];

        $values_pdf_page1 = Rab::where('id', $id)->get();
        // $enddate = Rab::select('enddate')->where('id', $id)->get();
        // $startdate = Rab::select('startdate')->where('id', $id)->get();

        // $startdate = DB::table('rabs')->select('startdate')->where('id', $id)->get();
        $startdate = Rab::where('id', $id)->value('startdate');
        $enddate = Rab::where('id', $id)->value('enddate');
        // $enddate = DB::table('rabs')->select('enddate')->where('id', $id)->get();
        // $startdate = $startdate->toDateTimeString();
        // $startdate = Carbon::createFromFormat('Y/m/d', $startdate)->format('Y/m/d');
        $datetime1 = new DateTime($startdate);
        // $datetime1->setTimestamp();
        $datetime2 = new DateTime($enddate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        // $startdate = Carbon::parse($startdate)->format('l');
        // $enddate = Carbon::parse($enddate)->format('l');
        // dd($days);


        // $day = $enddate - $startdate;
        // dd($day);


        // $enddate = Carbon::createFromFormat('Y-m-d', $values_pdf_page1->enddate)->format('1');

        // $enddate = Carbon::createFromFormat('Y-m-d', $enddate)->format('d-m-Y');
        // dd($enddate);
        // $startdate = strtotime($startdate);
        // $hari = $enddate - $startdate;
        // dd($hari);

        $rab_id = Rab::where('id', $id)->value('id');
        $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id)->get();
        // $rab_now = OrderKhs::where('rab_id', $rab_id)->get();


        $jabatan_manager = Pejabat::where('jabatan', 'Manager UP3')->value('jabatan');
        $nama_manager = Pejabat::where('jabatan', 'Manager UP3')->value('nama_pejabat');

        $jumlah = OrderKhs::where('rab_id', $rab_id)->sum('jumlah_harga');
        $ppn = $jumlah * 0.11;
        $pdf = Pdf::loadView('layouts.surat', [
            "po_khs" => $values_pdf_page1,
            "rab_khs" => $values_pdf_page2,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "days" => $days,
            "jabatan_manager" => $jabatan_manager,
            "nama_manager" => $nama_manager,
            "title" => "PO-KHS",

        ]);
        return $pdf->download('po_khs.pdf');
    }

    public function preview_pdf_khs($id)
    {
        // dd($id);
        $values_pdf_page1 = Rab::where('id', $id)->get();
        $enddate = Rab::select('enddate')->where('id', $id)->first();
        $startdate = Rab::select('startdate')->where('id', $id)->first();
        // $startdate = Carbon::createFromFormat('Y-m-d', $values_pdf_page1->startdate)->format('1');
        // $enddate = Carbon::createFromFormat('Y-m-d', $values_pdf_page1->enddate)->format('1');

        // $enddate = Carbon::createFromFormat('Y-m-d', $enddate)->format('d-m-Y');
        // dd($enddate);
        // $startdate = strtotime($startdate);
        // $hari = $enddate - $startdate;
        // dd($hari);

        $rab_id = Rab::where('id', $id)->value('id');
        $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id)->get();
        // $pdf = Pdf::loadView('layouts.surat', [
        //     "po_khs" => $values_pdf_page1,
        //     "rab_khs" => $values_pdf_page2,
        //     // "hari" => $hari,
        //     "title" => "PO-KHS"
        // ]);
        // return $pdf->download('po_khs.pdf');
        return view('layouts.surat',[
            "po_khs" => $values_pdf_page1,
            "rab_khs" => $values_pdf_page2,
            "title" => "PO-KHS",
        ]);
    }

    public function getAddendum(Request $request)
    {
        $kontrak_induk = $request->post('kontrak_induk');
        $latest_addendum = Addendum::find($request->kontrak_induk)->where('kontrak_induk_id', $kontrak_induk)->latest('tanggal_addendum')->latest('created_at')->get();
        return response()->json($latest_addendum);
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
}
