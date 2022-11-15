<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        return view('khs.detail_khs.vendor_khs.vendor_khs', [
            'title' => 'Vendor KHS',
            'vendors' => Vendor::all(),
            // 'kontrak' => Vendor::all(),
        ]);
        
    }

    public function create()
    {        

        return view(
            'khs.detail_khs.vendor_khs.buat_vendor',
            [
                'title' => 'Buat Vendor',
                'active' => 'Vendor',
                'active1' => 'Tambah Vendor',
                // 'items' => ItemRincianInduk::all(),
            ]
        );
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([

            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'alamat_kantor_1' => 'required',
            'alamat_kantor_2' => 'required',
            'no_rek_1' => 'required',
            'nama_bank_1' => 'required',
            'no_rek_2' => 'required',
            'nama_bank_2' => 'required',
            'npwp' => 'required',

        ]);
        Vendor::create($validatedData);
        return redirect('/vendor-khs')->with('success', 'Vendor Berhasil Ditambahkan');
    }

    public function edit($id)

    {
        $vendors = Vendor::findOrFail($id);

        $data = [
            'vendors'  => $vendors,
            'title' => 'Vendor',
            'active' => 'Vendor',
            'active1' => 'Edit Vendor',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];
        return view('khs.detail_khs.vendor_khs.edit_vendor', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_vendor' => 'required',
            'nama_direktur' => 'required',
            'alamat_kantor_1' => 'required',
            'alamat_kantor_2' => 'required',
            'no_rek_1' => 'required',
            'nama_bank_1' => 'required',
            'no_rek_2' => 'required',
            'nama_bank_2' => 'required',
            'npwp' => 'required',

        ]);

        $vendors = Vendor::findOrFail($id);

        $input = $request->all();
        $vendors->update($input);

        return redirect('/vendor-khs')->with('status', 'Vendor KHS Berhasil Diedit.');

        // $validatedData = $request->validate($rules);
        // RincianInduk::where('id', $rincianInduk->id)->update($validatedData);
        // return redirect('/rincian')->with('success', 'has been edited');


        // $rincianInduk->update([

        //     'nama_item' => $request['nama_item'],
        //     'satuan' => $request['satuan'],
        //     'kontraks_id' => $request['kontraks_id'],
        //     'harga_satuan' => $request['harga_satuan'],

        // ]);
    }
}    
