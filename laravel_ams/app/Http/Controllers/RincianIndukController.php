<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use \Http\Resources\RincianIndukResource;
use App\Http\Requests\StoreRincianIndukRequest;
use App\Http\Requests\UpdateRincianIndukRequest;
use App\Models\Khs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RincianIndukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemRincian  = ItemRincianInduk::get();
        return view('khs.detail_khs.item_khs.item_khs', [
            'title' => 'Item KHS',
            'items' => RincianInduk::orderBy('id', 'DESC')->get(),            
            'kategori' => $itemRincian, 
        ]);
    }

     public function jenis_khs(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');

        return view('khs.detail_khs.item_khs.item_khs', [
            'title' => 'Item KHS '. $jenis_khs.'',
            'items' => RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get(),
            'jenis_khs' => $jenis_khs
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->jenis_khs);
        $jenis_khs = $request->jenis_khs;

        return view(
            'khs.detail_khs.item_khs.buat_item_khs',
            [
                'title' => 'Item KHS ' . $jenis_khs . '',
                'active' => 'Item KHS',
                'active1' => 'Tambah ' . $jenis_khs . '',
                'items' => ItemRincianInduk::all(),
                'jenis_khs'=> $jenis_khs
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRincianIndukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRincianIndukRequest $request)
    {
        $jenis_khs = $request->khs_id;
        $khs_id = Khs::select('id')->where('jenis_khs', $jenis_khs)->get();
        $request["khs_id"] = $khs_id[0]->id;

        $validatedData = $request->validate([

            'nama_item' => 'required|max:250',
            'kategori' => 'required',
            'khs_id' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',

        ]);
        
        RincianInduk::create($validatedData);
        return redirect('/menu-item-khs')->with('success', 'Item KHS Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function show(RincianInduk $rincianInduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)

    {
        $jenis_khs = $request->jenis_khs;
        $id_item = $request->id;


        $item_khs = RincianInduk::find($id_item);

        $data = [
            'item_khs'  => $item_khs,
            'title' => 'Edit Item KHS ' .$jenis_khs. '',
            'active' => 'Item KHS',
            'active1' => 'Edit ' . $jenis_khs . '',
            'jenis_khs' => $jenis_khs,
        ];
        return view('khs.detail_khs.item_khs.edit_item_khs', $data);

        // // return $rincianInduk;
        // $items = RincianInduk::findOrFail($id);

        // // return $items;

        // return view('rincian.edit', [
        //     'title' => 'Item Kontrak Induk',
        //     'active' => 'Rincian Item',
        //     'active1' => 'Edit Rincian Item',
        //     // 'kontraks' => ItemRincianInduk::all(),
        //     'items' => $items,
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRincianIndukRequest  $request
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRincianIndukRequest $request, RincianInduk $rincianInduk, $id)
    {
        // dd($request);
        $id_item = $request->id;
        $jenis_khs = $request->khs_id;
        $khs_id = Khs::select('id')->where('jenis_khs', $jenis_khs)->get();
        $request["khs_id"] = $khs_id[0]->id;

        $request->validate([

            'nama_item' => 'required|max:250',
            'kategori' => 'required',
            'khs_id' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',

        ]);

        // dd($validate);

        $rincianInduk = RincianInduk::find($id_item);

        $input = $request->all();
        $rincianInduk->update($input);
        return response()->json(['success' => true]);

        // return redirect('/rincian')->with('status', 'Rincian Item Berhasil Diedit.');

        // $validatedData = $request->validate($rules);
        // RincianInduk::where('id', $rincianInduk->id)->update($validatedData);
        // return redirect('/rincian')->with('success', 'has been edited');


        // $rincianInduk->update([

        //     'nama_item' => $request['nama_item'],
        //     'satuan' => $request['satuan'],
        //     'kontraks_id' => $request['kontraks_id'],
        //     'harga_satuan' => $request['harga_satuan'],

        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // dd($request->id);

        $id=$request->id;
        // $rincianInduk = RincianInduk::find($id);
        // $rincianInduk->delete();

        // RincianInduk::destroy($id);

        // RincianInduk::where('nama_item', $nama_item)->delete();
        $rincianInduk = RincianInduk::find($id);
        // $sKK->prk()->delete();
        $rincianInduk->delete();

        // return redirect('/rincian')->with('success', 'Data berhasil dihapus!');
        // RincianInduk::destroy($rincianInduk->id);
        // return redirect('/rincian')->with('success', 'post has been deleted');
    }

    public function filteritem(Request $request)
    { 

        $kategori= $request->val;
        $jenis_khs= $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');

        if($kategori == ""){
            $items = RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'ASC')->get();
        }
        else{
            $items = RincianInduk::where('kategori', $kategori)->where('khs_id', $khs_id)->get();
        }        
        return view('khs.detail_khs.item_khs.filter_item_khs', ['items' => $items]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    }

    public function searchRincian(Request $request)
    {

        $output = "";
        $nomor = 0;
        $jenis_khs = $request->jenis_khs;
        $rincianInduk= RincianInduk::where('nama_item', 'LIKE', '%' . $request->search . '%')->orWhere('satuan', 'LIKE', '%' . $request->search . '%')->get();

        foreach ($rincianInduk as $rincianInduk) {
            $nomor = $nomor + 1;
            $output .=
                '<tr>
            <td>'.$nomor.'</td>
            <td>'.$rincianInduk->nama_item. '</td>
            <td>'.$rincianInduk->kategori.'</td>
            <td>'.$rincianInduk->khs->jenis_khs.'</td>
            <td>'.$rincianInduk->satuan. '</td>
            <td>'.$rincianInduk->harga_satuan.'</td>
            <td>' . ' 
            <div class="d-flex"><a href="/item-khs/'. $jenis_khs .''."/".'' . $rincianInduk['id'] . '/edit" class="btn btn-primary shadow btn-xs sharp mr-1 tombol-edit"><i class="fa fa-pencil"></i></a> <button onclick="deleteItem(' . $rincianInduk->id . ')" class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button></div>
            ' . '</td>
            </tr>';
        }

        return response($output);
    }
}
