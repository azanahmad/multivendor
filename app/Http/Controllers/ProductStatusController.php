<?php

namespace App\Http\Controllers;

use App\Product_status;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
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
     * @param  \App\Product_status  $product_status
     * @return \Illuminate\Http\Response
     */
    public function show(Product_status $product_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_status  $product_status
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_status $product_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_status  $product_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_status $product_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_status  $product_status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_status $product_status)
    {
        //
    }
}
