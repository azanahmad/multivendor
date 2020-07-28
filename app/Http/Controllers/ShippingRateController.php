<?php

namespace App\Http\Controllers;

use App\Shipping_rate;
use Illuminate\Http\Request;

class ShippingRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



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
     * @param  \App\Shipping_rate  $shipping_rate
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping_rate $shipping_rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping_rate  $shipping_rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping_rate $shipping_rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping_rate  $shipping_rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping_rate $shipping_rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping_rate  $shipping_rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping_rate $shipping_rate)
    {
        //
    }
}
