<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKhsRequest;

class KhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('khs.detail_khs.jenis_khs.jenis_khs', [
            'title' => 'Jenis KHS',
            'khss' => Khs::orderBy('id', 'DESC')->get(),
        ]);

    }
    // public function index()
    // {
    //     return view('khs.detail_khs.jenis_khs.jenis_khs', [
    //         'title' => 'Jenis KHS',
    //         'khss' => Khs::all(),
    //     ]);

    // }

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
    public function store(StoreKhsRequest $request)
    {
        // dd($request);
        $validatedData = $request->validate([

            'jenis_khs' => 'required',
            'nama_pekerjaan' => 'required',

        ]);
        Khs::create($validatedData);
        return redirect('/jenis-khs')->with('success', 'Jenis KHS Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function show(Khs $khs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function edit(Khs $khs, $id)
    {
        $khs = Khs::find($id);

        return response()->json([
            'result' => $khs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Khs $khs, $id)
    {
        // $khs = Khs::select('id')->where('jenis_khs', $request->khs_id)->get();
        // $itemRincianInduk = Khs::where('id', $id)->get();
        // $itemRincianInduk[0]->nama_kategori = $request->nama_kategori;
        // $itemRincianInduk[0]->khs_id = $khs[0]->id;
        // $itemRincianInduk[0]->update();
        // return response()->json(['success' => true]);

        // dd($request);

        $request->validate([


            'jenis_khs' => 'required',
            'nama_pekerjaan' => 'required',

        ]);

        $khs = Khs::findOrFail($id);

        $input = $request->all();
        $khs->update($input);
        return response()->json(['success' => true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Khs $khs, $id)
    {
        $khs = Khs::find($id);
        // $khs->rincian_induks()->delete();
        $khs->delete();
        return response()->json([
            'success'   => true
        ]);

    }
    public function searchjeniskhs(Request $request)
    {
        $output ="";


        $khss = Khs::where('jenis_khs', 'LIKE', '%'. $request->search.'%')->orWhere('nama_pekerjaan', 'LIKE', '%' . $request->search . '%')->paginate(2);

        $nomor = 0;

       foreach($khss as $khs){
        $nomor = $nomor + 1;
        $output.=
            '<tr>
            <input type="hidden" class="delete_id" value='. $khs->id .'>
            <td>'. $nomor.'</td>
            <td>'. $khs->jenis_khs.' </td>
            <td>'. $khs->nama_pekerjaan.' </td>
            <td>'. '
            <div class="d-flex">
            <button onclick="editCategories(' . $khs->id . ')" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></button>
            <button onclick="deleteCategories(' . $khs->id . ')" class="btn btn-danger shadow btn-xs sharp btndelete"><i class="fa fa-trash"></i></button></div>
            '.'</td>
            </tr>';

       }

       return response($output);
    }

    public function checkJenisKhs(Request $request) {
        $jenis_khs = $request->post('jenis_khs');
        $check_jenis_khs = Khs::where('jenis_khs', $jenis_khs)->get();

        if(count($check_jenis_khs) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkJenisKhs_edit(Request $request) {
        $jenis_khs = $request->post('edit_jenis_khs');
        $check_jenis_khs = Khs::where('jenis_khs', $jenis_khs)->get();

        if(count($check_jenis_khs) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
