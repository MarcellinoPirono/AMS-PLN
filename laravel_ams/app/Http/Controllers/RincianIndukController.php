<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use \Http\Resources\RincianIndukResource;
use App\Http\Requests\StoreRincianIndukRequest;
use App\Http\Requests\UpdateRincianIndukRequest;
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

       

        // $items = DB::table('rincian_induks')
        //     ->leftJoin('item_rincian_induks', 'rincian_induks.kontraks_id', '=', 'item_rincian_induks.id')
        //     ->get();

        // return view('rincian.index', compact('items'), [
        //     'title' => 'Item Kontrak Induk',
        // ]);

        $itemRincian  = ItemRincianInduk::get();
        return view('rincian.index', [
            'title' => 'Rincian Item',
            'items' => RincianInduk::orderBy('id', 'DESC')->get(),
            'kategori' => $itemRincian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $items = DB::select('SELECT * FROM rincian_induks LEFT JOIN item_rincian_induks ON rincian_induks.kontraks_id = item_rincian_induks.id');

        return view(
            'rincian.create',
            [
                'title' => 'Item Kontrak Induk',
                'active' => 'Rincian Item',
                'active1' => 'Tambah Rincian Item',
                'items' => ItemRincianInduk::all(),
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
        // dd($request->all());
        $validatedData = $request->validate([

            'nama_item' => 'required|max:250|unique:rincian_induks,nama_item',
            'satuan' => 'required',
            'kategori_id' => 'required',
            'harga_satuan' => 'required|numeric',

        ]);
        RincianInduk::create($validatedData);
        return redirect('/rincian')->with('success', 'Post has been edited');
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
    public function edit($id)

    {
        $rincianInduk = RincianInduk::findOrFail($id);

        $data = [
            'rincianinduk'  => $rincianInduk,
            'title' => 'Item Kontrak Induk',
            'active' => 'Rincian Item',
            'active1' => 'Edit Rincian Item',
            'categories'    => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];
        return view('rincian.edit', $data);

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
        $request->validate([

            'nama_item' => 'required|max:250',
            'satuan' => 'required',
            'kategori_id' => 'required',
            'harga_satuan' => 'required|numeric',

        ]);

        $rincianInduk = RincianInduk::findOrFail($id);

        $input = $request->all();
        $rincianInduk->update($input);

        return redirect('/rincian')->with('status', 'Rincian Item Berhasil Diedit.');

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
    public function destroy(RincianInduk $rincianInduk, $id)
    {
        // dd($request->all());
        // $rincianInduk = RincianInduk::find($id);
        // $rincianInduk->delete();

        // RincianInduk::destroy($id);

        // RincianInduk::where('nama_item', $nama_item)->delete();
        $rincianInduk = RincianInduk::find($id);
        // $sKK->prk()->delete();
        $rincianInduk->delete();

        return redirect('/rincian')->with('success', 'Data berhasil dihapus!');
        // RincianInduk::destroy($rincianInduk->id);
        // return redirect('/rincian')->with('success', 'post has been deleted');
    }

    public function filter(Request $request)
    {

        $item = $request->filter;
        $rincianInduk = RincianInduk::where('kategori_id', $item)->get();
        return view('rincian.filter', ['items' => $rincianInduk]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    }

    public function searchRincian(Request $request)
    {
        $output = "";


        $rincianInduk= RincianInduk::where('nama_item', 'LIKE', '%' . $request->search . '%')->orWhere('satuan', 'LIKE', '%' . $request->search . '%')->get();

        foreach ($rincianInduk as $rincianInduk) {
            $output .=
                '<tr>
            <td>#</td>
            <td>'. $rincianInduk->nama_item. '</td>
            <td>'.$rincianInduk->item_rincian_induks->nama_kategori.'</td>
            <td>'.$rincianInduk->item_rincian_induks->khs->jenis_khs.'</td>
            <td>'.$rincianInduk->satuan. '</td>
            <td>'.$rincianInduk->harga_satuan.'</td>
            <td>' . ' 
            <div class="d-flex"><a href="/rincian/' . $rincianInduk['id'] . '/edit" class="btn btn-primary shadow btn-xs sharp mr-1 tombol-edit"><i class="fa fa-pencil"></i></a><button class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button></div>
            ' . '</td>
            </tr>';
        }

        return response($output);
    }
}
