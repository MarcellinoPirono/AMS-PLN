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
use App\Models\PpnModel;
use App\Models\Addendum;
use App\Models\Vendor;
// use App\Models\OrderedRab;
use App\Models\OrderKhs;
use App\Models\OrderPaket;
use App\Models\OrderRedaksiKHS;
use App\Models\Redaksi;
use App\Models\SubRedaksi;
use App\Models\RabRedaksi;
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

use App\Http\Controllers\PdfkhsController;

use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class CetakNonTkdnController extends Controller
{

    public function cetak_paket_non_tkdn_lampiran(Request $request)
    {

        // dd($request);

        $addendum_id = Addendum::where('nomor_addendum', $request->addendum_id)->value('id');

        $nama_pdf = $request->nomor_po;
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        $mypdf = 'storage/file-pdf-khs/tkdn/'.$nama_pdf.'';

        $rab = [
            'nomor_po' => $request->nomor_po,
            'status' => $request->status,
            'jenis_cetak' => $request->jenis_cetak,
            'user_id' => $request->user_id,
            'tanggal_po' => $request->tanggal_po,
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'pekerjaan' => $request->pekerjaan,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'nomor_kontrak_induk' => $request->nomor_kontrak_induk,
            'addendum_id' => $addendum_id,
            'pejabat_id' => $request->pejabat_id,
            'pengawas_pekerjaan' => $request->pengawas_pekerjaan,
            'pengawas_lapangan' => $request->pengawas_lapangan,
            'total_harga' => $request->total_harga,
            'pdf_file' =>$mypdf,
            'slug' =>$nama_pdf,
        ];

        Rab::create($rab);


        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;

        $rab_id = [];
        $satuan_id = [];
        $nama_item_id = [];

        for($i = 0; $i < count($request->lokasi_with_paket); $i++){
            $rab_id[$i] = $id;
            $order_lokasi = [
                'rab_id' => $rab_id[$i],
                'nama_lokasi' => $request->lokasi_with_paket[$i]
            ];
            lokasi::create($order_lokasi);
            $lokasi_id = lokasi::where('rab_id', $rab_id[$i])->where("nama_lokasi", $request->lokasi_with_paket[$i])->value('id');
            for($j = 0; $j < count($request->pakets[$i]); $j++){
                $order_paket = [
                    'nama_paket' => $request->pakets[$i][$j],
                    'lokasi_id' => $lokasi_id,
                ];
                OrderPaket::create($order_paket);
                $order_paket_id = OrderPaket::where("lokasi_id", $lokasi_id)->where("nama_paket", $request->pakets[$i][$j])->value('id');
                if($request->item_id[$i][$j] != null) {
                    for($k = 0; $k < count($request->item_id[$i][$j]); $k++){
                        $satuan_id = Satuan::where('kepanjangan', $request->satuan_id_with_paket[$i][$j][$k])->value('id');
                        $item_order = RincianInduk::where('nama_item', $request->item_id[$i][$j][$k])->value('id');
                        $order_khs = [
                            'rab_id' => $rab_id[$i],
                            'order_paket_id' => $order_paket_id,
                            'kategori_order' => $request->kategory_order_with_paket[$i][$j][$k],
                            'item_order' => $item_order,
                            'satuan_id' => $satuan_id,
                            'harga_satuan' => $request->harga_satuan_with_paket[$i][$j][$k],
                            'volume' => $request->volume_with_paket[$i][$j][$k],
                            'jumlah_harga' => $request->jumlah_harga_with_paket[$i][$j][$k],
                            'tkdn' => $request->tkdn_with_paket[$i][$j][$k],
                            'kdn' => ($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k],
                            'kln' =>  $request->jumlah_harga_with_paket[$i][$j][$k] - (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]),
                            'total_tkdn' => (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]) + ($request->jumlah_harga_with_paket[$i][$j][$k] - (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]))
                        ];
                        OrderKhs::create($order_khs);
                    }
                }
            }
        }
        for ($i = 0; $i < count($request->sub_deskripsi_id); $i++) {
            $sub_deskripsi_id = SubRedaksi::where('sub_deskripsi', $request->sub_deskripsi_id[$i])->where('redaksi_id', $request->redaksi_id)->value('id');
            $rab_redaksi = [
                "rab_id" => $id,
                "subdeskripsi_id" => $sub_deskripsi_id
            ];
            RabRedaksi::create($rab_redaksi);
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
            ];
            OrderRedaksiKHS::create($order_redaksi);
        }

        $values_pdf_page1 = Rab::where('id', $id)->get();
        $rab_id2 = Rab::where('id', $id)->value('id');

        //PO ON PROGRESS
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 =$this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_progress.pdf');

        //PO DITOLAK
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 =$this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_ditolak.pdf');

        //PO DITERIMA
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 =$this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf');

        $this->update_skk_prk($request->skk_id, $request->prk_id);
        // $updated_prk_terkontrak = 0;
        // $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
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


    public function cetak_paket_non_tkdn_non_lampiran(Request $request)
    {

        // dd($request);
        $addendum_id = Addendum::where('nomor_addendum', $request->addendum_id)->value('id');

        $nama_pdf = $request->nomor_po;
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        $mypdf = 'storage/file-pdf-khs/tkdn/'.$nama_pdf.'';

        $rab = [
            'nomor_po' => $request->nomor_po,
            'status' => $request->status,
            'jenis_cetak' => $request->jenis_cetak,
            'user_id' => $request->user_id,
            'tanggal_po' => $request->tanggal_po,
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'pekerjaan' => $request->pekerjaan,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'nomor_kontrak_induk' => $request->nomor_kontrak_induk,
            'addendum_id' => $addendum_id,
            'pejabat_id' => $request->pejabat_id,
            'pengawas_pekerjaan' => $request->pengawas_pekerjaan,
            'pengawas_lapangan' => $request->pengawas_lapangan,
            'total_harga' => $request->total_harga,
            'pdf_file' =>$mypdf,
            'slug' =>$nama_pdf,
        ];

        Rab::create($rab);

        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;

        $rab_id = [];
        $satuan_id = [];
        $nama_item_id = [];

        for($i = 0; $i < count($request->lokasi_with_paket); $i++){
            $rab_id[$i] = $id;
            $order_lokasi = [
                'rab_id' => $rab_id[$i],
                'nama_lokasi' => $request->lokasi_with_paket[$i]
            ];
            lokasi::create($order_lokasi);
            $lokasi_id = lokasi::where('rab_id', $rab_id[$i])->where("nama_lokasi", $request->lokasi_with_paket[$i])->value('id');
            for($j = 0; $j < count($request->pakets[$i]); $j++){
                $order_paket = [
                    'nama_paket' => $request->pakets[$i][$j],
                    'lokasi_id' => $lokasi_id,
                ];
                OrderPaket::create($order_paket);
                $order_paket_id = OrderPaket::where("lokasi_id", $lokasi_id)->where("nama_paket", $request->pakets[$i][$j])->value('id');
                if($request->item_id[$i][$j] != null) {
                    for($k = 0; $k < count($request->item_id[$i][$j]); $k++){
                        $satuan_id = Satuan::where('kepanjangan', $request->satuan_id_with_paket[$i][$j][$k])->value('id');
                        $item_order = RincianInduk::where('nama_item', $request->item_id[$i][$j][$k])->value('id');
                        $order_khs = [
                            'rab_id' => $rab_id[$i],
                            'order_paket_id' => $order_paket_id,
                            'kategori_order' => $request->kategory_order_with_paket[$i][$j][$k],
                            'item_order' => $item_order,
                            'satuan_id' => $satuan_id,
                            'harga_satuan' => $request->harga_satuan_with_paket[$i][$j][$k],
                            'volume' => $request->volume_with_paket[$i][$j][$k],
                            'jumlah_harga' => $request->jumlah_harga_with_paket[$i][$j][$k],
                            'tkdn' => $request->tkdn_with_paket[$i][$j][$k],
                            'kdn' => ($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k],
                            'kln' =>  $request->jumlah_harga_with_paket[$i][$j][$k] - (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]),
                            'total_tkdn' => (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]) + ($request->jumlah_harga_with_paket[$i][$j][$k] - (($request->tkdn_with_paket[$i][$j][$k]/100) * $request->jumlah_harga_with_paket[$i][$j][$k]))
                        ];
                        OrderKhs::create($order_khs);
                    }
                }
            }
        }

        for ($i = 0; $i < count($request->sub_deskripsi_id); $i++) {
            $sub_deskripsi_id = SubRedaksi::where('sub_deskripsi', $request->sub_deskripsi_id[$i])->where('redaksi_id', $request->redaksi_id)->value('id');
            $rab_redaksi = [
                "rab_id" => $id,
                "subdeskripsi_id" => $sub_deskripsi_id
            ];
            RabRedaksi::create($rab_redaksi);
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
            ];
            OrderRedaksiKHS::create($order_redaksi);
        }

        $values_pdf_page1 = Rab::where('id', $id)->get();
        $rab_id2 = Rab::where('id', $id)->value('id');

        //PO PROGRESS
        $pdf =(new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_progress.pdf');

        //PO DITOLAK
        $pdf =(new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "ditolak");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "ditolak");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_ditolak.pdf');

        //PO DITERIMA
        $pdf =(new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf');

        $this->update_skk_prk($request->skk_id, $request->prk_id);
        // $updated_prk_terkontrak = 0;
        // $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
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
        // $id = compact('id');
        return response()->json($nama_pdf);
    }

     //CETAK NON-TKDN NON-PAKET
     public function cetak_non_tkdn_lampiran(Request $request)
     {


        //  dd($request);
        // $request->validate([
        //     'nomor_po' => 'required|unique:rabs|max:250',
        //     'tanggal_po' => 'required|max:250',
        //     'skk_id' => 'required|max:250',
        //     'prk_id' => 'required|max:250',
        //     'pekerjaan' => 'required|max:250',
        //     'lokasi' => 'nullable|max:250',
        //     'startdate' => 'required|max:250',
        //     'enddate' => 'required|max:250',
        //     'nomor_kontrak_induk' => 'required|max:250',
        //     'addendum_id' => 'nullable|max:250',
        //     'pejabat_id' => 'required|max:250',
        //     'pengawas' => 'required|max:250',
        //     'total_harga' => 'required|max:250',
        //     'kategori_order' => 'required|max:250',
        //     'item_order' => 'required|max:250',
        //     'satuan_id' => 'required|max:250',
        //     'harga_satuan' => 'required|max:250',
        //     'volume' => 'required|max:250',
        //     'jumlah_harga' => 'required|max:250',
        //     // 'jumlah_harga' => 'required',
        // ]);



        $addendum_id = Addendum::where('nomor_addendum', $request->addendum_id)->value('id');

        $nama_pdf = $request->nomor_po;
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        // dd($nama_pdf);


        $mypdf = 'storage/file-pdf-khs/tkdn/'.$nama_pdf.'';

        $rab = [
            'nomor_po' => $request->nomor_po,
            'status' => $request->status,
            'jenis_cetak' => $request->jenis_cetak,
            'user_id' => $request->user_id,
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
            'pengawas_pekerjaan' => $request->pengawas_pekerjaan,
            'pengawas_lapangan' => $request->pengawas_lapangan,
            'total_harga' => $request->total_harga,
            'pdf_file' =>$mypdf,
            'slug' =>$nama_pdf,
        ];

        Rab::create($rab);
        // dd($rab);

        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;


        $rab_id = [];
        $satuan_id = [];
        $nama_item_id = [];

        for ($i = 0; $i < $total_tabel; $i++) {
            $rab_id[$i] = $id;
            $satuan_id[$i] = Satuan::where('kepanjangan', $request->satuan_id[$i])->value('id');
            $nama_item_id[$i] = RincianINduk::where('nama_item', $request->item_order[$i])->value('id');
        }



        for ($j = 0; $j < $total_tabel; $j++) {
            $order_khs = [
                'rab_id' => $rab_id[$j],
                'kategori_order' => $request->kategori_order[$j],
                'item_order' => $nama_item_id[$j],
                'satuan_id' => $satuan_id[$j],
                'harga_satuan' => $request->harga_satuan[$j],
                'volume' => $request->volume[$j],
                'jumlah_harga' => $request->jumlah_harga[$j],
                'tkdn' => $request->tkdn[$j],
                'kdn' => $request->kdn[$j],
                'kln' => $request->kln[$j],
                'total_tkdn' => $request->total_tkdn[$j],
            ];
            OrderKhs::create($order_khs);
        }

        for ($i = 0; $i < count($request->sub_deskripsi_id); $i++) {
        $sub_deskripsi_id = SubRedaksi::where('sub_deskripsi', $request->sub_deskripsi_id[$i])->where('redaksi_id', $request->redaksi_id)->value('id');
        $rab_redaksi = [
            "rab_id" => $id,
            "subdeskripsi_id" => $sub_deskripsi_id
        ];
        RabRedaksi::create($rab_redaksi);
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
                // 'sub_deskripsi_id' => $sub_deskripsi_id[$j],
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

        $values_pdf_page1 = Rab::where('id', $id)->get();
        $rab_id2 = Rab::where('id', $id)->value('id');

        //PO ON-PROGRESS
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_progress.pdf');

        //PO DITOLAK
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_ditolak.pdf');

        //PO DITERIMA
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());

        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path2 = 'RAB_Paket_NON_TKDN.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->addPDF($request->file('lampiran')->getPathName(), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf');

        $this->update_skk_prk($request->skk_id, $request->prk_id);
        // $updated_prk_terkontrak = 0;
        // $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
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
        // $id = compact('id');
        return response()->json($nama_pdf);
     }


     public function cetak_non_tkdn_non_lampiran(Request $request)
     {
        //  dd($request);
        // $request->validate([
        //     'nomor_po' => 'required|unique:rabs|max:250',
        //     'tanggal_po' => 'required|max:250',
        //     'skk_id' => 'required|max:250',
        //     'prk_id' => 'required|max:250',
        //     'pekerjaan' => 'required|max:250',
        //     'lokasi' => 'nullable|max:250',
        //     'startdate' => 'required|max:250',
        //     'enddate' => 'required|max:250',
        //     'nomor_kontrak_induk' => 'required|max:250',
        //     'addendum_id' => 'nullable|max:250',
        //     'pejabat_id' => 'required|max:250',
        //     'pengawas' => 'required|max:250',
        //     'total_harga' => 'required|max:250',
        //     'kategori_order' => 'required|max:250',
        //     'item_order' => 'required|max:250',
        //     'satuan_id' => 'required|max:250',
        //     'harga_satuan' => 'required|max:250',
        //     'volume' => 'required|max:250',
        //     'jumlah_harga' => 'required|max:250',
        //     // 'jumlah_harga' => 'required',
        // ]);



        $addendum_id = Addendum::where('nomor_addendum', $request->addendum_id)->value('id');

        $nama_pdf = $request->nomor_po;
        $nama_pdf = str_replace('.', '_', $nama_pdf);
        $nama_pdf = str_replace('/','-', $nama_pdf);
        $nama_pdf = str_replace(' ','-', $nama_pdf);

        // dd($nama_pdf);


        $mypdf = 'storage/file-pdf-khs/tkdn/'.$nama_pdf.'';

        $rab = [
            'nomor_po' => $request->nomor_po,
            'status' => $request->status,
            'jenis_cetak' => $request->jenis_cetak,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'user_id' => $request->user_id,
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
            'pengawas_pekerjaan' => $request->pengawas_pekerjaan,
            'pengawas_lapangan' => $request->pengawas_lapangan,
            'total_harga' => $request->total_harga,
            'pdf_file' =>$mypdf,
            'slug' =>$nama_pdf,
        ];

        Rab::create($rab);
        // dd($rab);

        $id = Rab::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;


        $rab_id = [];
        $satuan_id = [];
        $nama_item_id = [];

        for ($i = 0; $i < $total_tabel; $i++) {
            $rab_id[$i] = $id;
            $satuan_id[$i] = Satuan::where('kepanjangan', $request->satuan_id[$i])->value('id');
            $nama_item_id[$i] = RincianINduk::where('nama_item', $request->item_order[$i])->value('id');
        }



        for ($j = 0; $j < $total_tabel; $j++) {
            $order_khs = [
                'rab_id' => $rab_id[$j],
                'kategori_order' => $request->kategori_order[$j],
                'item_order' => $nama_item_id[$j],
                'satuan_id' => $satuan_id[$j],
                'harga_satuan' => $request->harga_satuan[$j],
                'volume' => $request->volume[$j],
                'jumlah_harga' => $request->jumlah_harga[$j],
                'tkdn' => $request->tkdn[$j],
                'kdn' => $request->kdn[$j],
                'kln' => $request->kln[$j],
                'total_tkdn' => $request->total_tkdn[$j],
            ];
            OrderKhs::create($order_khs);
        }

        for ($i = 0; $i < count($request->sub_deskripsi_id); $i++) {
            $sub_deskripsi_id = SubRedaksi::where('sub_deskripsi', $request->sub_deskripsi_id[$i])->where('redaksi_id', $request->redaksi_id)->value('id');
            $rab_redaksi = [
                "rab_id" => $id,
                "subdeskripsi_id" => $sub_deskripsi_id
            ];
            RabRedaksi::create($rab_redaksi);
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
            //  'sub_deskripsi_id' => $request->sub_deskripsi_id[$j],
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

        $values_pdf_page1 = Rab::where('id', $id)->get();

        //PO ON PROGRESS
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());


        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "On Progress");
        $path2 = 'RAB.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_progress.pdf');

        //PO Ditolak
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());


        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "Ditolak");
        $path2 = 'RAB.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');

        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'_ditolak.pdf');

        //PO Diterima
        $pdf = (new PdfkhsController)->load_view_redaksi_spapp($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path1 = 'SPBJ.pdf';
        Storage::disk('local')->put($path1, $pdf->output());


        $pdf2 = $this->load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, "");
        $path2 = 'RAB.pdf';
        Storage::disk('local')->put($path2, $pdf2->output());

        $oMerger = PDFMerger::init();
        $oMerger->addPDF(Storage::disk('local')->path($path1), 'all');
        $oMerger->addPDF(Storage::disk('local')->path($path2), 'all');
        $oMerger->merge();
        $oMerger->save('storage/storage/file-pdf-khs/tkdn/'.$nama_pdf.'.pdf');

        $this->update_skk_prk($request->skk_id, $request->prk_id);
        // $updated_prk_terkontrak = 0;
        // $previous_prk_terkontrak = Rab::where('prk_id', $request->prk_id)->get('total_harga');
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
        // $id = compact('id');


        return response()->json($nama_pdf);
     }

    public function load_view_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, $status){
         $lokasis = lokasi::where('rab_id', $rab_id)->get();
         $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id2)->get();

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
             } else {
                 $material[$i] = $values_pdf_page2[$i];
                 $material_volume[$i] = $material[$i]->volume;
                 $ubah_volume_material[$i] = str_replace(".", ",", "$material_volume[$i]");
                 $material[$i]->volume = $ubah_volume_material[$i];
             }
         }

         $jabatan_manager = Pejabat::where('jabatan', 'Manager UP3')->value('jabatan');
         $nama_manager = Pejabat::where('jabatan', 'Manager UP3')->value('nama_pejabat');

         $jumlah = OrderKhs::where('rab_id', $rab_id2)->sum('jumlah_harga');
         $ppn_id = PpnModel::all();
         $ppn = $jumlah * ($ppn_id[0]->ppn/100);

         $pdf2 = Pdf::loadView('format_surat.rab_non_tkdn',[
            "po_khs" => $values_pdf_page1,
            "kategori_jasa" => $jasa,
            "kategori_material" => $material,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            // "days" => $days,
            "jabatan_manager" => $jabatan_manager,
            "nama_manager" => $nama_manager,
            "title" => $nama_pdf,
            "lokasis" => $lokasis,
            "ppn_id" => $ppn_id
        ]);
        (new PdfKhsController)->make_watermark($pdf2, $status);

        return $pdf2;
    }

    public function load_view_testing_rab_non_tkdn($rab_id, $rab_id2, $id, $nama_pdf, $values_pdf_page1, $status){
        $lokasis = lokasi::where('rab_id', $rab_id)->get();
        $rab_id = Rab::where('id', $id)->value('id');
        $values_pdf_page2 = OrderKhs::where('rab_id', $rab_id2)->get();

        // $pakets_id = [];
        $jasa = [];
        $jasa_volume = [];
        $jasa_jumlah_harga = [];
        $sub_jumlah_jasa = [];
        // $kdn_jasa = [];
        $ubah_volume_jasa = [];
        $material = [];
        $material_volume = [];
        $material_jumlah_harga= [];
        $sub_jumlah_material = [];
        // $kdn_material = [];
        $ubah_volume_material = [];
        $values_pdf_page2 = [];

        $nama_paket = [];

        for($k = 0; $k < count($lokasis); $k++){
            $jasa[$k] = [];
            $jasa_volume[$k] = [];
            $jasa_jumlah_harga[$k] = [];
            $sub_jumlah_jasa_paket[$k] = [];
            $ubah_volume_jasa[$k] = [];
            $material[$k] = [];
            $material_volume[$k] = [];
            $material_jumlah_harga[$k] = [];
            $sub_jumlah_material_paket[$k] = [];
            $values_pdf_page2[$k] = [];
            $ubah_volume_material[$k] = [];
            $paket_id[$k] = OrderPaket::where('lokasi_id', $lokasis[$k]->id)->get();
                for($j = 0; $j < count($paket_id[$k]); $j++){
                    $values_pdf_page2[$k][$j] = OrderKhs::where('order_paket_id', $paket_id[$k][$j]->id)->get();
                    $jasa[$k][$j] = [];
                    $jasa_volume[$k][$j] = [];
                    $jasa_jumlah_harga[$k][$j] = [];
                    $sub_jumlah_jasa_paket[$k][$j] = [];
                    $ubah_volume_jasa[$k][$j] = [];
                    $material[$k][$j] = [];
                    $material_volume[$k][$j] = [];
                    $material_jumlah_harga[$k][$j] = [];
                    $sub_jumlah_material_paket[$k][$j] = [];
                    $ubah_volume_material[$k][$j] = [];
                    for($i = 0; $i < count($values_pdf_page2[$k][$j]); $i++) {
                        if($values_pdf_page2[$k][$j][$i]->kategori_order == "Jasa") {
                            $jasa[$k][$j][$i] = $values_pdf_page2[$k][$j][$i];
                            $jasa_volume[$k][$j][$i] = $jasa[$k][$j][$i]->volume;
                            $jasa_jumlah_harga[$k][$j][$i] = $jasa[$k][$j][$i]->jumlah_harga;
                            $sub_jumlah_jasa_paket[$k][$j][$i] = $jasa_jumlah_harga[$k][$j][$i];
                            array_push($sub_jumlah_jasa, $jasa_jumlah_harga[$k][$j][$i]);
                            $ubah_volume_jasa[$k][$j][$i] = str_replace(".", ",", $jasa_volume[$k][$j][$i]);
                            $jasa[$k][$j][$i]->volume = $ubah_volume_jasa[$k][$j][$i];
                        } else {
                            $material[$k][$j][$i] = $values_pdf_page2[$k][$j][$i];
                            $material_volume[$k][$j][$i] = $material[$k][$j][$i]->volume;
                            $material_jumlah_harga[$k][$j][$i] = $material[$k][$j][$i]->jumlah_harga;
                            $sub_jumlah_material_paket[$k][$j][$i] = $material_jumlah_harga[$k][$j][$i];
                            array_push($sub_jumlah_material, $material_jumlah_harga[$k][$j][$i]);
                            $ubah_volume_material[$k][$j][$i] = str_replace(".", ",", $material_volume[$k][$j][$i]);
                            $material[$k][$j][$i]->volume = $ubah_volume_material[$k][$j][$i];
                        }
                    }
                    $sub_jumlah_jasa_paket[$k][$j] = array_sum($sub_jumlah_jasa_paket[$k][$j]);
                    $sub_jumlah_material_paket[$k][$j] = array_sum($sub_jumlah_material_paket[$k][$j]);
                }
        }
        $sub_jumlah_jasa = array_sum($sub_jumlah_jasa);
        $sub_jumlah_material = array_sum($sub_jumlah_material);

        $jabatan_manager = Pejabat::where('jabatan', 'Manager UP3')->value('jabatan');
        $nama_manager = Pejabat::where('jabatan', 'Manager UP3')->value('nama_pejabat');

        $jumlah = OrderKhs::where('rab_id', $rab_id)->sum('jumlah_harga');
        $ppn_id = PpnModel::all();
        $ppn = $jumlah * ($ppn_id[0]->ppn/100);

        $pdf2 = Pdf::loadView('format_surat.testing_rab_non_tkdn',[
            "po_khs" => $values_pdf_page1,
            "kategori_jasa" => $jasa,
            "kategori_material" => $material,
            "sub_jumlah_jasa" => $sub_jumlah_jasa,
            "sub_jumlah_material" => $sub_jumlah_material,
            "sub_jumlah_jasa_paket" => $sub_jumlah_jasa_paket,
            "sub_jumlah_material_paket" => $sub_jumlah_material_paket,
            "jumlah" => $jumlah,
            "ppn" => $ppn,
            // "days" => $days,
            "jabatan_manager" => $jabatan_manager,
            "nama_manager" => $nama_manager,
            "title" => $nama_pdf,
            "lokasis" => $lokasis,
            "paket_id" => $paket_id,
            "ppn_id" => $ppn_id,
        ]);

        (new PdfkhsController)->make_watermark($pdf2, $status);

        return $pdf2;
    }

    public function update_skk_prk($skk_id, $prk_id){

        $updated_prk_progress = 0;
        $previous_prk_progress = Rab::where('prk_id', $prk_id)->get('total_harga');
        foreach ($previous_prk_progress as $prk_progress)
            $updated_prk_progress += (float)$prk_progress->total_harga;
        Prk::where('id', $prk_id)->update(array('prk_progress' => (float)$updated_prk_progress));

        //Update PRK Sisa
        $pagu_prk = Prk::where('id', $prk_id)->value('pagu_prk');
        $prk_progress = Prk::where('id', $prk_id)->value('prk_progress');
        $updated_prk_sisa = (float)$pagu_prk - (float)$prk_progress;
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
        $updated_skk_sisa = (float)$pagu_skk - (float)$skk_progress;
        Skk::where('id', $skk_id)->update(array('skk_sisa' => (float)$updated_skk_sisa));
    }
}
