<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pejabat;

class PejabatController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.pejabat.pejabat', [
            'title' => 'Pejabat',
            'pejabats' => Pejabat::all()
            // 'khss' => Khs::all(),
            // 'kontrakinduks' => KontrakInduk::all(),
        ]);

    }

    public function create()
    {
        return view('khs.detail_khs.pejabat.buat_pejabat', [
            'title' => 'Pejabat',
            'active' => 'Pejabat',
            'active1' => 'Tambah Pejabat',
            // 'khss' => Khs::all(),
            // 'vendors' => Vendor::all()
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'nama_pejabat' => 'required',
            'jabatan' => 'required',
            'unit_up3' => 'required',
            'unit_ulp' => 'required',
        ]);
        Pejabat::create($validatedData);
        return redirect('/pejabat')->with('success', 'Pejabat Berhasil Ditambahkan');
    }

    public function edit($id)

    {
        $pejabats = Pejabat::findOrFail($id);

        $data = [
            'pejabats'  => $pejabats,
            'title' => 'Pejabat',
            'active' => 'Pejabat',
            'active1' => 'Edit Pejabat',
            // 'khss' => Khs::all(),
            // 'vendors' => Vendor::all(),
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];
        return view('khs.detail_khs.pejabat.edit_pejabat', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([

            'nama_pejabat' => 'required',
            'jabatan' => 'required',
            'unit_up3' => 'required',
            'unit_ulp' => 'required',
        ]);

        $pejabats = Pejabat::findOrFail($id);

        $input = $request->all();
        $pejabats->update($input);

        // return redirect('/kontrak-induk-khs')->with('status', 'Kontrak Induk KHS Berhasil Diedit.');
    }

    // public function destroy(KontrakInduk $KontrakInduk, $id)
    // {
    //     // dd($id);
    //     $KontrakInduk = KontrakInduk::find($id);
    //     $KontrakInduk->delete();

    //     return response()->json([
    //         'success'   => true
    //     ]);
    // }

    // public function filterkontrakinduk(Request $request)
    // {

    //     $khs_id = $request->khs_id;

    //     if($khs_id == ""){
    //         $kontrakinduks = KontrakInduk::all();
    //     }
    //     else{
    //         $kontrakinduks = KontrakInduk::where('khs_id', $khs_id)->get();
    //     }
    //     // return response()->json($kontrakinduks);
    //     return view('khs.detail_khs.kontrak_induk_khs.filter_kontrak_induk_khs', ['kontrakinduks' => $kontrakinduks]);
    //     // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    // }

    public function searchpejabat(Request $request)
    {
        $output ="";


       $pejabats= Pejabat::where('nama_pejabat', 'LIKE', '%'. $request->search.'%')->orWhere('jabatan', 'LIKE', '%' . $request->search . '%')->orWhere('unit_up3', 'LIKE', '%' . $request->search . '%')->orWhere('unit_ulp', 'LIKE', '%' . $request->search . '%')->get();

       foreach($pejabats as $pejabat){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $pejabat->id .'>
            <td>'. $pejabat->id.'</td>
            <td>'. $pejabat->nama_pejabat.'</td>
            <td>'. $pejabat->jabatan.' </td>
            <td>'. $pejabat->unit_up3.' </td>
            <td>'. $pejabat->unit_ulp.' </td>
            <td>'. '
            <div class="d-flex">
            <a href="/pejabat/'.$pejabat->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $pejabat->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';
       }

       return response($output);
    }
}
