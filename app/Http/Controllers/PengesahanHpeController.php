<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hpe;
use App\Models\NonPo;

class PengesahanHpeController extends Controller
{
    //
    public function index()
    {
        return view('hpe.pengesahan_hpe', [
            'title' => 'Pengesahan HPE',
            'title1' => 'Pengesahan HPE',
            // 'nonpos'=> NonPo::all(),
            'hpes' => NonPo::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // $request->validate([

        //     'khs_id' => 'required',
        //     'nomor_kontrak_induk' => 'required',
        //     'tanggal_kontrak_induk' => 'required',
        //     'vendor_id' => 'required',
        // ]);

        $status = 3;
        $non_po = NonPo::where('id', $id)->update(array('status' => $status));

        // return redirect('/pengesahan-hpe')->with('status', 'Non PO Berhasil Disahkan.');
        return response()->json([
            'result' => $non_po,
        ]);
    }
}
