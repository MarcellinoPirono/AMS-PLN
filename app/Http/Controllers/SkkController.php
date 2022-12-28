<?php

namespace App\Http\Controllers;

use App\Models\ItemRincianInduk;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\PaketPekerjaan;
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
        // if($request->ajax()) {
        //     return view('skk.index',[
        //         'title' => 'SKK',
        //         'skks' => Skk::orderBy('id', 'DESC')->get(),
        //     ])->renderSections()['content'];
        // }

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
            'pagu_skk' => 'required|max:250',
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
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
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SKK  $sKK
     * @return \Illuminate\Http\Response
     */
    public function destroy(SKK $sKK, $id)
    {
        // dd($id);
        $sKK = SKK::find($id);
        $sKK->prks()->delete();
        $sKK->delete();

        return response()->json([
            'success'   => true
        ]);
    }

    public function getSKK(Request $request)
    {
        $skk_id = $request->post('skk_id');
        $prk = DB::table('prks')->where('no_skk_prk',$skk_id)->orderBy('no_prk')->get();

        $html = '<option value="" selected disabled>Pilih PRK</option>';
        foreach($prk as $prks){
            $html.='<option value="'.$prks->id.'">'.$prks->no_prk.'</option>';
        }
        echo $html;
    }

    public function getPRK(Request $request)
    {
        $prk_id = $request->post('prk_id');
        $pagu_prk = DB::table('prks')->where('id',$prk_id)->get();
        $html = $pagu_prk[0]->pagu_prk;
        echo $html;
    }

    public function getKontrakInduk(Request $request)
    {
        $kontrak_induk_id = $request->post('kontrak_induk');
        $khs_id = KontrakInduk::where('id', $kontrak_induk_id)->value('khs_id');
        $nama_kategori = DB::table('rincian_induks')->where('khs_id', $khs_id)->get();
        return response()->json($nama_kategori);
    }

    public function getKontrak_Induk(Request $request)
    {
        $kontrak_induk_id = $request->post('kontrak_induk');
        $kontrak_induk = KontrakInduk::where('id', $kontrak_induk_id)->value('khs_id');
        $nama_item = DB::table('rincian_induks')->where('khs_id',$kontrak_induk)->get();
        // $klasifikasis = DB::table('klasifikasi_pakets')->where('khs_id',$kontrak_induk)->get();
        $paket = PaketPekerjaan::select('nama_paket', 'slug')->where('khs_id', $kontrak_induk)->groupBy('nama_paket', 'slug')->get();

        $data = [
            "items" => $nama_item,
            "pakets" => $paket,
        ];
        return response()->json($data);
    }

    public function getCategory(Request $request)
    {
        $kategory_id = $request->post('kategory_id');
        $nama_item = DB::table('rincian_induks')->where('kategori_id',$kategory_id)->get();

        $html = '<option value="" selected disabled>Pilih Pekerjaan</option>';
        foreach($nama_item as $item){
            $html.='<option value="'.$item->id.'">'.$item->nama_item.'</option>';
        }
        echo $html;
    }

    public function getItem(Request $request)
    {
        $item_id = $request->post('item_id');

        $harga_item1 = DB::table('satuans')
                        ->rightJoin('rincian_induks', 'rincian_induks.satuan_id', '=', 'satuans.id');
        $harga_item = DB::table('rincian_induks')
                        ->leftJoin('satuans', 'rincian_induks.satuan_id', '=', 'satuans.id')
                        ->unionAll($harga_item1)
                        ->where('rincian_induks.id', $item_id)
                        ->first();
        return response()->json($harga_item);
    }

    public function searchskk(Request $request)
    {
        $output ="";

        $skks= Skk::where('nomor_skk', 'LIKE', '%'. $request->search.'%')->orWhere('uraian_skk', 'LIKE', '%' . $request->search . '%')->get();

        foreach($skks as $skk){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $skk->id .'>
            <td>'. $skk->id.'</td>
            <td>'. $skk->nomor_skk.'</td>
            <td>'. $skk->uraian_skk.' </td>
            <td>'. $skk->pagu_skk.' </td>
            <td>'. $skk->skk_terkontrak.' </td>
            <td>'. $skk->skk_realisasi.' </td>
            <td>'. $skk->skk_terbayar.' </td>
            <td>'. $skk->skk_sisa.' </td>
            <td>'. '
            <div class="d-flex">
            <a href="/skk/'.$skk->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $skk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';
       }

       return response($output);
    }

}
