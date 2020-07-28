<?php

namespace App\Http\Controllers;

use App\ShippingRate;
use App\ShippingRates;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
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
    public function create(Request $request)
    {


        $zone = Zone::create([
            'name' => $request->input('name'),
            'product_id' => $request->input('id')
        ]);
        $zone->has_countries()->attach($request->input('countries'));
        return redirect()->back()->with('message','Zone Successfully Generated!');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function rate_create(Request $request){
        ShippingRates::create($request->all());
        return redirect()->back()->with('message','Rate Successfully Generated!');
    }
    public function update(Request $request){
//       dd($request);
        $zone = Zone::find($request->id);
        $zone->name = $request->input('name');
        $zone->save();
        $zone->has_countries()->sync($request->input('countries'));
        return redirect()->back()->with('message','Zone Successfully Updated!');
    }
    public function delete(Request $request){
        $zone = Zone::find($request->id);
        $zone->has_countries()->detach();
        if(count($zone->has_rate) > 0) {
            foreach ($zone->has_rate as $rate) {
                $rate->delete();
            }
        }
        $zone->delete();
        return redirect()->back()->with('message','Zone Successfully Deleted!');

    }
    public function rate_update(Request $request){
        ShippingRates::find($request->id)->update($request->all());
        return redirect()->back()->with('message','Rate Successfully Updated!');
    }
    public function rate_delete(Request $request){
        ShippingRates::find($request->id)->delete();
        return redirect()->back()->with('message','Rate Successfully Deleted!');
    }
}
