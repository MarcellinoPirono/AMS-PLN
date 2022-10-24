<?php

namespace App\Http\Controllers;

use App\Models\Prk;
use App\Http\Requests\StorePrkRequest;
use App\Http\Requests\UpdatePrkRequest;

class PrkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prk.index', [
            'title' => 'PRK',
            'title1' => 'PRK',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prk.create', [
            'title' => 'PRK',
            'title1' => 'PRK',
            'active' => 'PRK',
            'active1' => 'Tambah PRK'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePrkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function show(Prk $prk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function edit(Prk $prk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePrkRequest  $request
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrkRequest $request, Prk $prk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prk  $prk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prk $prk)
    {
        //
    }
}
