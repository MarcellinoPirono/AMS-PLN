<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonPo;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\RabNonPo;
use App\Models\Redaksi;

class NonPOController extends Controller
{
    //
    public function index()
    { 
        return view('non-po.index', [
            'title' => 'Non-PO',
            'title1' => 'Non-PO',  
            'redaksis'=>Redaksi::all(),          
        ]);       
    }

    public function create()
    {
        // $kategoris = ItemRincianInduk::all();
        // $data_kategori =[];
        // foreach ($kategoris as $kategori) {            
        //     $data_kategori =  $kategori->nama_kategori;
        // }

        // $items = RincianInduk::all();
        // $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan_id')->get();
        // $data_kategori = ItemRincianInduk::select('id','khs_id','nama_kategori')->get();
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
            'non-po.duplicate_buat_non_po',
            [
                'active1' => 'Buat PO-KHS',
                'title' => 'Non Purchase Order',
                'title1' => 'Non-PO',
                'active' => 'Non-PO',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'redaksis'=>Redaksi::all(),  
                // 'categories' => ItemRincianInduk::all(),
                // 'items' => RincianInduk::all(),
                // 'kontraks' => KontrakInduk::all(),
                // 'pejabats' => Pejabat::all(),
                // 'khs' => Khs::all(),
                // 'latest_addendum' => $latest_addendum
            ]
        );
    }

    public function buat_non_po()
    {
        // $kategoris = ItemRincianInduk::all();
        // $data_kategori =[];
        // foreach ($kategoris as $kategori) {            
        //     $data_kategori =  $kategori->nama_kategori;
        // }

        // $items = RincianInduk::all();
        // $data_items = RincianInduk::select('id', 'nama_item', 'harga_satuan', 'satuan_id')->get();
        // $data_kategori = ItemRincianInduk::select('id','khs_id','nama_kategori')->get();
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
            'non-po.duplicate_buat_non_po',
            [
                'active1' => 'Buat PO-KHS',
                'title' => 'Non Purchase Order',
                'title1' => 'Non-PO',
                'active' => 'Non-PO',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'redaksis'=>Redaksi::all(),  
                // 'categories' => ItemRincianInduk::all(),
                // 'items' => RincianInduk::all(),
                // 'kontraks' => KontrakInduk::all(),
                // 'pejabats' => Pejabat::all(),
                // 'khs' => Khs::all(),
                // 'latest_addendum' => $latest_addendum
            ]
        );
    }

    public function simpan_non_po(Request $request)
    {
        // dd($request);
        $request->validate([
            'nomor_rpbj' => 'required|max:250',            
            'skk_id' => 'required|max:250',
            'prk_id' => 'required|max:250',            
            'total_harga' => 'required|max:250',
            'kak' => 'required|mimes:pdf',
            'uraian' => 'required|max:250',
            'satuan' => 'required|max:250',
            'harga_satuan' => 'required|max:250',
            'volume' => 'required|max:250',
            'jumlah_harga' => 'required|max:250',
        ]);

        $non_po = [
            'nomor_rpbj' => $request->nomor_po,            
            'skk_id' => $request->skk_id,
            'prk_id' => $request->prk_id,
            'kak' => $request->kak,            
            'total_harga' => $request->total_harga,
        ];

        NonPo::create($non_po);

        $id = RabNonPo::where('nomor_po', $request->nomor_po)->value('id');

        $total_tabel = $request->click;

        $non_po_id = [];

        for ($i = 0; $i < $total_tabel; $i++) {
            $non_po_id[$i] = $id;
        }

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

        //Update PRK 1
        // $previous_prk_terkontrak = Prk::where('id', $request->prk_id)->value('prk_terkontrak');
        // $updated_prk_terkontrak = $request->total_harga + (Double)$previous_prk_terkontrak;
        // Prk::where('id', $request->prk_id)->update(array('prk_terkontrak'=>(Double)$updated_prk_terkontrak));

        // Update PRK Terkontrak
        $updated_prk_terkontrak = 0;
        $previous_prk_terkontrak = NonPo::where('prk_id', $request->prk_id)->get('total_harga');
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


        return redirect('/non-po')->with('status', 'PO KHS Berhasil Ditambah!');
    }



}
