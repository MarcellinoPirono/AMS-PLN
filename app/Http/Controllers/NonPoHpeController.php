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
use App\Models\Tembusan;
use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use App\Models\Rab;
use App\Models\Ppn;
use App\Http\Controllers\CetakNonTkdnController;
use App\Http\Controllers\PdfkhsController;
use App\Models\OrderSuratDinas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Riskihajar\Terbilang\Facades\Terbilang;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Cast\Double;





class NonPoHpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;

        if (auth()->user()->role === "REN"){

            return view('non_po_hpe.index', [
                'title' => 'HPE',
                'title1' => 'HPE',
                'nonpos' => NonPo::orderBy('id', 'DESC')->where('user_id', $id)->where('status', 'Waiting List')->get(),
            ]);
        }

        else {
            return view('non_po_hpe.index', [
                'title' => 'HPE',
                'title1' => 'HPE',
                'nonpos' => NonPo::orderBy('id', 'DESC')->where('status', 'Waiting List')->get(),
            ]);

        }
    }

    public function buat_non_po_hpe(Request $request)
    {
        // dd($request);
        // dd($request->tembusan);

        $id = NonPo::where('slug', $request->slug)->value('id');

        $nonpo_id = $id;
        $jumlah_harga = RabNonPO::where('non_po_id', $nonpo_id)->sum("jumlah_harga");
        $ppn_default = PpnModel::all();
        $ppn = ($ppn_default[0]->ppn / 100) * $jumlah_harga;
        $total_harga = $jumlah_harga + $ppn;
        $lampiran = NonPo::where('id', $nonpo_id)->firstOrFail();
        // dd(asset('storage/' . $lampiran->kak . ''), $lampiran);

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
        // dd(count($request->tembusan));

        $non_po_id = $request->non_po_id;
        $nama_pdf = NonPo::where('id', $non_po_id)->value("nomor_rpbj");
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);
        // $nama_pdf = $nama_pdf;
        $skk_id = NonPo::where('id', $non_po_id)->value("skk_id");
        $prk_id = NonPo::where('id', $non_po_id)->value("prk_id");


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

        $nama_pengirim = Pejabat::where('id', $request->sumber)->value('nama_pejabat');
        $jabatan_pengirim = Pejabat::where('id', $request->sumber)->value('jabatan');
        $nama_penerima = Pejabat::where('id', $request->tujuan)->value('nama_pejabat');
        $jabatan_penerima = Pejabat::where('id', $request->tujuan)->value('jabatan');


        $surat_dinas = [

            'non_po_id' => $request->non_po_id,
            'nama_pengirim' => $nama_pengirim,
            'jabatan_pengirim' => $jabatan_pengirim,
            'nama_penerima' => $nama_penerima,
            'jabatan_penerima' => $jabatan_penerima,
            'sifat' => $request->sifat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'isi_surat' => $request->isi_surat,

        ];
        OrderSuratDinas::create($surat_dinas);

        $order_surat_dinas_id = OrderSuratDinas::where('non_po_id', $non_po_id)->value('id');


        if($request->tembusan != null){
            for($i = 0; $i<count($request->tembusan); $i++){
                $tembusan = [
                    "order_surat_dinas_id" => $order_surat_dinas_id,
                    "isi_tembusan" => $request->tembusan[$i]
                ];
                Tembusan::create($tembusan);
            }
        }


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
        $this->update_skk_prk_non_po($skk_id, $prk_id, $status);


        // dd($rab_non_po);




        // $non_po_id = NonPo::where('id', $id)->value('id');
        // $hpe_id = NonPO::where('non_po_id', $non_po_id)->value('id');
        // $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();
        // $rab_non_po_id = RabNonPo::where('non_po_id', $non_po_id)->get();
        $kak = NonPo::where('id', $non_po_id)->value('kak');
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);
        (new PdfkhsController)->make_watermark($pdf, "On Progress");
        (new PdfkhsController)->make_watermark($pdf2, "On Progress");
        $path2 = 'surat_dinas.pdf';
        $path1 = 'newFileName.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());
        Storage::disk('local')->put($path1, $pdf->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_onprogress.pdf');

        //PDF DITOLAK
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);

        (new PdfkhsController)->make_watermark($pdf, "Ditolak");
        (new PdfkhsController)->make_watermark($pdf2, "Ditolak");
        $path1 = 'newFileName.pdf';
        $path2 = 'surat_dinas.pdf';

        Storage::disk('local')->put($path1, $pdf->output());
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_ditolak.pdf');

        //PDF DITERIMA
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);

        (new PdfkhsController)->make_watermark($pdf, "");
        (new PdfkhsController)->make_watermark($pdf2, "");

        $path1 = 'newFileName.pdf';
        $path2 = 'surat_dinas.pdf';

        Storage::disk('local')->put($path1, $pdf->output());
        Storage::disk('local')->put($path2, $pdf2->output());


        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'.pdf');

        return response()->json($nama_pdf);
    }

    public function simpan_edit_hpe(Request $request){
        // dd($request);


        $non_po_id = $request->non_po_id;
        $nama_pdf = NonPo::where('id', $non_po_id)->value("nomor_rpbj");
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        $explode_penerima = explode(' - ', $request->tujuan);
        $explode_pengirim = explode(' - ', $request->sumber);

        if (substr_count($request->sumber, ' - ') == 0){
            $nama_pengirim = Pejabat::where('id', $request->sumber)->value('nama_pejabat');
            $jabatan_pengirim = Pejabat::where('id', $request->sumber)->value('jabatan');
        }
        else{
            $nama_pengirim = $explode_pengirim[1];
            $jabatan_pengirim = $explode_pengirim[0];
        }

        if (substr_count($request->tujuan, ' - ') == 0){
            $nama_penerima = Pejabat::where('id', $request->tujuan)->value('nama_pejabat');
            $jabatan_penerima = Pejabat::where('id', $request->tujuan)->value('jabatan');
        }
        else{
            $nama_penerima = $explode_penerima[1];
            $jabatan_penerima = $explode_penerima[0];
        }
        // dd($nama_penerima, $jabatan_penerima);

        $surat_dinas = [
            // 'non_po_id' => $request->non_po_id,
            'nama_pengirim' => $nama_pengirim,
            'jabatan_pengirim' => $jabatan_pengirim,
            'nama_penerima' => $nama_penerima,
            'jabatan_penerima' => $jabatan_penerima,
            'sifat' => $request->sifat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'isi_surat' => $request->isi_surat,
        ];
        OrderSuratDinas::where('non_po_id', $non_po_id)->update($surat_dinas);
        $order_surat_dinas_id = OrderSuratDinas::where('non_po_id', $non_po_id)->value('id');
        Tembusan::where('order_surat_dinas_id', $order_surat_dinas_id)->delete();

        if($request->tembusan != null){
            for($j=0; $j < count($request->tembusan); $j++){
                $tembusan = [
                    "order_surat_dinas_id" => $order_surat_dinas_id,
                    "isi_tembusan" => $request->tembusan[$j]
                ];
                Tembusan::create($tembusan);
            }
        }

        $kak = NonPo::where('id', $non_po_id)->value('kak');
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);
        (new PdfkhsController)->make_watermark($pdf, "On Progress");
        (new PdfkhsController)->make_watermark($pdf2, "On Progress");
        $path2 = 'surat_dinas.pdf';
        $path1 = 'newFileName.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());
        Storage::disk('local')->put($path1, $pdf->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_onprogress.pdf');

        //PDF DITOLAK
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);

        (new PdfkhsController)->make_watermark($pdf, "Ditolak");
        (new PdfkhsController)->make_watermark($pdf2, "Ditolak");
        $path1 = 'newFileName.pdf';
        $path2 = 'surat_dinas.pdf';

        Storage::disk('local')->put($path1, $pdf->output());
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'-HPE_ditolak.pdf');

        //PDF DITERIMA
        $pdf = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        $pdf2 = $this->view_surat_dinas($non_po_id, $nama_pdf);

        (new PdfkhsController)->make_watermark($pdf, "");
        (new PdfkhsController)->make_watermark($pdf2, "");

        $path1 = 'newFileName.pdf';
        $path2 = 'surat_dinas.pdf';

        Storage::disk('local')->put($path1, $pdf->output());
        Storage::disk('local')->put($path2, $pdf2->output());


        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path('public/'.$kak), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/non-po/hpe/'.$nama_pdf.'.pdf');

        return response()->json($nama_pdf);
    }

    public function view_surat_dinas($non_po_id, $nama_pdf){
        $values_pdf_page1 = NonPo::where('id', $non_po_id)->get();
        $surats = OrderSuratDinas::where('non_po_id', $non_po_id)->get();
        $order_surat_dinas_id = OrderSuratDinas::where('non_po_id', $non_po_id)->value('id');
        $tembusans = Tembusan::where('order_surat_dinas_id', $order_surat_dinas_id)->get();


        $startdate = NonPo::where('id', $non_po_id)->value('startdate');
        $enddate = NonPo::where('id', $non_po_id)->value('enddate');
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

            // if($day != "Sun" && $day != "Sat") {
                //     $days += $datetime2 - $d;
                // }
                $days += $datetime2 - $d;
                $datetime2++;
                $d++;
            }
        // $values_pdf_page2 = RabNonPO::where('non_po_id', $non_po_id)->get();
        // // $values_pdf_page3 = NonPo::where('id', $id)->get();

        // $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        // $jumlah_hpe = RabNonPO::where('non_po_id', $non_po_id)->sum('jumlah_harga_perkiraan');
        // $ppn_default = PpnModel::all();
        // $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        // $ppn_hpe = $jumlah_hpe * ($ppn_default[0]->ppn / 100);
        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('format_surat.surat_dinas',[
            "surats" => $surats,
            "nonpos" => $values_pdf_page1,
            "days" => $days,
            "tembusans" => $tembusans,
        ]);

        return $pdf;
    }



    public function update_skk_prk_non_po($skk_id, $prk_id, $status){

        $updated_prk_progress = 0;

        $previous_prk_progress_non_po = NonPo::where('prk_id', $prk_id)->where('status', $status)->get('total_harga_hpe');
        // dd($previous_prk_progress_non_po);
        foreach ($previous_prk_progress_non_po as $prk_progress)
            $updated_prk_progress += (float)$prk_progress->total_harga_hpe;

        $previous_prk_progress_po_khs = Rab::where('prk_id', $prk_id)->where('status', 'Progress')->get('total_harga');
        foreach ($previous_prk_progress_po_khs as $prk_progress)
            $updated_prk_progress += (float)$prk_progress->total_harga;

        Prk::where('id', $prk_id)->update(array('prk_progress' => (float)$updated_prk_progress));

        //Update PRK Sisa
        $pagu_prk = Prk::where('id', $prk_id)->value('pagu_prk');
        $prk_progress = Prk::where('id', $prk_id)->value('prk_progress');
        $prk_terkontrak = Prk::where('id', $prk_id)->value('prk_terkontrak');
        $updated_prk_sisa = (float)$pagu_prk - (float)$prk_progress - (float)$prk_terkontrak;
        Prk::where('id', $prk_id)->update(array('prk_sisa' => (float)$updated_prk_sisa));

        //Update SKK progress
        $updated_skk_progress = 0;
        $previous_skk_progress = Prk::where('no_skk_prk', $skk_id)->get('prk_progress');
        foreach ($previous_skk_progress as $skk_progress)
            $updated_skk_progress += (float)$skk_progress->prk_progress;
        Skk::where('id', $skk_id)->update(array('skk_progress' => (float)$updated_skk_progress));

        //Update SKK Sisa
        $pagu_skk = Skk::where('id', $skk_id)->value('pagu_skk');
        $skk_progress = Skk::where('id', $skk_id)->value('skk_progress');
        $skk_terkontrak = Skk::where('id', $skk_id)->value('skk_terkontrak');
        $updated_skk_sisa = (float)$pagu_skk - (float)$skk_progress - (float)$skk_terkontrak;
        Skk::where('id', $skk_id)->update(array('skk_sisa' => (float)$updated_skk_sisa));
    }

    public function getDeskripsi(Request $request){
        // dd($request);
        $redaksi_id = $request->post('redaksi_id');

        // dd($redaksi_id);
        $deskripsi_redaksi = RedaksiNotaDinas::where('id', $redaksi_id)->value('deskripsi_redaksi');

        $deskripsi = DB::table('redaksi_nota_dinas')->where('deskripsi_redaksi', $deskripsi_redaksi)->first();
        // dd($deskripsi);

        return response()->json($deskripsi);
    }

    public function preview_hpe($nama_pdf)
    {

        $document = NonPo::where('slug', $nama_pdf)->value('pdf_file');

        $filePath = $document;

        $fileName = NonPo::where('slug', $nama_pdf)->value('nomor_rpbj');
        $id = NonPo::where('slug', $nama_pdf)->value('id');

        $rabs = NonPo::find($id);

        $fileName = str_replace('/', '-', $fileName);
        $fileName = str_replace('.', '_', $fileName);
        $fileName = str_replace(' ', '-', $fileName);



        return view('non-po.preview_hpe', [
            'title' =>'Preview NON-PO '.$fileName,
            'filename' => $fileName,
            'rabs' => $rabs,
            'slug' => $nama_pdf,
            'active' => $fileName

        ]);

    }
    public function edit_hpe($slug){
        // $non_pos = NonPo::where('slug', $slug)->get();
        // $non_po_id = NonPo::where('slug', $slug)->value('id');
        // $rab_non_pos = RabNonPo::where('non_po_id', $non_po_id)->get();
        // dd($non_pos);

        $id = NonPo::where('slug', $slug)->value('id');

        $nonpo_id = $id;
        $jumlah_harga = RabNonPO::where('non_po_id', $nonpo_id)->sum("jumlah_harga");
        $jumlah_harga_perkiraan = RabNonPO::where('non_po_id', $nonpo_id)->sum("jumlah_harga_perkiraan");
        $orders_surat_dinas = OrderSuratDinas::where('non_po_id', $nonpo_id)->get();
        // dd($orders_surat_dinas);
        $order_surat_dinas_id = OrderSuratDinas::where('non_po_id', $nonpo_id)->value('id');
        $tembusans = Tembusan::where('order_surat_dinas_id', $order_surat_dinas_id)->get();

        $ppn_default = PpnModel::all();
        $ppn = ($ppn_default[0]->ppn / 100) * $jumlah_harga;
        $ppn_hpe = ($ppn_default[0]->ppn / 100) * $jumlah_harga_perkiraan;
        $total_harga = $jumlah_harga + $ppn;
        $total_harga_perkiraan = $jumlah_harga_perkiraan + $ppn_hpe;
        // dd(RabNonPO::where('non_po_id', $nonpo_id)->get());
        $ordersurat = OrderSuratDinas::find($order_surat_dinas_id);
        $pejabat_database = Pejabat::all();
        $pejabat_array = [];
        $nama_jabatan_array = [];
        for($i = 0; $i < count($pejabat_database); $i++) {
            $pejabat_array[$i] = $pejabat_database[$i]->jabatan;
            $nama_jabatan_array[$i] = $pejabat_database[$i]->nama_pejabat;
        }
        // dd($pejabat_database);

        return view('non_po_hpe.edit_non_po_hpe',[
            'active1' => 'Buat HPE-Non-PO ',
            'title' => 'Non Purchase Order HPE',
            'title1' => 'Non-PO HPE',
            'active' => 'Non-PO HPE',
            'jumlah_harga' => $jumlah_harga,
            'jumlah_harga_perkiraan' => $jumlah_harga_perkiraan,
            'ppn_nonpo' => $ppn,
            'ppn_hpe' => $ppn_hpe,
            'total_harga' => $total_harga,
            'total_harga_perkiraan' => $total_harga_perkiraan,
            'non_po_id' => $nonpo_id,
            'orders_surat_dinas' => $orders_surat_dinas,
            'nonpos'=> NonPo::where('id', $nonpo_id)->get(),
            'lampiran'=> NonPo::find($nonpo_id),
            'rabnonpos'=> RabNonPO::where('non_po_id', $nonpo_id)->get(),
            'skks' => Skk::all(),
            'prks' => Prk::all(),
            'redaksis' => RedaksiNotaDinas::all(),
            'ordersurat' => $ordersurat,
            'pejabat_array' => $pejabat_array,
            'nama_jabatan_array' => $nama_jabatan_array,
            'pejabats' => Pejabat::all(),
            'tembusans' => $tembusans,
            'ppn' => $ppn_default,
            'user_id'=> User::find(Auth::id())->value('id'),
        ]);
        // dd($data);
        return view('non_po_hpe.edit_non_po_hpe', $data);
    }

    public function download($nama_pdf)
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
    public function download_test($nama_pdf)
    {


        $id = NonPo::where('slug', $nama_pdf)->value('id');

        $values_pdf_page1 = NonPo::where('id', $id)->get();
        $surats = OrderSuratDinas::where('non_po_id', $id)->get();


        $startdate = NonPo::where('id', $id)->value('startdate');
        $enddate = NonPo::where('id', $id)->value('enddate');
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

            // if($day != "Sun" && $day != "Sat") {
                //     $days += $datetime2 - $d;
                // }
                $days += $datetime2 - $d;
                $datetime2++;
                $d++;
            }
            // $manajer_keuangan = Pejabat::where('jabatan', 'ASISTANT MANAGER KEUANGAN ADMINISTRASI DAN UMUM')->first(['jabatan', 'nama_pejabat']);
            // $manajer_perencanaan = Pejabat::where('jabatan', 'ASISTANT MANAGER PERENCANAAN')->first(['jabatan', 'nama_pejabat']);
        // $values_pdf_page3 = NonPo::where('id', $id)->get();
        // dd($manajer_keuangan);

        $non_po_id = NonPo::where('id', $id)->value('id');
        $status = NonPo::where('id', $id)->value('status');
        $values_pdf_page2 = RabNonPo::where('non_po_id', $non_po_id)->get();
        $ppn_default = PpnModel::all();

        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('format_surat.surat_dinas',[
            "surats" => $surats,
            "days" => $days,
            "nonpos" =>$values_pdf_page1,
            // "days" =>"wakwaw"
        ]);
        (new PdfkhsController)->make_watermark($pdf, "On Progress");


        $path = 'surat_dinas.pdf';
        Storage::disk('local')->put($path, $pdf->output());


        $pdf2 = Pdf::loadView('layouts.nota_dinas',[
            "non_po" => $values_pdf_page1,
            "rab_non_po" => $values_pdf_page2,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "title" => $nama_pdf,
        ]);
        // $pdf2 = $this->load_view_nota_dinas_hpe($non_po_id, $nama_pdf);
        (new PdfkhsController)->make_watermark($pdf2, "On Progress");


        $path1 = 'newFileName.pdf';
        Storage::disk('local')->put($path1, $pdf2->output());


        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->merge();
        // $oMerger->save('storage/storage/file-pdf-khs/non-po/'.$nama_pdf.'.pdf');
        return $oMerger->download();
    }

    public function load_view_nota_dinas_hpe($non_po_id, $nama_pdf){
        $values_pdf_page1 = NonPO::where('id', $non_po_id)->get();
        $values_pdf_page2 = RabNonPO::where('non_po_id', $non_po_id)->get();
        $manajer_keuangan = Pejabat::where('jabatan', 'ASISTANT MANAGER KEUANGAN ADMINISTRASI DAN UMUM')->first(['jabatan', 'nama_pejabat']);
        $manajer_perencanaan = Pejabat::where('jabatan', 'ASISTANT MANAGER PERENCANAAN')->first(['jabatan', 'nama_pejabat']);
        // $values_pdf_page3 = NonPo::where('id', $id)->get();
        // dd($manajer_keuangan);
        $jumlah = RabNonPo::where('non_po_id', $non_po_id)->sum('jumlah_harga');
        $jumlah_hpe = RabNonPO::where('non_po_id', $non_po_id)->sum('jumlah_harga_perkiraan');
        $ppn_default = PpnModel::all();
        $ppn = $jumlah * ($ppn_default[0]->ppn / 100);
        $ppn_hpe = $jumlah_hpe * ($ppn_default[0]->ppn / 100);

        // dd($values_pdf_page1);

        $pdf = Pdf::loadView('layouts.nota_dinas_hpe',[
            "non_pos" => $values_pdf_page1,
            "rab_non_pos" => $values_pdf_page2,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            "jumlah_hpe" => $jumlah_hpe,
            "ppn_hpe" => $ppn_hpe,
            "title" => $nama_pdf,
            "manajer_keuangan" => $manajer_keuangan,
            "manajer_perencanaan" => $manajer_perencanaan,
        ]);
        return $pdf;
    }

    public function setuju(Request $request){
        // dd($request);

        $id = NonPo::where('slug', $request->slug)->value('id');
        $total_harga_hpe = NonPo::where('slug', $request->slug)->value('total_harga_hpe');
        $prk_id = NonPo::where('slug', $request->slug)->value('prk_id');
        $skk_id = NonPo::where('slug', $request->slug)->value('skk_id');
        // $status = NonPo::where('slug', $request->slug)->value('status');
        // $jenis_cetak = NonPo::where('slug', $request->slug)->value('jenis_cetak');
        // $values_pdf_page1 = NonPo::where('slug', $request->slug)->get();

        $prk = Prk::where('id', $prk_id)->get();
        $skk = Skk::where('id', $skk_id)->get();

        //update prk progress
        $updated_prk_progress = (float)$prk[0]->prk_progress - (float)$total_harga_hpe;
        Prk::where('id', $prk_id)->update(array('prk_progress'=>(Double)$updated_prk_progress));

        //update skk progress
        $updated_skk_progress = (float)$skk[0]->skk_progress - (float)$total_harga_hpe;
        Skk::where('id', $skk_id)->update(array('skk_progress'=>(Double)$updated_skk_progress));

        if($request->terima == "Disetujui") {
            //update prk terkontrak
            $updated_prk_terkontrak = (float)$prk[0]->prk_terkontrak + (float)$total_harga_hpe;
            Prk::where('id', $prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

            //update skk terkontrak
            $updated_skk_terkontrak = (float)$skk[0]->skk_terkontrak + (float)$total_harga_hpe;
            Skk::where('id', $skk_id)->update(array('skk_terkontrak'=>(Double)$updated_skk_terkontrak));
        } else {
            //update prk sisa
            $updated_prk_sisa = (float)$prk[0]->prk_sisa + (float)$total_harga_hpe;
            Prk::where('id', $prk_id)->update(array('prk_sisa'=>(Double)$updated_prk_sisa));

            //update skk sisa
            $updated_skk_sisa = (float)$skk[0]->skk_sisa + (float)$total_harga_hpe;
            Skk::where('id', $skk_id)->update(array('skk_sisa'=>(Double)$updated_skk_sisa));
        }

        $non_po = NonPo::find($id);

        $data = [
            'status' => $request->terima,
            // 'pdf_file' => $mypdf,
        ];

        $non_po->update($data);


        return response()->json([
            'success'   => true
        ]);

    }
}
