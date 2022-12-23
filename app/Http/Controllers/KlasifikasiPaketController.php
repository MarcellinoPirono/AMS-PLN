<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiPaket;
use App\Models\Khs;
use Illuminate\Http\Request;

class KlasifikasiPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');

        // $klasifikasi = KlasifikasiPaket::where('khs_id', $khs_id)->get("nama_klasifikasi");
        // $kepanjangan = KlasifikasiPaket::where('khs_id', $khs_id)->get("kepanjangan");

        // dd($klasifikasi);

        return view('paket-pekerjaan.klasifikasi_paket', [
            'title' => 'Klasifikasi Paket Pekerjaan '. $jenis_khs.'',
            'klasifikasis' => KlasifikasiPaket::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get(),
            // 'klasifikasis' => KlasifikasiPaket::paginate(10),
            'jenis_khs' => $jenis_khs,
            // 'klasifikasi' => $klasifikasi,
            // 'kepanjangan' => $kepanjangan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $jenis_khs = $request->khs_id;
        $khs_id = Khs::select('id')->where('jenis_khs', $jenis_khs)->get();
        $request["khs_id"] = $khs_id[0]->id;


        // dd($request->khs_id);
        $validatedData = $request->validate([

            'khs_id' => 'required',
            'nama_klasifikasi' => 'required',
            'kepanjangan' => 'required',

        ]);
        KlasifikasiPaket::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KlasifikasiPaket  $klasifikasiPaket
     * @return \Illuminate\Http\Response
     */
    public function show(KlasifikasiPaket $klasifikasiPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KlasifikasiPaket  $klasifikasiPaket
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // dd($request);
        $klasifikasiPaket = KlasifikasiPaket::find($request->id);
        // dd($klasifikasiPaket);


        return response()->json([
            'result' => $klasifikasiPaket,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KlasifikasiPaket  $klasifikasiPaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KlasifikasiPaket $klasifikasiPaket, $id)
    {
        //


        $request->validate([

            'nama_klasifikasi' => 'required',
            'kepanjangan' => 'required',

        ]);

        $paket = KlasifikasiPaket::findOrFail($request->id);

        $input = $request->all();
        $paket->update($input);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KlasifikasiPaket  $klasifikasiPaket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        $id = $request->id;

        $klasifikasiPaket = KlasifikasiPaket::find($id);
        $klasifikasiPaket->delete();



    }
    // public function searchKlasifikasi(Request $request)
    // {
    //     $output ="";


    //     $khss = Khs::where('nama_klasifikasi', 'LIKE', '%'. $request->search.'%')->orWhere('kepanjangan', 'LIKE', '%' . $request->search . '%')->paginate(2);

    //     $nomor = 0;

    //    foreach($khss as $khs){
    //     $nomor = $nomor + 1;
    //     $output.=
    //         '<tr>
    //         <input type="hidden" class="delete_id" value='. $khs->id .'>
    //         <td>'. $nomor.'</td>
    //         <td>'. $klasifikasiPaket->nama_klasifikasi.' </td>
    //         <td>'. $klasifikasiPaket->kepanjangan.' </td>
    //         <td>'. '
    //         <div class="d-flex">
    //         <button onclick="editCategories(' . $klasifikasiPaket->id . ')" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></button>
    //         <button onclick="deleteCategories(' . $klasifikasiPaket->id . ')" class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button></div>
    //         '.'</td>
    //         </tr>';

    //    }

    //    return response($output);
    // }
}
