<?php

namespace App\Http\Controllers;

use App\Models\RedaksiNotaDinas;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRedaksiNotaDinasRequest;
use App\Http\Requests\UpdateRedaksiNotaDinasRequest;

class RedaksiNotaDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('non-po.redaksi_nota.redaksi_khs', [
            'title' => 'Redaksi NON-PO',
            // 'khss' => Khs::all(),
            'redaksis' => RedaksiNotaDinas::orderBy('id', 'DESC')->get(),
        ]);

    }

    public function create()
    {

        return view(
            'non-po.redaksi_nota.buat_redaksi_khs',
            [
                'title' => 'Buat Redaksi',
                'active' => 'Redaksi',
                'active1' => 'Tambah Redaksi',
                // 'items' => ItemRincianInduk::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        // dd($request);
        $redaksisdata = $request->validate([

            'nama_redaksi' => 'required',
            'deskripsi_redaksi' => 'required',
        ]);
        RedaksiNotaDinas::create($redaksisdata);

        return redirect('/redaksi-nota-dinas')->with('success', 'Redaksi Berhasil Ditambahkan');

        // dd($sub_redaksi);


    }

    public function edit($id)

    {
        $redaksi = RedaksiNotaDinas::findOrFail($id);

        return view('non-po.redaksi_nota.edit_redaksi_khs', [
            'redaksis'  => $redaksi,
            'title' => 'Redaksi',
            'active' => 'Redaksi',
            'active1' => 'Edit Redaksi',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'nama_redaksi' => 'required',
            'deskripsi_redaksi' => 'required',
        ]);

        $redaksi = RedaksiNotaDinas::findOrFail($id);

        $redaksi->update($input);

        $sub_redaksi_id = [];

        $clicksubdeskripsi = $request->clicksubdeskripsi;

        $sub_redaksi_all_id = SubRedaksiNotaDinas::where('redaksi_id', $id)->get('id');
        // dd($sub_redaksi_all_id);
        $sub_redaksi_all_id_length = count($sub_redaksi_all_id);


        for($i=0; $i<$sub_redaksi_all_id_length; $i++){
            $sub_redaksi_id[$i] = $sub_redaksi_all_id[$i]->id;
        }

        // dd($sub_redaksi_id);

        for($j=0; $j < $sub_redaksi_all_id_length; $j++){
            // $isi_awal_sub_redaksi = SubRedaksiNotaDinas::where('redaksi_id', $id)->get();
            SubRedaksiNotaDinas::where('id', $sub_redaksi_id[$j])->delete();

            // SubRedaksiNotaDinas::where('id', $sub_redaksi_id[$j])->updateOrCreate($sub_redaksi);
            // SubRedaksiNotaDinas::where('redaksi_id', $id)->updateOrCreate($isi_awal_sub_redaksi[$j]->toArray(), $sub_redaksi);
            // SubRedaksiNotaDinas::create($sub_redaksi);
        }

        for($k=0; $k < $clicksubdeskripsi; $k++){
            $sub_redaksi = [
                'redaksi_id' => $id,
                'sub_deskripsi' => $request->sub_deskripsi[$k][0]
            ];
            SubRedaksiNotaDinas::create($sub_redaksi);
        }

    }

    public function checkRedaksi(Request $request) {
        $nama_redaksi = $request->post('nama_redaksi');
        $check_nama_redaksi = RedaksiNotaDinas::where('nama_redaksi', $nama_redaksi)->get();

        if(count($check_nama_redaksi) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkRedaksi_edit(Request $request) {
        $nama_redaksi = $request->post('nama_redaksi');
        $old_nama_redaksi = $request->post('old_nama_redaksi');
        $check_nama_redaksi = RedaksiNotaDinas::where('nama_redaksi', $nama_redaksi)->get();

        if(count($check_nama_redaksi) > 0) {
            if($check_nama_redaksi[0]->nama_redaksi == $old_nama_redaksi) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(true);
        }
    }
}
