<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Models\PaketPekerjaan;
use App\Models\ItemRincianInduk;
use \Http\Resources\RincianIndukResource;
use App\Http\Requests\StoreRincianIndukRequest;
use App\Http\Requests\UpdateRincianIndukRequest;
use App\Models\Khs;
use App\Models\Satuan;
use App\Imports\ImportItem_SPAPP;
use App\Imports\MultiSheetImport;
use App\Exports\RincianIndukExport;
use App\Exports\MultiSheetExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

// use DB;
use Yajra\DataTables\Facades\DataTables;

class RincianIndukController extends Controller
{
    // use Excel;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $itemRincian  = ItemRincianInduk::get();
    //     return view('khs.detail_khs.item_khs.item_khs', [
    //         'title' => 'Item KHS',
    //         'items' => RincianInduk::all()->paginate(10),
    //         'kategori' => $itemRincian,
    //     ]);
    // }

     public function jenis_khs(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        $kategori_item = DB::table('rincian_induks')->select('kategori')->distinct()->get();

        // dd($kategori_item);

        return view('khs.detail_khs.item_khs.item_khs', [
            'title' => 'Item KHS '. $jenis_khs.'',
            'items' => RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get(),
            'jenis_khs' => $jenis_khs,
            'kategori_item' => $kategori_item
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
        $satuan = Satuan::all();

        return view(
            'khs.detail_khs.item_khs.buat_item_khs',
            [
                'title' => 'Item KHS ' . $jenis_khs . '',
                'active' => 'Item KHS',
                'active1' => 'Tambah ' . $jenis_khs . '',
                'items' => ItemRincianInduk::all(),
                'jenis_khs'=> $jenis_khs,
                'satuans'=>$satuan
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
        // dd($request);

        $validatedData = $request->validate([
            'nama_item' => 'required|max:250',
            'kategori' => 'required',
            'khs_id' => 'required',
            'satuan_id' => 'required',
            'harga_satuan' => 'required',
            'tkdn' => 'required'
        ]);
        // dd($validatedData);

        RincianInduk::create($validatedData);
        return redirect('/menu-item-khs')->with('success', 'Item KHS Berhasil Ditambahkan');
    }

    function import(Request $request)
    {

            $request->validate([
                'select_file'  => 'required|mimes:xls,xlsx|'
            ]);

            // dd($request);

            $jenis_khs = $request->jenis_khs;

            if ($request->file('select_file')) {
                # code...
                // $file = $request->file('select_file');
                // $nama_file = Carbon::now()->format('Y-m-d') . $file->getClientOriginalName();
                // $file->move('storage/storage/file_itemspapp', $nama_file);


                $import = new MultiSheetImport();
                $import->onlySheets(0);
                Excel::import($import, $request->file('select_file')->store('temp'));
                $rules = [];


                return redirect('item-khs/'.$jenis_khs.'')->withSuccess('Import File Berhasil');
            }

    }

    public function export(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        // dd($khs_id);
        $sheets = ['Item KHS', 'Satuan', 'Khs'];
        // dd($khs_id);


        return Excel::download(new MultiSheetExport($sheets, $khs_id), 'Template Import '.$jenis_khs.'.xlsx');

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
        // dd($request);
        $jenis_khs = $request->jenis_khs;
        $id_item = $request->id;


        $item_khs = RincianInduk::find($id_item);
        $satuan = Satuan::all();

        $data = [
            'item_khs'  => $item_khs,
            'title' => 'Edit Item KHS ' .$jenis_khs. '',
            'active' => 'Item KHS',
            'active1' => 'Edit ' . $jenis_khs . '',
            'jenis_khs' => $jenis_khs,
            'satuans' => $satuan,
            'id_item' => $id_item
        ];
        return view('khs.detail_khs.item_khs.edit_item_khs', $data);
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
            'satuan_id' => 'required',
            'harga_satuan' => 'required',
            'tkdn' => 'required'

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
        $paket = PaketPekerjaan::where('item_id', $id);
// $paket
        // $rincianInduk = RincianInduk::find($id);
        // $rincianInduk->delete();

        // RincianInduk::destroy($id);

        // RincianInduk::where('nama_item', $nama_item)->delete();
        $rincianInduk = RincianInduk::find($id);
        // $sKK->prk()->delete();
        $paket->delete();
        $rincianInduk->delete();

        // return redirect('/rincian')->with('success', 'Data berhasil dihapus!');
        // RincianInduk::destroy($rincianInduk->id);
        // return redirect('/rincian')->with('success', 'post has been deleted');
    }

    public function filteritem($q)
    {

        // $kategori= $request->val;
        // $jenis_khs= $request->jenis_khs;
        // $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');

        // if($kategori == ""){
        //     $items = RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'ASC')->get();
        // }
        // else{
        //     $items = RincianInduk::where('kategori', $kategori)->where('khs_id', $khs_id)->get();
        // }
        // return view('khs.detail_khs.item_khs.filter_item_khs', ['items' => $items]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');

        if (request('kategori')) {
            $q->where('kategori', '=', request('kategori'));
        }
        return $q;

        Product::filter()->paginate(20);

    }

    public function searchRincian(Request $request)
    {

        $output = "";
        $nomor = 0;
        $jenis_khs = $request->jenis_khs;
        $rincianInduk= RincianInduk::where('nama_item', 'LIKE', '%' . $request->search . '%')->orWhere('satuan_id', 'LIKE', '%' . $request->search . '%')->get();

        foreach ($rincianInduk as $rincianInduk) {
            $nomor = $nomor + 1;
            $output .=
                '<tr style="width: 1135px;"  >
            <td align="center" valign="middle">#</td>
            <td>'.$rincianInduk->nama_item. '</td>
            <td align="center" valign="middle">'.$rincianInduk->kategori.'</td>
            <td align="center" valign="middle">'.$rincianInduk->khs->jenis_khs.'</td>
            <td align="center" valign="middle">'.$rincianInduk->satuans->singkatan. '</td>
            <td align="center" valign="middle">'.money($rincianInduk->harga_satuan).'</td>
            <td>' . '
            <div class="d-flex"><a href="/item-khs/'. $jenis_khs .''."/".'' . $rincianInduk['id'] . '/edit" class="btn btn-primary shadow btn-xs sharp mr-1 tombol-edit"><i class="fa fa-pencil"></i></a> <button onclick="deleteItem(' . $rincianInduk->id . ')" class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button></div>
            ' . '</td>
            </tr>';
        }

        return response($output);
    }

    public function checkItem(Request $request) {
        $nama_item = $request->post('nama_item');
        $check_nama_item = RincianInduk::where('nama_item', $nama_item)->get();

        if(count($check_nama_item) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
