<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrkRequest;
use App\Http\Requests\UpdatePrkRequest;
use App\Models\Prk;
use App\Models\Skk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class PrkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $prks = DB::select('SELECT * FROM prks LEFT JOIN skks ON prks.no_skk_prk = skks.id');
        return view('prk.index', [
            'title' => 'PRK',
            'skks' => Skk::all(),
            'prks' => Prk::orderby('id', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prk.create', [
            'title' => 'PRK',
            'active' => 'PRK',
            'active1' => 'Tambah PRK',
            'skss' => Skk::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrkRequest $request)
    {
        $validatedData = $request->validate([

            'no_skk_prk' => 'required|max:250',
            'no_prk' => 'required|max:250',
            'uraian_prk' => 'required',
            'pagu_prk' => 'required|max:250',
            'prk_terkontrak' => 'required|max:250',
            'prk_realisasi' => 'required|max:250',
            'prk_terbayar' => 'required|max:250',
            'prk_sisa' => 'required|max:250'

        ]);
        
        // Update Pagu SKK
        $total_pagu_prk = 0;
        $previous_pagu_prk = Prk::where('no_skk_prk', $request->no_skk_prk)->get("pagu_prk");        
        foreach($previous_pagu_prk as $pagu_prk)            
            $total_pagu_prk += (Double)$pagu_prk->pagu_prk;
        $updated_pagu_skk = $request->pagu_prk + $total_pagu_prk;
        Skk::where('id', $request->no_skk_prk)->update(array('pagu_skk'=>(Double)$updated_pagu_skk));

        $pagu_skk = Skk::where('id', $request->no_skk_prk)->value("pagu_skk");
        $skk_terkontrak = Skk::where('id', $request->no_skk_prk)->value("skk_terkontrak");
        $updated_skk_sisa = (float)$pagu_skk - (float)$skk_terkontrak;
        Skk::where('id', $request->no_skk_prk)->update(array('skk_sisa'=>(Double)$updated_skk_sisa));

        Prk::create($validatedData);

        return redirect('/prk')->with('success', 'Prk Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function show(Prk $prk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $prk = Prk::findOrFail($id);

        $data = [
            'prk'  => $prk,
            'title' => 'PRK',
            'active' => 'PRK',
            'active1' => 'Edit PRK',
            'skks'    => Skk::orderBy('id', 'DESC')->get(),
        ];
        return view('prk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */

    public function update(UpdatePrkRequest $request, $id)
    {
        $request->validate([

            'no_skk_prk' => 'required',
            'no_prk' => 'required|max:250',
            'uraian_prk' => 'required|max:250',
            'pagu_prk' => 'required|numeric',
            'prk_terkontrak' => 'required|numeric',
            'prk_realisasi' => 'required|numeric',
            'prk_terbayar' => 'required|numeric',
            'prk_sisa' => 'required|numeric'

        ]);

        $prk = Prk::findOrFail($id);

        $input = $request->all();
        $prk->update($input);

        //Update Pagu SKK
        $updated_pagu_skk = 0;
        $previous_pagu_prk = Prk::where('no_skk_prk', $request->no_skk_prk)->get("pagu_prk");        
        foreach($previous_pagu_prk as $pagu_prk)            
            $updated_pagu_skk += (Double)$pagu_prk->pagu_prk;                
        Skk::where('id', $request->no_skk_prk)->update(array('pagu_skk'=>(Double)$updated_pagu_skk));

        //Update SKK Sisa
        $pagu_skk = Skk::where('id', $request->no_skk_prk)->value("pagu_skk");
        $skk_terkontrak = Skk::where('id', $request->no_skk_prk)->value("skk_terkontrak");
        $updated_skk_sisa = (float)$pagu_skk - (float)$skk_terkontrak;
        Skk::where('id', $request->no_skk_prk)->update(array('skk_sisa'=>(Double)$updated_skk_sisa));

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);

        $prk = Prk::find($id);
        $prk->delete();

        return response()->json([
            'success'   => true
        ]);
    }

    public function searchprk(Request $request)
    {
        $output ="";


       $prks= Prk::where('no_prk', 'LIKE', '%'. $request->search.'%')->orWhere('uraian_prk', 'LIKE', '%' . $request->search . '%')->orWhereHas('skks', function ($query) use ($request) {
        $query->where('nomor_skk', 'LIKE', '%' . $request->search . '%');})->get();
        // dd($prks);

       foreach($prks as $prk){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $prk->id .'>
            <td>'. $prk->id.'</td>
            <td>'. $prk->skks->nomor_skk.'</td>
            <td>'. $prk->no_prk.' </td>
            <td>'. $prk->uraian_prk.' </td>
            <td>'. $prk->pagu_prk.' </td>
            <td>'. $prk->prk_terkontrak.' </td>
            <td>'. $prk->prk_realisasi.' </td>
            <td>'. $prk->prk_terbayar.' </td>
            <td>'. $prk->prk_sisa.' </td>                     
            <td>'. ' 
            <div class="d-flex">
            <a href="/prk/'.$prk->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $prk->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';
       }

       return response($output);
    }

    public function filterprk(Request $request)
    { 

        $no_skk_prk = $request->no_skk_prk;

        if($no_skk_prk == ""){
            $prks = Prk::orderby('id', 'DESC')->get();
        }
        else{
            $prks = Prk::where('no_skk_prk', $no_skk_prk)->get();
        }        
        return view('prk.filter', ['prks' => $prks]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    }
}
