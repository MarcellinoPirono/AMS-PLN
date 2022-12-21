<?php

namespace App\Http\Controllers;

use App\Models\Hpe;
use App\Models\Skk;
use App\Models\Prk;
use App\Models\RincianInduk;
use App\Models\ItemRincianInduk;
use App\Models\Rab;
use Illuminate\Http\Request;

class HpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hpe.index', [
            'title' => 'HPE',
            'title1' => 'HPE',
            'hpes' => Hpe::orderBy('id', 'DESC')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'hpe.create',
            [
                'active1' => 'Buat HPE',
                'title' => 'HPE',
                'title1' => 'HPE',
                'active' => 'HPE',
                'skks' => Skk::all(),
                'prks' => Prk::all(),
                'categories' => ItemRincianInduk::all(),
                'items' => RincianInduk::all(),
                'rabs' => Rab::all(),
            ]
        );
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function show(Hpe $hpe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function edit(Hpe $hpe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hpe $hpe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hpe  $hpe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hpe $hpe)
    {
        //
    }
}
