<?php

namespace App\Http\Controllers;

use App\Models\RabHpe;
use App\Models\NonPo;
use App\Models\RabNonPo;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\RincianInduk;
use App\Models\Pejabat;
use App\Models\RedaksiNotaDinas;
use App\Models\ItemRincianInduk;
use App\Models\Rab;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Riskihajar\Terbilang\Facades\Terbilang;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Http\Request;

class HpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hpe.hpe', [
            'title' => 'HPE',
            'title1' => 'HPE',
            // 'nonpos'=> NonPo::all(),
            'hpes' => NonPo::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function buat_non_po_hpe(Request $request)
    {
        dd($redaksis);

        $nonpo_id = $request->id;
        $jumlah_harga = RabNonPo::where('non_po_id', $nonpo_id)->sum("jumlah_harga");
        $ppn = 0.11 * $jumlah_harga;
        $total_harga = $jumlah_harga + $ppn;

        $redaksis = RedaksiNotaDinas::all();

        return view('hpe.buat_non_po_hpe',[
                'active1' => 'Buat HPE-Non-PO ',
                'title' => 'Non Purchase Order HPE',
                'title1' => 'Non-PO HPE',
                'active' => 'Non-PO HPE',
                'jumlah_harga' => $jumlah_harga,
                'ppn' => $ppn,
                'total_harga' => $total_harga,
                'non_po_id' => $nonpo_id,
                'nonpos'=> NonPo::where('id', $nonpo_id)->get(),
                'rabnonpos'=> RabNonPo::where('non_po_id', $nonpo_id)->get(),
                'skks' => Skk::all(),
                'redaksis' => RedaksiNotaDinas::all(),
                'prks' => Prk::all(),
                'pejabats' => Pejabat::all(),
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

        // $file = $request->file('kak')->getClientOriginalName();
        // // dd($file);
        // $filename = 'NAMAAFILEE'.$file->getClientOriginalName();
        // // File extension
        // $extension = $file->getClientOriginalExtension();

        // // File upload location
        // // $location = 'public/storage/non-po/';
        // Storage::put('public/storage/file-pdf-khs/non-po/'.$filename.'', $file);

        // dd($filepath2);

        // Upload file
        // $file->move($location,$filename);
        // $content = $file->getOriginalContent();
        // Storage::put('public/storage/file-pdf-khs/'.$filename.'.pdf',$content);
        // File path
        // $filepath = 'public/storage/file-pdf-khs/non-po/'.$filename;

        // dd($filepath);

        $non_po_id = $request->non_po_id;
        // dd($non_po_id);
        $nama_pdf = NonPo::where('id', $non_po_id)->value("nomor_rpbj");
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);


        $mypdf = 'storage/storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf';

        $non_po_hpe = [
            'non_po_id' => $non_po_id,
            'total_harga_hpe' => $request->total_harga,
        ];
        NonPo::create($non_po_hpe);

        $id = NonPo::where('non_po_id', $non_po_id)->value('id');

        $hpe_id = [];
        $rab_non_po_id = [];

        // $banyak_data = count($request->harga_perkiraan);
        $item_rab_non_po = RabNonPo::where('non_po_id', $non_po_id)->get();

        for ($i = 0; $i < count($item_rab_non_po); $i++) {
            $hpe_id[$i] = $id;
            $rab_non_po_id[$i] = $item_rab_non_po[$i]->id;
        }
        // dd($rab_non_po_id);

        for ($j = 0; $j < count($item_rab_non_po); $j++) {
            $rab_hpe = [
                'hpe_id' => $hpe_id[$j],
                'rab_non_po_id' => $rab_non_po_id[$j],
                'harga_perkiraan' => $request->harga_perkiraan[$j],
                'jumlah_harga_perkiraan' => $request->jumlah_harga_perkiraan[$j],
            ];
            RabNonPo::create($rab_hpe);
        }

        // dd($rab_non_po);

        // $values_pdf_page1 = NonPo::where('id', $id)->get();

        // $non_po_id = NonPo::where('id', $id)->value('id');
        // $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();

        // $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        // $ppn = $jumlah * 0.11;
        // // dd($values_pdf_page1);

        // $pdf = Pdf::loadView('layouts.nota_dinas',[
        //     "non_po" => $values_pdf_page1,
        //     "rab_non_po" => $values_pdf_page2,
        //     "jumlah" => $jumlah,
        //     "ppn" => $ppn,
        //     // "days" => $days,
        //     // "jabatan_manager" => $jabatan_manager,
        //     // "nama_manager" => $nama_manager,
        //     "title" => $ubah_pdf2,

        // ]);

        // // $dom_pdf1 = $pdf->getDomPDF();
        // // $canvas = $dom_pdf1->get_canvas();
        // // $this->pageNumber($canvas, $lang);
        // $path1 = 'newFileName.pdf';
        // Storage::disk('local')->put($path1, $pdf->output());

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

        // $pdf2->setPaper('A4', 'landscape');

        // // $dom_pdf2 = $pdf2->getDomPDF();
        // // $canvas2 = $dom_pdf2->get_canvas();
        // // $this->pageNumber($canvas2, $lang);
        // $path2 = 'newFileName2.pdf';
        // Storage::disk('local')->put($path2, $pdf2->output());

        // // $content = $pdf->download()->getOriginalContent();
        // // $pdfs1 = Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content);

        // // $content2 = $pdf2->download()->getOriginalContent();
        // // // Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content2);
        // // $pdfs2 = Storage::put('public/storage/file-pdf-khs/non-po/pdf2.pdf', $content2);
        // // dd($pdfs2);


        // $oMerger = PDFMerger::init();



        // $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        // $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        // $oMerger->addPDF($request->file('kak')->getPathName(), 'all');
        // // }
        // // dd($oMerger);

        // $nama_pdf = $request->nomor_rpbj;
        // $nama_pdf = str_replace('.', '_', $nama_pdf);
        // $nama_pdf = str_replace('/','-', $nama_pdf);
        // $nama_pdf = str_replace(' ','-', $nama_pdf);
        // $oMerger->merge();
        // $oMerger->save('storage/storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf');




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


        return response()->json($id);
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

    public function export_pdf_khs(Request $request, $id)
    {
        $document = NonPo::findorFail($id);
        $filePath = $document->pdf_file;

        return response()->download($filePath);
    }

    public function download(Request $request, $id)
    {
        $nama_pdf =NonPo::where('id', $id)->value('nomor_rpbj');
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        $non_po_id = NonPo::where('id', $id)->value('non_po_id');
        // $hpe_id = NonPo::where('non_po_id', $non_po_id)->value('id');
        // $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();
        // $rab_non_po_id = RabNonPo::where('non_po_id', $non_po_id)->get();
        $values_pdf_page1 = NonPo::where('id', $id)->get();
        $values_pdf_page2 = RabNonPo::where('hpe_id', $id)->get();
        $values_pdf_page3 = NonPo::where('id', $non_po_id)->get();

        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $jumlah_hpe = RabNonPo::where('hpe_id', $id)->sum('jumlah_harga_perkiraan');
        $ppn = $jumlah * 0.11;
        $ppn_hpe = $jumlah_hpe * 0.11;
        // dd($values_pdf_page1, $values_pdf_page2, $values_pdf_page3);

        $pdf = Pdf::loadView('layouts.nota_dinas_hpe',[
            "hpes" => $values_pdf_page1,
            "rab_hpes" => $values_pdf_page2,
            "non_po" => $values_pdf_page3,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "jumlah_hpe" => $jumlah_hpe,
            "ppn_hpe" => $ppn_hpe,
            // "nama_manager" => $nama_manager,
            "title" => $nama_pdf,
        ]);
        // $pdf->setPaper('A4', 'landscape');

        // $dom_pdf1 = $pdf->getDomPDF();
        // $canvas = $dom_pdf1->get_canvas();
        // $this->pageNumber($canvas, $lang);
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


        // $dom_pdf2 = $pdf2->getDomPDF();
        // $canvas2 = $dom_pdf2->get_canvas();
        // $this->pageNumber($canvas2, $lang);
        // $path2 = 'newFileName2.pdf';
        // Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE.pdf');

        return $oMerger->download();
    }
}
