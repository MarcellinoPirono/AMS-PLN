<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addendum;
use App\Models\KontrakInduk;
use Illuminate\Support\Facades\DB;

class AddendumController extends Controller
{
    public function index()
    {
        // $addendums = DB::table('addendums')->join('kontrak_induks', 'addendums.nomor_kontrak_induk', '=', 'kontrak_induks.nomor_kontrak_induk')->join('khs', 'kontrak_induks.jenis_khs', '=', 'khs.jenis_khs')->get(['addendums.*', 'kontrak_induks.*', 'khs.*']);
        // dd($addendums);
        // $addendums = Khs::with();
        return view('khs.detail_khs.addendum_khs.addendum_khs', [
            'title' => 'Addendum',
            'active' => 'Addendum',
            'active1' => 'Addendum KHS',
            'addendums' => Addendum::all(),
            'kontrakinduks' => KontrakInduk::all(),
        ]);
    }

    public function create()
    {
        return view('khs.detail_khs.addendum_khs.buat_addendum', [
            'title' => 'Addendum',
            'active' => 'Tambah Addendum',
            'active1' => 'Tambah Addendum KHS',
            'kontrakinduks' => KontrakInduk::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([

            'kontrak_induk_id' => 'required',
            'nomor_addendum' => 'required',
            'tanggal_addendum' => 'date',            

        ]);
        Addendum::create($validatedData);
        return redirect('/addendum-khs')->with('success', 'Addendum Berhasil Ditambahkan');
    }

    public function edit($id)
    {

        $addendums = Addendum::findOrFail($id);

        $data = [
            'addendums'  => $addendums,
            'title' => 'Addendum',
            'active' => 'Addendum',
            'active1' => 'Edit Addendum',
            'kontrakinduks' => KontrakInduk::orderBy('id', 'DESC')->get(),
        ];
        return view('khs.detail_khs.addendum_khs.edit_addendum', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kontrak_induk_id' => 'required',
            'nomor_addendum' => 'required',
            'tanggal_addendum' => 'date',            
        ]);

        $addendums = Addendum::findOrFail($id);

        $input = $request->all();
        $addendums->update($input);

        return redirect('/addendum-khs')->with('status', 'Addendum KHS Berhasil Diedit.');
    }

    public function filter(Request $request)
    { 

        $kontrak_induk_id = $request->filter;        
        $addendums = Addendum::where('kontrak_induk_id', $kontrak_induk_id)->get();
        return view('khs.detail_khs.addendum_khs.filter_addendum', ['addendums' => $addendums]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    }

    public function searchaddendumkhs(Request $request)
    {
        $output ="";


       $addendums= Addendum::where('nomor_addendum', 'LIKE', '%'. $request->search.'%')->orWhere('tanggal_addendum', 'LIKE', '%' . $request->search . '%')->orWhereHas('kontrak_induks', function ($query) use ($request) {
        $query->where('nomor_kontrak_induk', 'LIKE', '%' . $request->search . '%');})->get();            
        
        
        // dd($addendums);
       foreach($addendums as $addendum){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $addendum->id .'>
            <td>'. $addendum->id.'</td>
            <td>'. $addendum->kontrak_induks->nomor_kontrak_induk.'</td>
            <td>'. $addendum->kontrak_induks->khs->jenis_khs.' </td>
            <td>'. $addendum->kontrak_induks->khs->nama_pekerjaan.' </td>
            <td>'. $addendum->nomor_addendum.' </td>            
            <td>'. $addendum->tanggal_addendum.' </td>            
            <td>'. ' 
            <div class="d-flex">
            <a href="/addendum-khs/'.$addendum->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $vendor->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';
       }

       return response($output);
    }

    // public function getNoKontrakInduk(Request $request)
    // {
    //     $no_kontrak_induk = $request->post('no_kontrak_induk');
    //     $jenis_khs = KontrakInduk::find($request->no_kontrak_induk)->where('nomor_kontrak_induk', $no_kontrak_induk)->value('jenis_khs');
    //     dd($jenis_khs);
    //     return response()->json($jenis_khs);           
    // }


}
