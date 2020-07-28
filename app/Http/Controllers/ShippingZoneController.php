<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shipping_rate;
use App\Shipping_zone;
use App\Vareint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingZoneController extends Controller
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


    public function shipping()
    {
        $products=Product::all();
        $shipping=Shipping_zone::all();
        $shipping_rate=Shipping_rate::all();
        return view('admin/shipping_zone')->with(['products'=>$products,'shippings'=>$shipping,'shipping_rate',$shipping_rate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipping_create(Request $request)
    {
//       $string= implode(',',$request->countries);
//       $arr[] ='';
//        array_push($arr,$string);
//        array_shift($arr);
        foreach($request->countries as $country)
        {
            $data[] = $country;
        }
            $shipping = new Shipping_zone();
            $shipping->product_id = $request->product_id;
            $shipping->title = $request->title;
            $shipping->countries = json_encode($data);
            $shipping->save();

        return back()->with('message','Shipping zone added successfully');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shipping_rate_add(Request $request)
    {
       $rate= new Shipping_rate();
       $rate->shipping_zone_id =$request->shipping_id;
        $rate->product_id =$request->product_id;
       $rate->title =$request->title;
       $rate->rate_type =$request->type;
       $rate->price =$request->price;
       $rate->shipping_time =$request->shipping_time;
       $rate->processing_time=$request->processing_time;
       $rate->save();
       return back()->with('message','Shipping rate added sucessfullly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping_zone  $shipping_zone
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping_zone $shipping_zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping_zone  $shipping_zone
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping_zone  $shipping_zone
     * @return \Illuminate\Http\Response
     */
    public function shipping_update(Request $request,$id)
    {
        foreach($request->countries as $country)
        {
            $data[] = $country;
        }
        $shipping = Shipping_zone::find($id);
        $shipping->product_id = $request->product_id;
        $shipping->title = $request->title;
        $shipping->countries = json_encode($data);
        $shipping_update =$shipping->save();
        if($shipping_update)
        {
            return  back()->with('message','Shippig zone update successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping_zone  $shipping_zone
     * @return \Illuminate\Http\Response
     */
    public function rate_update(Request $request)
    {
        $shipping_rate = Shipping_rate::find($request->rate_id);
        $shipping_rate->shipping_zone_id = $request->shipping_id;
        $shipping_rate->product_id =$request->product_id;
        $shipping_rate->title = $request->title;
        $shipping_rate->rate_type = $request->type;
        $shipping_rate->price = $request->price;
        $shipping_rate->shipping_time = $request->shipping_time;
        $shipping_rate->processing_time = $request->processing_time;
        $shipping_rate_update=$shipping_rate->save();
        if($shipping_rate_update)
        {
            return  back()->with('message','Shippig rate update successfully');
        }
    }
    public function shipping_delete($id)
    {
        $shipping = Shipping_zone::find($id);
        $shipping->delete();
        return redirect()->back()->with('message', 'Shipping zone Deleted  Successfully');
    }
    public function rate_delete($id)
    {
        $shipping_rate = Shipping_rate::find($id);
        $shipping_rate->delete();
        return redirect()->back()->with('message', 'Shipping zone Deleted  Successfully');
    }

}
