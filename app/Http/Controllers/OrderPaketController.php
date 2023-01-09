<?php

namespace App\Http\Controllers;

use App\Models\OrderPaket;
use App\Http\Requests\StoreOrderPaketRequest;
use App\Http\Requests\UpdateOrderPaketRequest;

class OrderPaketController extends Controller
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
     * @param  \App\Http\Requests\StoreOrderPaketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderPaketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderPaket  $orderPaket
     * @return \Illuminate\Http\Response
     */
    public function show(OrderPaket $orderPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderPaket  $orderPaket
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderPaket $orderPaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderPaketRequest  $request
     * @param  \App\Models\OrderPaket  $orderPaket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderPaketRequest $request, OrderPaket $orderPaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderPaket  $orderPaket
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderPaket $orderPaket)
    {
        //
    }
}
