<?php

namespace App\Http\Controllers;

use App\Models\RincianInduk;
use App\Http\Requests\StoreRincianIndukRequest;
use App\Http\Requests\UpdateRincianIndukRequest;

class RincianIndukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rincian.index', [
            'title' => 'Kontrak Induk'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRincianIndukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRincianIndukRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function show(RincianInduk $rincianInduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function edit(RincianInduk $rincianInduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRincianIndukRequest  $request
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRincianIndukRequest $request, RincianInduk $rincianInduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RincianInduk  $rincianInduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(RincianInduk $rincianInduk)
    {
        //
    }
}
