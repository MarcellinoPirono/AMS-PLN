<?php

namespace App\Http\Controllers;

use App\Models\KontrakInduk;
use App\Models\Khs;
use App\Models\Vendor;
use App\Imports\KontrakIndukImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;


class KontrakIndukController extends Controller
{
    public function index()
    {
        $khs_id_active = Khs::where('isActive', True)->get('id');
        // dd($khs_id_active);
        // $khs_id = [];
        // for($i=0; $i<count($khs_id_active); $i++){
        //     $khs_id[$i] = KontrakInduk::where('khs_id', $khs_id_active[$i]->id)->get();
        // }
        // dd($khs_id);
        // for
        return view('khs.detail_khs.kontrak_induk_khs.kontrak_induk', [
            'title' => 'Kontrak Induk KHS',
            'khss' => Khs::all(),
            // 'kontrakinduks' => $khs_id,
            'kontrakinduks' => KontrakInduk::whereHas('Khs', function($q) {
                $q->where('isActive', True);
            })->get(),
            'vendors' => Vendor::all()
        ]);

    }

    public function create()
    {
        return view('khs.detail_khs.kontrak_induk_khs.buat_kontrak_induk_khs', [
            'title' => 'Kontrak Induk',
            'active' => 'Kontrak Induk',
            'active1' => 'Tambah Kontrak Induk KHS',
            'khss' => Khs::all(),
            'vendors' => Vendor::all()
        ]);
    }

    public function create_xlsx()
    {

        return view(
            'khs.detail_khs.kontrak_induk_khs.buat_kontrak_induk_khs_via_excel',
            [
                'title' => 'Kontrak Induk',
            'active' => 'Kontrak Induk',
            'active1' => 'Tambah Kontrak Induk KHS',
                // 'items' => ItemRincianInduk::all(),
            ]
        );
    }
    function import(Request $request)
    {
        // dd($request);
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);


     Excel::import(new KontrakIndukImport, $request->file('select_file')->store('temp'));

    return redirect('/kontrak-induk-khs');
    }

    public function store(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([

            'khs_id' => 'required',
            'nomor_kontrak_induk' => 'required|unique:kontrak_induks',
            'tanggal_kontrak_induk' => 'required',
            'vendor_id' => 'required',

        ]);
        KontrakInduk::create($validatedData);
        return redirect('/kontrak-induk-khs')->with('success', 'Kontrak Induk Berhasil Ditambahkan');
    }

    public function edit($id)

    {
        $kontrakinduks = KontrakInduk::findOrFail($id);

        $data = [
            'kontrakinduks'  => $kontrakinduks,
            'title' => 'Kontrak Induk KHS',
            'active' => 'Kontrak Induk KHS',
            'active1' => 'Edit Kontrak Induk KHS',
            'khss' => Khs::all(),
            'vendors' => Vendor::all(),
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];
        if($kontrakinduks->khs->isActive == True){
            return view('khs.detail_khs.kontrak_induk_khs.edit_kontrak_induk_khs', $data);
        }
        else{
            Alert::error('Mohon Maaf', 'Halaman Tidak Tersedia');

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([

            'khs_id' => 'required',
            'nomor_kontrak_induk' => 'required',
            'tanggal_kontrak_induk' => 'required',
            'vendor_id' => 'required',
        ]);

        $kontrakinduks = KontrakInduk::findOrFail($id);

        $input = $request->all();
        $kontrakinduks->update($input);

        // return redirect('/kontrak-induk-khs')->with('status', 'Kontrak Induk KHS Berhasil Diedit.');
    }

    public function destroy(KontrakInduk $KontrakInduk, $id)
    {
        // dd($id);
        $KontrakInduk = KontrakInduk::find($id);
        $KontrakInduk->delete();

        return response()->json([
            'success'   => true
        ]);
    }

    public function filterkontrakinduk(Request $request)
    {

        $khs_id = $request->khs_id;

        if($khs_id == ""){
            $kontrakinduks = KontrakInduk::all();
        }
        else{
            $kontrakinduks = KontrakInduk::where('khs_id', $khs_id)->get();
        }
        // return response()->json($kontrakinduks);
        return view('khs.detail_khs.kontrak_induk_khs.filter_kontrak_induk_khs', ['kontrakinduks' => $kontrakinduks]);
        // return redirect('/rincian')->with('success', 'Data berhasil dicari!');
    }

    public function searchkontrakinduk(Request $request)
    {
        $output ="";


       $kontrakinduks= KontrakInduk::where('nomor_kontrak_induk', 'LIKE', '%'. $request->search.'%')->orWhere('tanggal_kontrak_induk', 'LIKE', '%' . $request->search . '%')->orWhereHas('khs', function ($query) use ($request) {
        $query->where('jenis_khs', 'LIKE', '%' . $request->search . '%');})->orWhereHas('vendors', function ($query) use ($request) {
            $query->where('nama_vendor', 'LIKE', '%' . $request->search . '%');})->get();

       foreach($kontrakinduks as $kontrakinduk){
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $kontrakinduk->id .'>
            <td>'. $kontrakinduk->id.'</td>
            <td>'. $kontrakinduk->khs->jenis_khs.'</td>
            <td>'. $kontrakinduk->nomor_kontrak_induk.' </td>
            <td>'. $kontrakinduk->tanggal_kontrak_induk.' </td>
            <td>'. $kontrakinduk->vendors->nama_vendor.' </td>
            <td>'. '
            <div class="d-flex">
            <a href="/kontrak-induk-khs/'.$kontrakinduk->id.'/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="modal" data-target="#deleteModal{{ $vendor->id }}"><i class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
            '.'</td>
            </tr>';
       }

       return response($output);
    }

    public function checkKontrakInduk(Request $request) {
        $nomor_kontrak_induk = $request->post('nomor_kontrak_induk');
        $check_nomor_kontrak_induk = KontrakInduk::where('nomor_kontrak_induk', $nomor_kontrak_induk)->get();

        if(count($check_nomor_kontrak_induk) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkKontrakInduk_edit(Request $request) {
        $nomor_kontrak_induk = $request->post('nomor_kontrak_induk');
        $old_kontrak_induk = $request->post('old_kontrak_induk');
        $check_nomor_kontrak_induk = KontrakInduk::where('nomor_kontrak_induk', $nomor_kontrak_induk)->get();

        if(count($check_nomor_kontrak_induk) > 0) {
            if($check_nomor_kontrak_induk[0]->nomor_kontrak_induk == $old_kontrak_induk) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(true);
        }
    }
}
