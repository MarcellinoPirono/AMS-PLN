<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Models\Skk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SKKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('skk.index', [
            'title' => 'SKK',
            'skks' => Skk::orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('skk.create', [
            'title' => 'SKK',
            'active' => 'SKK',
            'active1' => 'Tambah SKK',
            'skks' => Skk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'nomor_skk' => 'required|max:250',
            'uraian_skk' => 'required|max:250',
            'pagu_skk' => 'required|max:250|numeric',
            'skk_terkontrak' => 'required|max:250',
            'skk_realisasi' => 'required|max:250',
            'skk_terbayar' => 'required|max:250',
            'skk_sisa' => 'required|max:250',

        ]);
        Skk::create($validatedData);
        return redirect('/skk')->with('status', 'Skk Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function show(SKK $sKK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skk = Skk::findOrFail($id);
        return view('skk.edit', [
            'title' => 'SKK',
            'active' => 'SKK',
            'active1' => 'Edit SKK',
            'skk' => $skk,
        ]);

        // return view('skk.edit', [

        //     'skk' => $sKK,
        //     'title' => 'SKK',
        //     'active' => 'SKK ',
        //     'active1' => 'Edit SKK ',
        //     'skks' => Skk::all(),
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SKK $sKK, $id)
    {
        $request->validate([

            'nomor_skk' => 'required|max:250',
            'uraian_skk' => 'required|max:250',
            'pagu_skk' => 'required|numeric',
            'skk_terkontrak' => 'required|numeric',
            'skk_realisasi' => 'required|numeric',
            'skk_terbayar' => 'required|numeric',
            'skk_sisa' => 'required|numeric',

        ]);
        $skk = Skk::findorFail($id);

        $input = $request->all();
        $skk->update($input);


        // $rules = [

        //     'nomor_skk' => 'required|max:250',
        //     'uraian_skk' => 'required|max:250',
        //     'pagu_skk' => 'required|max:250',
        //     'skk_terkontrak' => 'required|max:250',
        //     'skk_realisasi' => 'required|max:250',
        //     'skk_terbayar' => 'required|max:250',
        //     'skk_sisa' => 'required|max:250',

        // ];
        // $skk->update([

        //     'nomor_skk' => $request['nomor_skk'],
        //     'uraian_skk' => $request['uraian_skk'],
        //     'pagu_skk' => $request['pagu_skk'],
        //     'skk_terkontrak' => $request['skk_terkontrak'],
        //     'skk_realisasi' => $request['skk_realisasi'],
        //     'skk_terbayar' => $request['skk_terbayar'],
        //     'skk_sisa' => $request['skk_sisa'],
        // ]);

        return redirect('/skk')->with('status', 'Skk Berhasil Diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKK $sKK, $id)
    {
        $sKK = SKK::find($id);
        $sKK->prks()->delete();
        $sKK->delete();

        return redirect('/skk')->with('status', 'SKK Berhasil Dihapus');
    }

    public function getSKK(Request $request)
    {
        $skk_id = $request->post('skk_id');
        $prk = DB::table('prks')->where('no_skk_prk',$skk_id)->orderBy('no_prk')->get();

        $html = '<option value="0" selected disabled>Pilih PRK</option>';
        foreach($prk as $prks){
            $html.='<option value="'.$prks->id.'">'.$prks->no_prk.'</option>';
        }
        echo $html;
    }

    public function getCategory(Request $request)
    {
        $kategory_id = $request->post('kategory_id');
        // $nama_kontrak = DB::table('item_rincian_induks')->where('id',$kategory_id)->orderBy('nama_kontrak')->get();
        $nama_item = DB::table('rincian_induks')->where('kontraks_id',$kategory_id)->orderBy('nama_item')->get();

        $html = '<option value="0" selected disabled>Pilih Pekerjaan</option>';
        foreach($nama_item as $item){
            $html.='<option value="'.$item->id.'">'.$item->nama_item.'</option>';
        }
        echo $html;
    }

    public function getItem(Request $request)
    {
        $item_id = $request->post('item_id');
        $harga_item = RincianInduk::find($request->item_id)->where('id',$item_id)->first();
        return response()->json($harga_item);
    }
}
