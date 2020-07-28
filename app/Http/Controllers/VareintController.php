<?php

namespace App\Http\Controllers;

use App\Vareint;
use Illuminate\Http\Request;

class VareintController extends Controller
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
     * @param  \App\Vareint  $vareint
     * @return \Illuminate\Http\Response
     */
    public function show(Vareint $vareint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vareint  $vareint
     * @return \Illuminate\Http\Response
     */
    public function edit(Vareint $vareint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vareint  $vareint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vareint $vareint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vareint  $vareint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vareint $vareint)
    {
        //
    }
}
