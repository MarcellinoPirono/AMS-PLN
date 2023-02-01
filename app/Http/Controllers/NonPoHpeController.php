<?php

namespace App\Http\Controllers;

use App\Models\Hpe;
use App\Models\User;
use App\Models\RabHpe;
use App\Models\NonPo;
use App\Models\RabNonPo;
use App\Models\RedaksiNotaDinas;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\PpnModel;
use App\Models\Pejabat;
use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use App\Models\Rab;
use App\Models\Ppn;
use App\Http\Controllers\CetakNonTkdnController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Riskihajar\Terbilang\Facades\Terbilang;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NonPoHpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('non_po_hpe.index', [
            'title' => 'HPE',
            'title1' => 'HPE',
            'nonpos' => NonPO::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function buat_non_po_hpe(Request $request)
    {
        $id = NonPo::where('slug', $request->slug)->value('id');

        $nonpo_id = $id;
        $jumlah_harga = RabNonPO::where('non_po_id', $nonpo_id)->sum("jumlah_harga");
        $ppn_default = PpnModel::all();
        $ppn = ($ppn_default[0]->ppn / 100) * $jumlah_harga;
        $total_harga = $jumlah_harga + $ppn;

        return view('non_po_hpe.buat_non_po_hpe',[
                'active1' => 'Buat HPE-Non-PO ',
                'title' => 'Non Purchase Order HPE',
                'title1' => 'Non-PO HPE',
                'active' => 'Non-PO HPE',
                'jumlah_harga' => $jumlah_harga,
                'ppn_nonpo' => $ppn,
                'total_harga' => $total_harga,
                'non_po_id' => $nonpo_id,
                'nonpos'=> NonPo::where('id', $nonpo_id)->get(),
                'lampiran'=> NonPo::find($nonpo_id),
                'rabnonpos'=> RabNonPO::where('non_po_id', $nonpo_id)->get(),
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'redaksis' => RedaksiNotaDinas::all(),
                'pejabats' => Pejabat::all(),
                'ppn' => $ppn_default,
                'user_id'=> User::find(Auth::id())->value('id'),
        ]);
    }

    public function simpan_non_po_hpe(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'nomor_rpbj' => 'required|max:250',
        //     'pekerjaan' => 'required|max:250',
        //     'skk_id' => 'required|max:250',
        //     'prk_id' => 'required|max:250',
        //     'supervisor' => 'required|max:250',
        //     'pejabat_id' => 'required|max:250',
        //     'total_harga' => 'required|max:250',
        //     'kak' => 'required|mimes:pdf',
        //     'uraian' => 'required|max:250',
        //     'satuan' => 'required|max:250',
        //     'harga_satuan' => 'required|max:250',
        //     'volume' => 'required|max:250',
        //     'jumlah_harga' => 'required|max:250',
        // ]);

        $non_po_id = $request->non_po_id;
        $nama_pdf = NonPo::where('id', $non_po_id)->value("nomor_rpbj");
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);
        // $nama_pdf = $nama_pdf;


        $mypdf = 'storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'_HPE.pdf';
        $status = "Waiting List";
        // Buat HPE
        $non_po_hpe = [
            // 'user_id' => $request->user_id,
            // 'id' => $non_po_id,
            'total_harga_hpe' => $request->total_harga_hpe,
            'status' => $status,
            'pdf_file' => $mypdf
        ];
        NonPO::where('id', $non_po_id)->update($non_po_hpe);

        //Edit Status Non-PO

        // NonPo::where('id', $non_po_id)->update(array('status' => $status));

        // $id = NonPO::where('non_po_id', $non_po_id)->value('id');

        // $hpe_id = [];
        // $rab_non_po_id = [];

        // $banyak_data = count($request->harga_perkiraan);
        $item_rab_non_po = RabNonPo::where('non_po_id', $non_po_id)->get();

        // for ($i = 0; $i < count($item_rab_non_po); $i++) {
        //     $hpe_id[$i] = $id;
        //     $rab_non_po_id[$i] = $item_rab_non_po[$i]->id;
        // }
        // dd($rab_non_po_id);

        for ($j = 0; $j < count($item_rab_non_po); $j++) {
            $rab_non_pos = [
                // 'hpe_id' => $hpe_id[$j],
                // 'rab_non_po_id' => $rab_non_po_id[$j],
                'harga_perkiraan' => $request->harga_perkiraan[$j],
                'jumlah_harga_perkiraan' => $request->jumlah_harga_perkiraan[$j],
            ];
            RabNonPO::where('id', $item_rab_non_po[$j]->id)->update($rab_non_pos);
        }

        // dd($rab_non_po);




        // $non_po_id = NonPo::where('id', $id)->value('id');
        // $hpe_id = NonPO::where('non_po_id', $non_po_id)->value('id');
        // $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();
        // $rab_non_po_id = RabNonPo::where('non_po_id', $non_po_id)->get();
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $path1 = 'newFileName.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        // $pdf2 = Pdf::loadView('layouts.nota_dinas',[
        //     "non_po" => $values_pdf_page1,
        //     "rab_non_po" => $values_pdf_page2,
        //     "jumlah" => $jumlah,
        //     "ppn" => $ppn,
        //     // "days" => $days,
        //     // "jabatan_manager" => $jabatan_manager,
        //     // "nama_manager" => $nama_manager,
        //     "title" => $ubah_pdf2,

        // ]);

        // $pdf2->setPaper('A4', 'potrait');

        // $dom_pdf2 = $pdf2->getDomPDF();
        // $canvas2 = $dom_pdf2->get_canvas();
        // $this->pageNumber($canvas2, $lang);
        // Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE.pdf');




        (new CetakNonTkdnController)->update_skk_prk($request->skk_id, $request->prk_id);
        //Update PRK 1
        // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        // Update PRK Terkontrak
        // $updated_prk_terkontrak = 0;
        // $previous_prk_terkontrak = NonPo::where('prk_id', $request->prk_id)->get('total_harga');
        // foreach ($previous_prk_terkontrak as $prk_terkontrak)
        //     $updated_prk_terkontrak += (float)$prk_terkontrak->total_harga;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak' => (float)$updated_prk_terkontrak));

        // //Update PRK Sisa
        // $pagu_prk = Prk::where('id', $request->prk_id)->value('pagu_prk');
        // $prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_sisa = (float)$pagu_prk - (float)$prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_sisa' => (float)$updated_prk_sisa));

        // //Update SKK Terkontrak
        // $updated_skk_terkontrak = 0;
        // $previous_skk_terkontrak = Prk::where('no_skk_prk', $request->skk_id)->get('prk_terkontrak');
        // foreach ($previous_skk_terkontrak as $skk_terkontrak)
        //     $updated_skk_terkontrak += (float)$skk_terkontrak->prk_terkontrak;
        // Skk::where('id', $request->skk_id)->update(array('skk_terkontrak' => (float)$updated_skk_terkontrak));

        // //Update SKK Sisa
        // $pagu_skk = Skk::where('id', $request->skk_id)->value('pagu_skk');
        // $skk_terkontrak = Skk::where('id', $request->skk_id)->value('skk_terkontrak');
        // $updated_skk_sisa = (float)$pagu_skk - (float)$skk_terkontrak;
        // Skk::where('id', $request->skk_id)->update(array('skk_sisa' => (float)$updated_skk_sisa));


        return response()->json($non_po_id);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'hpe.create',
            [
                'active1' => 'Buat HPE',
                'title' => 'HPE',
                'title1' => 'HPE',
                'active' => 'HPE',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'categories' => ItemRincianInduk::all(),
                'items' => RincianInduk::all(),
                'rabs' => Rab::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function show(Hpe $hpe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function edit(Hpe $hpe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hpe $hpe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hpe $hpe)
    {
        //
    }

    public function load_view_nota_dinas_hpe($non_po_id, $nama_pdf){
        $values_pdf_page1 = NonPO::where('id', $non_po_id)->get();
        $values_pdf_page2 = RabNonPO::where('non_po_id', $non_po_id)->get();
        // $values_pdf_page3 = NonPo::where('id', $id)->get();

        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $jumlah_hpe = RabNonPO::where('non_po_id', $non_po_id)->sum('jumlah_harga_perkiraan');
        $ppn_default = PpnModel::all();
        $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        $ppn_hpe = $jumlah_hpe * ($ppn_default[0]->ppn / 100);
        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('layouts.nota_dinas_hpe',[
            "non_pos" => $values_pdf_page1,
            "rab_non_pos" => $values_pdf_page2,
            // "non_po" => $values_pdf_page3,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "jumlah_hpe" => $jumlah_hpe,
            "ppn_hpe" => $ppn_hpe,
            // "nama_manager" => $nama_manager,
            "title" => $nama_pdf,
        ]);

        return $pdf;
    }

    public function getDeskripsi(Request $request){
        $redaksi_id = $request->post('redaksi_id');

        // dd($redaksi_id);
        $deskripsi_redaksi = RedaksiNotaDinas::where('id', $redaksi_id)->value('deskripsi_redaksi');

        $deskripsi = DB::table('redaksi_nota_dinas')->where('deskripsi_redaksi', $deskripsi_redaksi)->first();
        // dd($deskripsi);

        return response()->json($deskripsi);
    }
}
