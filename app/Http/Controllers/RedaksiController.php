<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Redaksi;
use App\Models\SubRedaksi;

class RedaksiController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.redaksi_khs.redaksi_khs', [
            'title' => 'Redaksi KHS',
            // 'khss' => Khs::all(),
            'redaksis' => Redaksi::all(),
        ]);

    }

    public function create()
    {

        return view(
            'khs.detail_khs.redaksi_khs.buat_redaksi_khs',
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
        Redaksi::create($redaksisdata);

        $id_redaksi = Redaksi::where('nama_redaksi', $request->nama_redaksi)->value('id');
        $redaksi_id = [];
        $clicksubdeskripsi = $request->clicksubdeskripsi;

        // dd($clicksubdeskripsi);

        if($clicksubdeskripsi == 0){
            $sub_redaksi = [
                'redaksi_id' => $id_redaksi,
            ];

            // dd($sub_redaksi);
            SubRedaksi::create($sub_redaksi);
            return redirect('/redaksi-khs')->with('success', 'Redaksi Berhasil Ditambahkan');
        }

        else{
            for ($i = 0; $i < $clicksubdeskripsi; $i++) {
                $redaksi_id[$i] = $id_redaksi;
            }

            for($j=0; $j < $clicksubdeskripsi; $j++){

                $sub_redaksi = [
                    'redaksi_id' => $redaksi_id[$j],
                    'sub_deskripsi' => $request->sub_deskripsi[$j][0]
                ];

                // dd($sub_redaksi);
                SubRedaksi::create($sub_redaksi);
            }
            return redirect('/redaksi-khs')->with('success', 'Redaksi Berhasil Ditambahkan');
        }

        // dd($sub_redaksi);


    }

    public function edit($id)

    {
        $redaksi = Redaksi::findOrFail($id);
        $sub_deskripsis = SubRedaksi::where('redaksi_id', $id)->get();

        return view('khs.detail_khs.redaksi_khs.edit_redaksi_khs', [
            'redaksis'  => $redaksi,
            'title' => 'Redaksi',
            'active' => 'Redaksi',
            'active1' => 'Edit Redaksi',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
            ], compact('sub_deskripsis')
        );
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            'nama_redaksi' => 'required',
            'deskripsi_redaksi' => 'required',
        ]);

        $redaksi = Redaksi::findOrFail($id);

        $redaksi->update($input);

        $sub_redaksi_id = [];

        $clicksubdeskripsi = $request->clicksubdeskripsi;

        $sub_redaksi_all_id = SubRedaksi::where('redaksi_id', $id)->get('id');
        // dd($sub_redaksi_all_id);
        $sub_redaksi_all_id_length = count($sub_redaksi_all_id);


        for($i=0; $i<$sub_redaksi_all_id_length; $i++){
            $sub_redaksi_id[$i] = $sub_redaksi_all_id[$i]->id;
        }

        // dd($sub_redaksi_id);

        for($j=0; $j < $sub_redaksi_all_id_length; $j++){
            // $isi_awal_sub_redaksi = SubRedaksi::where('redaksi_id', $id)->get();
            SubRedaksi::where('id', $sub_redaksi_id[$j])->delete();

            // SubRedaksi::where('id', $sub_redaksi_id[$j])->updateOrCreate($sub_redaksi);
            // SubRedaksi::where('redaksi_id', $id)->updateOrCreate($isi_awal_sub_redaksi[$j]->toArray(), $sub_redaksi);
            // SubRedaksi::create($sub_redaksi);
        }

        for($k=0; $k < $clicksubdeskripsi; $k++){
            $sub_redaksi = [
                'redaksi_id' => $id,
                'sub_deskripsi' => $request->sub_deskripsi[$k][0]
            ];
            // dd($sub_redaksi);
            SubRedaksi::create($sub_redaksi);
        }

    }
}
