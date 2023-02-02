<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonPo;
use App\Models\User;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\PpnModel;
use App\Models\Pejabat;
use App\Models\RabNonPo;
use App\Models\Redaksi;
use App\Http\Controllers\CetakNonTkdnController;
use App\Http\Controllers\PdfkhsController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Riskihajar\Terbilang\Facades\Terbilang;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class NonPOController extends Controller
{
    //
    public function index()
    {
        return view('non-po.index', [
            'title' => 'Non-PO',
            'title1' => 'Non-PO',
            'nonpos' => NonPO::orderBy('id', 'DESC')->get(),
            // 'redaksis'=>Redaksi::all(),
        ]);
    }

    public function create()
    {
        return view(
            'non-po.duplicate_buat_non_po',
            [
                'active1' => 'Buat Non-PO',
                'title' => 'Non Purchase Order',
                'title1' => 'Non-PO',
                'active' => 'Non-PO',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'redaksis'=> Redaksi::all(),
                'ppn'=> PpnModel::all(),
                'user_id'=> User::find(Auth::id())->first(),
            ]
        );
    }

    public function buat_non_po()
    {
        return view('non-po.duplicate_buat_non_po',[
                'active1' => 'Buat Non-PO ',
                'title' => 'Non Purchase Order',
                'title1' => 'Non-PO',
                'active' => 'Non-PO',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'pejabats' => Pejabat::all(),
                'ppn'=> PpnModel::all(),
                'user_id'=> User::find(Auth::id())->value('id'),
        ]);
    }

    public function simpan_non_po(Request $request)
    {
        // dd($request);
        // dd($errors);
        // $request->validate([
        //     'user_id' => 'required|max:250',
        //     // 'nomor_rpbj' => 'required|unique:non_pos|max:250',
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

        $nama_pdf = $request->nomor_rpbj;
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);
        // dd($nama_pdf);


        $mypdf = 'storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf';

        $filename_kak = time().'_'.$nama_pdf.'_'.$request->file('kak')->getClientOriginalName();
        $kak = $request->file('kak')->storeAs('storage/kak-non-po', $filename_kak, 'public');

        // dd($kak);
        $filename_nota_dinas = time().'_'.$nama_pdf.'_'.$request->file('nota_dinas')->getClientOriginalName();
        $nota_dinas = $request->file('nota_dinas')->storeAs('storage/nota-dinas-non-po', $filename_nota_dinas, 'public');
        // dd($nota_dinas);
        $status = "Progress";


        $non_po = [
            'user_id' => $request->user_id,
            'nomor_rpbj' => $request->nomor_rpbj,
            'pekerjaan' => $request->pekerjaan,
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'supervisor' => $request->supervisor,
            'startdate' => $request->start_date,
            'enddate' => $request->end_date,
            'pejabat_id' => $request->pejabat_id,
            'kak' => $kak,
            'nota_dinas' => $nota_dinas,
            'total_harga' => $request->total_harga,
            'pdf_file' => $mypdf,
            'status' => $status,
            'slug' => $nama_pdf,
        ];

        NonPo::create($non_po);

        $id = NonPo::where('nomor_rpbj', $request->nomor_rpbj)->value('id');

        $total_tabel = $request->click;

        $non_po_id = [];

        for ($i = 0; $i < $total_tabel; $i++) {
            $non_po_id[$i] = $id;
        }

        // for ($j = 0; $j < $total_tabel; $j++) {
        //     dd($request->uraian[$j]);
        // }
        // dd($request->uraian);
        // dd($non_po_id);

        for ($j = 0; $j < $total_tabel; $j++) {
            $rab_non_po = [
                'non_po_id' => $non_po_id[$j],
                'uraian' => $request->uraian[$j],
                'satuan' => $request->satuan[$j],
                'harga_satuan' => $request->harga_satuan[$j],
                'volume' => $request->volume[$j],
                'jumlah_harga' => $request->jumlah_harga[$j],
            ];
            RabNonPo::create($rab_non_po);
        }

        // dd($rab_non_po);
        $ppn_default = PpnModel::all();
        // dd($ppn_default);

        $values_pdf_page1 = NonPo::where('id', $id)->get();


        $non_po_id = NonPo::where('id', $id)->value('id');
        $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();

        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('layouts.nota_dinas',[
            "non_po" => $values_pdf_page1,
            "rab_non_po" => $values_pdf_page2,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "title" => $nama_pdf,
        ]);
        (new PdfkhsController)->make_watermark($pdf, "On Progress");



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

        // $pdf2->setPaper('A4', 'potrait');

        // $dom_pdf2 = $pdf2->getDomPDF();
        // $canvas2 = $dom_pdf2->get_canvas();
        // $this->pageNumber($canvas2, $lang);
        // $path2 = 'newFileName2.pdf';
        // Storage::disk('local')->put($path2, $pdf2->output());

        // $content = $pdf->download()->getOriginalContent();
        // $pdfs1 = Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content);

        // $content2 = $pdf2->download()->getOriginalContent();
        // // Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content2);
        // $pdfs2 = Storage::put('public/storage/file-pdf-khs/non-po/pdf2.pdf', $content2);
        // dd($pdfs2);


        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf');
        // $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        // $oMerger->addPDF($request->file('kak')->getPathName(), 'all');
        // }
        // dd($oMerger);

        // $nama_pdf = $request->nomor_rpbj;
        // $nama_pdf = str_replace('.', '_', $nama_pdf);
        // $nama_pdf = str_replace('/','-', $nama_pdf);
        // $nama_pdf = str_replace(' ','-', $nama_pdf);




        //Update PRK 1
        // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        // (new CetakNonTkdnController)->update_skk_prk($request->skk_id, $request->prk_id, $status);

        // // Update PRK Terkontrak
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


        return response()->json($nama_pdf);

    }



    public function download(Request $request, $id)
    {
        // $document = NonPo::findorFail($id);

        // $filePath = $document->pdf_file;

        // // dd($filePath);

        // return Storage::download('public/'.$filePath.'');

        $nama_pdf =NonPo::where('id', $id)->value('nomor_rpbj');
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        $values_pdf_page1 = NonPo::where('id', $id)->get();

        $non_po_id = NonPo::where('id', $id)->value('id');
        $status = NonPo::where('id', $id)->value('status');
        $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();
        $ppn_default = PpnModel::all();

        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('layouts.nota_dinas',[
            "non_po" => $values_pdf_page1,
            "rab_non_po" => $values_pdf_page2,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "title" => $nama_pdf,
        ]);
        (new PdfkhsController)->make_watermark($pdf, $status);

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

        // $pdf->setPaper('A4', 'potrait');

        // $dom_pdf2 = $pdf2->getDomPDF();
        // $canvas2 = $dom_pdf2->get_canvas();
        // $this->pageNumber($canvas2, $lang);
        // $path2 = 'newFileName2.pdf';
        // Storage::disk('local')->put($path2, $pdf2->output());

        // $content = $pdf->download()->getOriginalContent();
        // $pdfs1 = Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content);

        // $content2 = $pdf2->download()->getOriginalContent();
        // // Storage::put('public/storage/file-pdf-khs/non-po/'.$ubah_pdf2.'.pdf',$content2);
        // $pdfs2 = Storage::put('public/storage/file-pdf-khs/non-po/pdf2.pdf', $content2);
        // dd($pdfs2);


        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf');
        return $oMerger->download();
    }

    public function checkNotaDinas(Request $request) {
        $nota_dinas = $request->post('nota_dinas');
        $check_nota_dinas = NonPo::where('nomor_rpbj', $nota_dinas)->get();

        return response()->json($check_nota_dinas);
    }

    public function preview_non_po($nama_pdf)
    {

        $document = NonPo::where('slug', $nama_pdf)->value('pdf_file');

        $filePath = $document;

        $fileName = NonPo::where('slug', $nama_pdf)->value('nomor_rpbj');
        $id = NonPo::where('slug', $nama_pdf)->value('id');

        $rabs = NonPo::find($id);

        $fileName = str_replace('/', '-', $fileName);
        $fileName = str_replace('.', '_', $fileName);
        $fileName = str_replace(' ', '-', $fileName);



        return view('non-po.preview_non_po', [
            'title' =>'Preview NON-PO '.$fileName,
            'filename' => $fileName,
            'rabs' => $rabs,
            'slug' => $nama_pdf,
            'active' => $fileName

        ]);


    }

    public function download_nonpo($nama_pdf)
    {
        // dd($nama_pdf);

        $status = NonPo::where('slug', $nama_pdf)->value('status');
        $document = NonPo::where('slug', $nama_pdf)->value('pdf_file');
        // dd($status);

        if ($status === "Disetujui"){


            return Storage::download('public/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'.pdf');
        }
        else if ($status === "Ditolak"){


            return Storage::download('public/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_ditolak.pdf');
        }
        else{

            return  Storage::download('public/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_onprogress.pdf');
        }
    }



}
