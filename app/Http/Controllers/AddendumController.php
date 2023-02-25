<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addendum;
use App\Imports\AddendumImport;
use App\Imports\MultiAddendumImport;
use App\Exports\AddendumExport;
use App\Models\KontrakInduk;
use App\Models\Khs;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use RealRashid\SweetAlert\Facades\Alert;


class AddendumController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.addendum_khs.addendum_khs', [
            'title' => 'Addendum',
            'active' => 'Addendum',
            'active1' => 'Addendum KHS',
            'addendums' => Addendum::whereHas('kontrak_induks', function($q) {
                $q->whereHas('Khs', function($q) {
                    $q->where('isActive', True);
                });
            })->orderBy('id', 'DESC')->get(),
            'kontrakinduks' => KontrakInduk::all(),
            'khss' => Khs::all(),
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


    public function export()
    {
        $sheets = ['Tabel Addendum KHS'];

        return Excel::download(new AddendumExport($sheets), 'Template Addendum KHS.xlsx');
    }
    function import(Request $request)
    {

        $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $import = new MultiAddendumImport();
        $import->onlySheets(0);
        Excel::import($import, $request->file('select_file')->store('temp'));

        Alert::success('Import Telah Berhasil');

        return redirect('/addendum-khs');
    }


    public function store(Request $request)
    {
        if(count($request->file()) > 0) {
            $filename_addendum = time().'_'.$request->file('pdf_file')->getClientOriginalName();
            $pdf_file = $request->file('pdf_file')->storeAs('storage/addendum-po', $filename_addendum, 'public');

            $addendum = [
                'kontrak_induk_id' => $request->kontrak_induk_id,
                'nomor_addendum' => $request->nomor_addendum,
                'tanggal_addendum' => $request->tanggal_addendum,
                'pdf_file' => $filename_addendum,
            ];
            // dd($addendum);

            Addendum::create($addendum);
            return response()->json($addendum);
        } else {
            $addendum = [
                'kontrak_induk_id' => $request->kontrak_induk_id,
                'nomor_addendum' => $request->nomor_addendum,
                'tanggal_addendum' => $request->tanggal_addendum,
                'pdf_file' => null,
            ];
            // dd($addendum);

            Addendum::create($addendum);
            return response()->json($addendum);
        }
        // dd($request);
        // $validatedData = $request->validate([

        //     'kontrak_induk_id' => 'required',
        //     'nomor_addendum' => 'required',
        //     'tanggal_addendum' => 'required',

        // ]);
        // Addendum::create($validatedData);
        // return redirect('/addendum-khs')->with('success', 'Addendum Berhasil Ditambahkan');
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

        // dd($data);
        if($addendums->kontrak_induks->khs->isActive == True){
            return view('khs.detail_khs.addendum_khs.edit_addendum', $data);
        }else{
            Alert::error('Mohon Maaf', 'Halaman Tidak Tersedia');

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        if(count($request->file()) > 0) {
            $filename_addendum = time().'_'.$request->file('pdf_file')->getClientOriginalName();
            $pdf_file = $request->file('pdf_file')->storeAs('storage/addendum-po', $filename_addendum, 'public');

            $addendum = [
                'kontrak_induk_id' => $request->kontrak_induk_id,
                'nomor_addendum' => $request->nomor_addendum,
                'tanggal_addendum' => $request->tanggal_addendum,
                'pdf_file' => $filename_addendum,
            ];
            // dd($addendum);
            $addendums = Addendum::findOrFail($id);
            $addendums->update($addendum);
            // Addendum::create($addendum);
            return response()->json($addendums);
        } else {
            $addendum = [
                'kontrak_induk_id' => $request->kontrak_induk_id,
                'nomor_addendum' => $request->nomor_addendum,
                'tanggal_addendum' => $request->tanggal_addendum,
                'pdf_file' => null,
            ];
            // dd($addendum);

            // Addendum::create($addendum);
            $addendums = Addendum::findOrFail($id);
            $addendums->update($addendum);
            return response()->json($addendums);
        }
        // $request->validate([
        //     'kontrak_induk_id' => 'required',
        //     'nomor_addendum' => 'required',
        //     'tanggal_addendum' => 'required',
        // ]);

        // $addendums = Addendum::findOrFail($id);

        // $input = $request->all();
        // $addendums->update($input);


    }

     public function destroy(Addendum $Addendum, $id)
    {
        // dd($id);
        $Addendum = Addendum::find($id);
        $Addendum->delete();

        return response()->json([
            'success'   => true
        ]);
    }



    public function filteraddendum(Request $request)
    {

        $kontrak_induk_id = $request->kontrak_induk_id;

        if ($kontrak_induk_id == ""){
            $addendums = Addendum::orderby('id', 'DESC')->get();
        }
        else{
            $addendums = Addendum::where('kontrak_induk_id', $kontrak_induk_id)->get();
        }
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

    public function checkAddendum(Request $request) {
        $nomor_addendum = $request->post('nomor_addendum');
        $check_nomor_addendum = Addendum::where('nomor_addendum', $nomor_addendum)->get();

        if(count($check_nomor_addendum) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkAddendum_edit(Request $request) {
        $nomor_addendum = $request->post('nomor_addendum');
        $old_nomor_addendum = $request->post('old_nomor_addendum');
        $check_nomor_addendum = Addendum::where('nomor_addendum', $nomor_addendum)->get();

        if(count($check_nomor_addendum) > 0) {
            if($check_nomor_addendum[0]->nomor_addendum == $old_nomor_addendum) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(true);
        }
    }

    public function download_addendum($id) {
        $addendum_file = Addendum::where('id', $id)->value('pdf_file');
        // dd($addendum_file);
        if($addendum_file == null) {
            Alert::error('Download Gagal', 'File PDF Tidak Tersedia');

            return back();
        } else {
            return Storage::download('public/storage/addendum-po/'.$addendum_file);
        }
        // dd($addendum_file);
    }
}
