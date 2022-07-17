<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepriceRequest;
use App\Http\Requests\UpdatepriceRequest;
use App\Models\price;

class PriceController extends Controller
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
     * @param  \App\Http\Requests\StorepriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepriceRequest  $request
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepriceRequest $request, price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(price $price)
    {
        //
    }
}
