<?php

namespace App\Http\Controllers;

use App\Models\PaketPekerjaan;
use App\Models\KontrakInduk;
use App\Models\RincianInduk;
use App\Models\Khs;
use App\Http\Requests\StorePaketPekerjaanRequest;
use App\Http\Requests\UpdatePaketPekerjaanRequest;
use Illuminate\Http\Request;
// use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;


use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class PaketPekerjaanController extends Controller
{
    // use SlugService;{{  }}{{  }}{{  }}{{  }}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jenis_khs(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        // dd($jenis_khs);
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');

        // dd($khs_id);

        // $paket_pekerjaans= PaketPekerjaan::orderBy('id', 'ASC');

        // $nama_paket = DB::table(DB::raw("({$paket_pekerjaans->toSql()}) as paket_pekerjaans"))->select('nama_paket')->where('khs_id', $khs_id)->groupBy('nama_paket')->get();
        $nama_paket = PaketPekerjaan::select('created_at','nama_paket', 'slug')->where('khs_id', $khs_id)->orderBy('created_at', 'DESC')->groupBy('created_at', 'nama_paket', 'slug')->get();
        // $paket = PaketPekerjaan::where('khs_id', $khs_id)->get();
        // dd($paket);



        // $sasa = PaketPekerjaan::where('khs_id', $khs_id)->get();
        // dd($sasa);



        return view('paket-pekerjaan.paket_pekerjaan', [
            'title' => 'Paket Pekerjaan KHS '.$jenis_khs.'',
            'pakets' => PaketPekerjaan::where('khs_id', $khs_id)->get(),
            'jenis_khs' => $jenis_khs,
            'nama_paket' => $nama_paket
        ]);
    }


    public function DataTable(Request $request)
    {
        $jenis_khs = $request->jenis_khs;
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        $items = RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get();
        // $count_item =;

        // if ($request->ajax()) {
            // dd($jenis_khs);

            // $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
            // $items = RincianInduk::where('khs_id', $khs_id)->get();
            // $data =RincianInduk::where('khs_id', $khs_id)->join('satuans', 'rincian_induks.satuan_id', 'satuans.id')->select('rincian_induks.*', 'satuans.singkatan')->get();

            // return Datatables::of($data)->addIndexColumn()
            // ->addColumn('action', function($data){
            //     $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
            //     $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
            //     return $button;
            // })
            // ->addColumn('checkbox', '<input type="checkbox" name="item_id[]" class="" value="{{$id}}" />')
            // ->rawColumns(['checkbox','action'])
            // ->make(true);
        // }
        // dd($jenis_khs);
        // $jenis_khs = $request->jenis_khs;

        return view(
            'paket-pekerjaan.buat_paket_pekerjaan',
            [
                'title' => 'Buat Paket Pekerjaan ',
                'active' => 'Paket-Pekerjaan',
                'active1' => 'Tambah Paket Pekerjaan ',
                'jenis_khs' => $jenis_khs,
                'items' => $items
            ],
        );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
    //     $jenis_khs = $request->jenis_khs;
    //     $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
    //     $items = RincianInduk::where('khs_id', $khs_id)->get();

    //     return view(
    //         'paket-pekerjaan.buat_paket_pekerjaan',
    //         [
    //             'title' => 'Buat Paket Pekerjaan '.$jenis_khs.'',
    //             'active' => 'Paket-Pekerjaan',
    //             'active1' => 'Tambah Paket Pekerjaan '.$jenis_khs.'',
    //             'items' => $items
    //         ]
    //     );

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaketPekerjaanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaketPekerjaanRequest $request)
    {
        // dd($request);
        // $jenis_khs = $request->jenis_khs;
        $jenis_khs = $request->khs_id;
        // dd($jenis_khs);
        $khs_id = Khs::select('id')->where('jenis_khs', $jenis_khs)->get();
        // dd($khs_id);


        $request->validate([

            'nama_paket' => 'required|max:250',
            'item_id' => 'required',
            'khs_id' => 'required',
            'volume' => 'required',
            'jumlah_harga' => 'required',


        ]);

        $banyak_item = count($request->item_id);


        for($j=0; $j < $banyak_item; $j++){
            $paket_pekerjaan_data = [
                "nama_paket"=>$request->nama_paket,
                "slug"=>$request->slug,
                "khs_id"=>$request["khs_id"] = $khs_id[0]->id,
                "item_id"=>$request->item_id[$j],
                "volume"=>$request->volume[$j],
                "jumlah_harga"=>$request->jumlah_harga[$j]
            ];
            PaketPekerjaan::create($paket_pekerjaan_data);
        }


        return response()->json($jenis_khs);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(PaketPekerjaan $paketPekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)

    {
        // dd($request['letter']);
        $jenis_khs = $request->jenis_khs;
        $slug = $request->slug;
        // dd($slug);
        $khs_id = Khs::where('jenis_khs', $jenis_khs)->value('id');
        $items = RincianInduk::where('khs_id', $khs_id)->orderBy('id', 'DESC')->get();

        $nama_paket = PaketPekerjaan::where('slug', $slug)->value('nama_paket');
        $item_id = PaketPekerjaan::where('slug', $slug)->get();
        $item_volumes = PaketPekerjaan::where('slug', $slug)->get('volume');
        // dd($item_volumes);


        $item_array = [];
        // $volume_item_array = [];

        for($i=0; $i < count($item_id); $i++){
            $item_array[$i] = $item_id[$i]->item_id;
            $volume_item_array[$i] = PaketPekerjaan::where('slug', $item_id[$i]->slug)->value('volume');
        }

        // dd($items);
        // dd($volume_item_array);
        // dd($nama_paket);
        // dd($item_id);

        $data = [
            'title' => 'Edit Paket Pekerjaan KHS ' .$jenis_khs. '',
            'active' => 'Paket Pekerjaan',
            'active1' => 'Edit ' . $jenis_khs . '',
            'jenis_khs' => $jenis_khs,
            'items' => $items,
            'nama_paket' => $nama_paket,
            'item_ids' => $item_array,
            // 'item_volumes' => $volume_item_array
            'item_volumes' => $item_id
        ];
        return view('paket-pekerjaan.edit_paket_pekerjaan', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaketPekerjaanRequest  $request
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaketPekerjaanRequest $request, PaketPekerjaan $paketPekerjaan)
    {
        // dd($request);

        $slug = $request->slug;
// dd($slug);
        $jenis_khs = $request->khs_id;
        $khs_id = Khs::select('id')->where('jenis_khs', $jenis_khs)->get();
        // $request["khs_id"] = $khs_id[0]->id;

        $request->validate([

            'nama_paket' => 'required|max:250',
            'item_id' => 'required',
            'khs_id' => 'required',
            'volume' => 'required',
            'jumlah_harga' => 'required',

        ]);

        // dd($validate);

        $banyak_item = count($request->item_id);

        $paketPekerjaan = PaketPekerjaan::where('slug', $slug)->delete();


        for($j=0; $j < $banyak_item; $j++){
            $paket_pekerjaan_data = [
                "nama_paket"=>$request->nama_paket,
                "slug"=>$request->slug,
                "khs_id"=>$request["khs_id"] = $khs_id[0]->id,
                "item_id"=>$request->item_id[$j],
                "volume"=>$request->volume[$j],
                "jumlah_harga"=>$request->jumlah_harga[$j]
            ];
            PaketPekerjaan::create($paket_pekerjaan_data);
        }

        return response()->json($jenis_khs);


        // $input = $request->all();
        // $paket->update($input);






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketPekerjaan  $paketPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        // dd($request);

        $slug = $request->slug;

        $paketPekerjaan = PaketPekerjaan::where('slug', $slug)->delete();

        // dd($paketPekerjaan);

        // $paketPekerjaan->delete();

    }

    public function getPaketPekerjaan(Request $request){
        $kontrak_induk_id = $request->post('kontrak_induk');
        $khs_id = KontrakInduk::where('id', $kontrak_induk_id)->value('khs_id');

        $klasifikasipaket = DB::table('klasifikasi_pakets')->where('khs_id', $khs_id)->get();

        $paket_pekerjaan = PaketPekerjaan::select('nama_paket')->where('khs_id', $khs_id)->groupBy('nama_paket')->get();


        $data = [
            'klasifikasis' => $klasifikasipaket,
            'paket_pekerjaan' => $paket_pekerjaan,

        ];

        // dd($data);




        return response()->json($data);
    }

    // public function checkSlug(Request $request){

    //     dd($request);

    //     $slug = SlugService::createSlug(PaketPekerjaan::class, 'slug', $request->nama_paket);
    //     return response()->json([
    //         'slug' => $slug

    //     ]);

    // }



}
