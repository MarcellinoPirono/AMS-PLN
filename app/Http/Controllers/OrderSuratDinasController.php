<?php

namespace App\Http\Controllers;

use App\Models\OrderSuratDinas;
use App\Http\Requests\StoreOrderSuratDinasRequest;
use App\Http\Requests\UpdateOrderSuratDinasRequest;

class OrderSuratDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderSuratDinasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderSuratDinasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderSuratDinas  $orderSuratDinas
     * @return \Illuminate\Http\Response
     */
    public function show(OrderSuratDinas $orderSuratDinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderSuratDinas  $orderSuratDinas
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderSuratDinas $orderSuratDinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderSuratDinasRequest  $request
     * @param  \App\Models\OrderSuratDinas  $orderSuratDinas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderSuratDinasRequest $request, OrderSuratDinas $orderSuratDinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderSuratDinas  $orderSuratDinas
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderSuratDinas $orderSuratDinas)
    {
        //
    }
}
