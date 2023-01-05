<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use App\Models\lokasi;
use App\Models\Prk;
use App\Models\ItemRincianInduk;
use App\Models\Skk;
use App\Models\Khs;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\Pejabat;
use App\Models\Addendum;
use App\Models\Vendor;
// use App\Models\OrderedRab;
use App\Models\OrderKhs;
use App\Models\OrderRedaksiKHS;
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

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class PdfkhsController extends Controller
{

    public function pdf_khs_jtm(StoreRabRequest $request)
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

        $pdf2 = Pdf::loadView('layouts.surat',[
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

        $pdf2->setPaper('A4', 'landscape');

        $pdfmerger = PDFMerger::init();




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

}
