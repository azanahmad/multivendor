<?php

namespace App\Http\Controllers;

use App\customer;
use App\order;
use App\order_line_items;
use App\OrderPayments;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function __construct()
    {
//        $this->apicontext = new  \PayPal\Rest\ApiContext(
//            new \PayPal\Auth\OAuthTokenCredential(
//                'AZPsITqkKResvbPmLfS73RL8On2yH0o58eLp1xGUPthmhqR6qmacVW8Swl6zI0-4C7LsZuIdHNi7Piws',     // ClientID
//                'ENaJ8k_F_6F3x9pG63XhUuOaISgb_c-yvFFRTULMZpXQsVmtQVQHyU20SlcSo5YKKKxU-7HseIwFnCjQ'// ClientSecret
//            )
//        );

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
            $vendor= DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.id','users.name','users.email','users.package')
            ->where('model_has_roles.role_id','=','2')
            ->get();
      return view('vendor.vendor_list')->with(['vendor'=>$vendor]);

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
    public function update(Request $request, $id)
    {
        //
    }

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

    function history($id)
    {
        $product=Product::where('vendor_id',$id)->get();

        $array = [];

        foreach ($product as $product1)
        {

            array_push($array, [$product1->shopify_id]);

        }

        $orders=order_line_items::whereIn('shopify_product_id',$array)->get();

        $payments = DB::table('order_line_items')
            ->select(DB::raw('sum(price) as total,order_id'))
            ->whereIn('shopify_product_id',$array)
            ->groupBy('order_id')->get();

        $status = DB::table('order_line_items')
            ->select(DB::raw('fulfillment_status,order_id'))
            ->whereIn('shopify_product_id',$array)
            ->groupBy('order_id','fulfillment_status')->get();

        $status_payment = DB::table('order_line_items')
            ->select(DB::raw('payment_status,order_id'))
            ->whereIn('shopify_product_id',$array)
            ->groupBy('order_id','payment_status')->get();


        $total_amount = DB::table('order_line_items')
            ->select(DB::raw('sum(price) as total_price'))
            ->whereIn('shopify_product_id',$array)
            ->where('payment_status','=',0)
            ->where('fulfillment_status','=','fulfilled')->sum('price');

        $array1 = [];

        foreach ($orders as $order)
        {
            array_push($array1, $order->order_id);

        }

        $array=(array_unique($array1));


        $orders_customer=order::whereIn('id',$array)->get();


        $array_customer=[];
        foreach ($orders_customer as $order)
        {
            array_push($array_customer, $order->customer_id);

        }



        $array_customer=(array_unique($array_customer));


        $customer=customer::whereIn('id',$array_customer)->get();



        $order_new=order::whereIn('id',$array)->paginate(30);

        $product=Product::where('vendor_id',$id)->get();


        $order_payment=OrderPayments::where('vendor_id',$id)->OrderBy('created_at','DESC')->get();


        $user=User::find($id);

        return view('admin.vendor_history')->with([
            'orders'=>$order_new,
            'payments'=>$payments,
            'products'=>$product,
            'user'=>$user,
            'status'=>$status,
            'total_amount'=>$total_amount,
            'status_payment'=>$status_payment,
            'order_payments' =>$order_payment,
            'customer'=>$customer

        ]);
    }
}
