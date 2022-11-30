<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use App\Models\KontrakInduk;
use App\Models\Skk;
use App\Models\Prk;

class NonPOController extends Controller
{
    //
    public function index()
    { 
        return view('non-po.index', [
            'title' => 'Non-PO',
            'title1' => 'Non-PO',            
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
            'non-po.kak-rab',
            [
                'active1' => 'Buat PO-KHS',
                'title' => 'Non Purchase Order',
                'title1' => 'Non-PO',
                'active' => 'Non-PO',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                // 'categories' => ItemRincianInduk::all(),
                // 'items' => RincianInduk::all(),
                // 'kontraks' => KontrakInduk::all(),
                // 'pejabats' => Pejabat::all(),
                // 'khs' => Khs::all(),
                // 'latest_addendum' => $latest_addendum
            ]
        );
    }

}
