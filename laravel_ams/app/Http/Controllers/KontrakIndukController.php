<?php

namespace App\Http\Controllers;

use App\Models\KontrakInduk;
use App\Models\Khs;
use App\Models\Vendor;
use App\Imports\KontrakIndukImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;


class KontrakIndukController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.kontrak_induk_khs.kontrak_induk', [
            'title' => 'Kontrak Induk KHS',
            'khss' => Khs::all(),
            'kontrakinduks' => KontrakInduk::all(),
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

    $file = $request->file('select_file');
    $nama_file = rand().$file->getClientOriginalName();
    $file->move('file_kontrak_induk', $nama_file);


    $import = Excel::import(new KontrakIndukImport, public_path('/file_kontrak_induk/'.$nama_file));

    // Session::flash('sukses','Data Siswa Berhasil Diimport!');

    //  dd($import);

    //  dd($data);

    //  if($data->count() > 0)
    //  {
    //   foreach($data->toArray() as $key => $value)
    //   {
    //    foreach($value as $row)
    //    {
    //     $insert_data[] = array(
    //      'khs_id'  => $row['khs_id'],
    //      'kategori'   => $row['kategori'],
    //      'nama_item'   => $row['nama_item'],
    //      'satuan_id'    => $row['satuan_id'],
    //      'harga_satuan'  => $row['harga_satuan'],
    //     );
    //    }
    //   }

    //   if(!empty($insert_data))
    //   {
    //    DB::table('rincian_induks')->insert($insert_data);
    //   }
    //  }
    //  dd($insert_data);
    return redirect('/kontrak-induk-khs');
    //  return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function store(Request $request)
    {
        // dd($request);

        $validatedData = $request->validate([

            'khs_id' => 'required',
            'nomor_kontrak_induk' => 'required',
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
        return view('khs.detail_khs.kontrak_induk_khs.edit_kontrak_induk_khs', $data);
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


}
