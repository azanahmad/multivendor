<?php

namespace App\Http\Controllers;

use App\customer;
use App\FulfillmentLineItem;
use App\FulfillmentLineItems;
use App\order_logs;
use App\order;
use App\order_line_items;
use App\OrderFulfillment;
use App\OrderFulfillments;
use App\OrderLog;
use App\Product;
use App\RetailerOrder;
use App\RetailerOrderLineItem;
use App\ShippingRates;
use App\Vareint;
//use App\ShippingRate;
//use App\Zone;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private $helper;

    /**
     * OrderController constructor.
     * @param $helper
     */
    public function __construct()
    {
        $this->helper = new HelperController();
        $this->middleware('auth');
    }

    function index(Request $request)
    {

//        $order=order::paginate(10);
//        return view('admin.orders')->with(['orders'=>$order]);

        $orders  = order::whereIn('paid',[0,1,2])->newQuery();

        if($request->has('search')){
            $orders->where('name','LIKE','%'.$request->input('search').'%');

        }
        $orders = $orders->orderBy('created_at','DESC')->paginate(30);

        return view('admin.orders')->with([
            'orders' => $orders,
            'search' => $request->input('search')
        ]);


    }

    function order_sync($order)
    {

        $product_ids = [];
        $variant_ids  = [];
        foreach($order['line_items'] as $item){
            array_push($variant_ids,$item['variant_id']);
            array_push($product_ids,$item['product_id']);
        }

        dd($product_ids);

        if(Product::whereIn('shopify_id',$product_ids)->exists()){



            if(!order::where('shopify_order_id',$order['id'])->exists()){



                $new = new order();
                $new->shopify_order_id = $order['id'];
                $new->email = $order['email'];
                $new->phone = $order['phone'];
                $new->shopify_created_at = date_create($order->created_at)->format('Y-m-d h:i:s');
                $new->shopify_updated_at =date_create($order->updated_at)->format('Y-m-d h:i:s');
                $new->note = $order['note'];
                $new->name = $order['name'];
                $new->total_price = $order['total_price'];
                $new->subtotal_price = $order['subtotal_price'];
                $new->total_weight = $order['total_weight'];
                $new->taxes_included = $order['taxes_included'];
                $new->total_tax = $order['total_tax'];
                $new->currency = $order['currency'];
                $new->total_discounts = $order['total_discounts'];

                if(isset($order['customer'])){
                    if (customer::where('customer_shopify_id',$order['customer']['id'])->exists()){
                        $customer = customer::where('customer_shopify_id',$order['customer']['id'])->first();
                        $new->customer_id = $customer->id;
                    }
                    else{
                        $customer = new customer();
                        $customer->customer_shopify_id = $order['customer']['id'];
                        $customer->first_name = $order['customer']['first_name'];
                        $customer->last_name = $order['customer']['last_name'];
                        $customer->phone = $order['customer']['phone'];
                        $customer->email = $order['customer']['email'];
                        $customer->total_spent = $order['customer']['total_spent'];
//                                $customer->shop_id = $shop['id'];
//                                $local_shop = $this->helper->getLocalShop();
//                                if(count($local_shop->has_user) > 0){
//                                    $customer->user_id = $local_shop->has_user[0]->id;
//                                }
                        $customer->save();

                        $new->customer_id = $customer['id'];
                    }
                    $new->customer = json_encode($order['customer'],true);
                }
                if(isset($order['shipping_address'])){
                    $new->shipping_address = json_encode($order['shipping_address'],true);
                }

                if(isset($order['billing_address'])){
                    $new->billing_address = json_encode($order['billing_address'],true);
                }

                $new->status = 'new';
//                        $new->shop_id = $shop['id'];
//                        $local_shop = $this->helper->getLocalShop();
//                        if(count($local_shop->has_user) > 0){
//                            $new->user_id = $local_shop->has_user[0]->id;
//                        }

                $new->fulfilled_by = 'store';
                $new->sync_status = 1;
                $new->save();

                $cost_to_pay = 0;

                foreach ($order['line_items'] as $item){
                    $new_line = new order_line_items();
                    $new_line->order_id = $new->id;
                    $new_line->product_variant_id = $item['id'];
                    $new_line->shopify_product_id = $item['product_id'];
                    $new_line->shopify_variant_id = $item['variant_id'];
                    $new_line->title = $item['title'];
                    $new_line->quantity = $item['quantity'];
                    $new_line->sku = $item['sku'];
                    $new_line->variant_title = $item['variant_title'];
                    $new_line->vendor = $item['vendor'];
                    $new_line->price = $item['price'];
                    $new_line->requires_shipping = $item['requires_shipping'];
                    $new_line->taxable = $item['taxable'];
                    $new_line->name = $item['name'];
                    $new_line->payment_status = '0';
                    $new_line->properties = json_encode($item['properties'],true);
                    $new_line->fulfillable_quantity = $item['fulfillable_quantity'];
                    $new_line->fulfillment_status = $item['fulfillment_status'];

                    $retailer_product = Product::where('shopify_id',$item['product_id'])->first();
                    if($retailer_product != null){
                        $new_line->fulfilled_by = 'store';
                        $new_line->vendor_id=$retailer_product->vendor_id;

                        if(isset($order['customer'])) {
                            if (customer::where('customer_shopify_id', $order['customer']['id'])->exists()) {
                                $customer = customer::where('customer_shopify_id', $order['customer']['id'])->first();
                                $customer->vendor_id=$retailer_product->vendor_id;
                                $customer->save();

                            } else {

                                $customer->vendor_id=$retailer_product->vendor_id;
                                $customer->save();

                            }
                        }
                    }
                    else{
                        $new_line->fulfilled_by = 'store';
//                                $vendor_id=$retailer_product->vendor_id;
                    }
                    $related_variant = Vareint::where('shopify_id',$item['variant_id'])->first();
                    if($related_variant != null){
                        $new_line->cost = $related_variant->Price;
                        $cost_to_pay = $cost_to_pay + $related_variant->Price * $item['quantity'];
                    }

                    $new_line->save();
                }
                $new->cost_to_pay = $cost_to_pay;
                $new->save();


//                        if(isset($order->shipping_address)){
//                            $total_weight = 0;
//                            $country = $order->shipping_address->country;
//                            foreach ($new->line_items as $index => $v){
//                                if($v->linked_product != null){
//                                    $total_weight = $total_weight + ( $v->linked_product->weight *  $v->quantity);
//                                }
//                            }
//                            $zoneQuery = Zone::query();
//                            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                                $q->where('name',$country);
//                            });
//                            $zoneQuery = $zoneQuery->pluck('id')->toArray();
//
//                            $shipping_rates = ShippingRates::where('type','weight')->whereIn('zone_id',$zoneQuery)->newQuery();
////                            $shipping_rates->whereRaw('min <='.$total_weight);
////                            $shipping_rates->whereRaw('max >='.$total_weight);
//                            $shipping_rates =  $shipping_rates->first();
//                            if($shipping_rates != null){
//                                if($shipping_rates->min > 0){
//                                    $ratio = $total_weight/$shipping_rates->min;
//                                    $new->shipping_price = $shipping_rates->shipping_price*$ratio;
//                                    $new->total_price =  $order->total_price + $shipping_rates->shipping_price;
//                                    $new->save();
//                                }
//                                else{
//                                    $new->shipping_price = 0;
//                                    $new->save();
//                                }
//
//                            }
//                            else{
//                                $new->shipping_price = 0;
//                                $new->save();
//                            }
//                        }


                /*Maintaining Log*/
                $order_log =  new order_logs();
                $order_log->message = "Order synced to Multivendor on ".date_create($new->created_at)->format('d M, Y h:i a');
                $order_log->status = "Newly Synced";
                $order_log->order_id = $new->id;
                $order_log->save();
            }
        }
    }


    function get_shopify_orders()
    {
        $shop = $this->helper->getShopify();
        $response = $shop->rest('GET', '/admin/api/2019-10/orders.json');
        $orders = $response['body']['orders'];


        if(count($orders) >0){

//            $orders = $response->body->orders;


            foreach ($orders as $index =>$order){


                //$order=new OrdersController();
                $this->order_sync($order);


                die();
                $product_ids = [];
                $variant_ids  = [];
                foreach($order['line_items'] as $item){
                    array_push($variant_ids,$item['variant_id']);
                    array_push($product_ids,$item['product_id']);
                }



                if(Product::whereIn('shopify_id',$product_ids)->exists()){



                    if(!order::where('shopify_order_id',$order['id'])->exists()){



                        $new = new order();
                        $new->shopify_order_id = $order['id'];
                        $new->email = $order['email'];
                        $new->phone = $order['phone'];
                        $new->shopify_created_at = date_create($order->created_at)->format('Y-m-d h:i:s');
                        $new->shopify_updated_at =date_create($order->updated_at)->format('Y-m-d h:i:s');
                        $new->note = $order['note'];
                        $new->name = $order['name'];
                        $new->total_price = $order['total_price'];
                        $new->subtotal_price = $order['subtotal_price'];
                        $new->total_weight = $order['total_weight'];
                        $new->taxes_included = $order['taxes_included'];
                        $new->total_tax = $order['total_tax'];
                        $new->currency = $order['currency'];
                        $new->total_discounts = $order['total_discounts'];

                        if(isset($order['customer'])){
                            if (customer::where('customer_shopify_id',$order['customer']['id'])->exists()){
                                $customer = customer::where('customer_shopify_id',$order['customer']['id'])->first();
                                $new->customer_id = $customer->id;
                            }
                            else{
                                $customer = new customer();
                                $customer->customer_shopify_id = $order['customer']['id'];
                                $customer->first_name = $order['customer']['first_name'];
                                $customer->last_name = $order['customer']['last_name'];
                                $customer->phone = $order['customer']['phone'];
                                $customer->email = $order['customer']['email'];
                                $customer->total_spent = $order['customer']['total_spent'];
//                                $customer->shop_id = $shop['id'];
//                                $local_shop = $this->helper->getLocalShop();
//                                if(count($local_shop->has_user) > 0){
//                                    $customer->user_id = $local_shop->has_user[0]->id;
//                                }
                                $customer->save();

                                $new->customer_id = $customer['id'];
                            }
                            $new->customer = json_encode($order['customer'],true);
                        }
                        if(isset($order['shipping_address'])){
                            $new->shipping_address = json_encode($order['shipping_address'],true);
                        }

                        if(isset($order['billing_address'])){
                            $new->billing_address = json_encode($order['billing_address'],true);
                        }

                        $new->status = 'new';
//                        $new->shop_id = $shop['id'];
//                        $local_shop = $this->helper->getLocalShop();
//                        if(count($local_shop->has_user) > 0){
//                            $new->user_id = $local_shop->has_user[0]->id;
//                        }

                        $new->fulfilled_by = 'store';
                        $new->sync_status = 1;
                        $new->save();

                        $cost_to_pay = 0;

                        foreach ($order['line_items'] as $item){
                            $new_line = new order_line_items();
                            $new_line->order_id = $new->id;
                            $new_line->product_variant_id = $item['id'];
                            $new_line->shopify_product_id = $item['product_id'];
                            $new_line->shopify_variant_id = $item['variant_id'];
                            $new_line->title = $item['title'];
                            $new_line->quantity = $item['quantity'];
                            $new_line->sku = $item['sku'];
                            $new_line->variant_title = $item['variant_title'];
                            $new_line->vendor = $item['vendor'];
                            $new_line->price = $item['price'];
                            $new_line->requires_shipping = $item['requires_shipping'];
                            $new_line->taxable = $item['taxable'];
                            $new_line->name = $item['name'];
                            $new_line->payment_status = '0';
                            $new_line->properties = json_encode($item['properties'],true);
                            $new_line->fulfillable_quantity = $item['fulfillable_quantity'];
                            $new_line->fulfillment_status = $item['fulfillment_status'];

                            $retailer_product = Product::where('shopify_id',$item['product_id'])->first();
                            if($retailer_product != null){
                                $new_line->fulfilled_by = 'store';
                                $new_line->vendor_id=$retailer_product->vendor_id;

                                if(isset($order['customer'])) {
                                    if (customer::where('customer_shopify_id', $order['customer']['id'])->exists()) {
                                        $customer = customer::where('customer_shopify_id', $order['customer']['id'])->first();
                                        $customer->vendor_id=$retailer_product->vendor_id;
                                        $customer->save();

                                    } else {

                                        $customer->vendor_id=$retailer_product->vendor_id;
                                        $customer->save();

                                    }
                                }
                            }
                            else{
                                $new_line->fulfilled_by = 'store';
//                                $vendor_id=$retailer_product->vendor_id;
                            }
                            $related_variant = Vareint::where('shopify_id',$item['variant_id'])->first();
                            if($related_variant != null){
                                $new_line->cost = $related_variant->Price;
                                $cost_to_pay = $cost_to_pay + $related_variant->Price * $item['quantity'];
                            }

                            $new_line->save();
                        }
                        $new->cost_to_pay = $cost_to_pay;
                        $new->save();


//                        if(isset($order->shipping_address)){
//                            $total_weight = 0;
//                            $country = $order->shipping_address->country;
//                            foreach ($new->line_items as $index => $v){
//                                if($v->linked_product != null){
//                                    $total_weight = $total_weight + ( $v->linked_product->weight *  $v->quantity);
//                                }
//                            }
//                            $zoneQuery = Zone::query();
//                            $zoneQuery->whereHas('has_countries',function ($q) use ($country){
//                                $q->where('name',$country);
//                            });
//                            $zoneQuery = $zoneQuery->pluck('id')->toArray();
//
//                            $shipping_rates = ShippingRates::where('type','weight')->whereIn('zone_id',$zoneQuery)->newQuery();
////                            $shipping_rates->whereRaw('min <='.$total_weight);
////                            $shipping_rates->whereRaw('max >='.$total_weight);
//                            $shipping_rates =  $shipping_rates->first();
//                            if($shipping_rates != null){
//                                if($shipping_rates->min > 0){
//                                    $ratio = $total_weight/$shipping_rates->min;
//                                    $new->shipping_price = $shipping_rates->shipping_price*$ratio;
//                                    $new->total_price =  $order->total_price + $shipping_rates->shipping_price;
//                                    $new->save();
//                                }
//                                else{
//                                    $new->shipping_price = 0;
//                                    $new->save();
//                                }
//
//                            }
//                            else{
//                                $new->shipping_price = 0;
//                                $new->save();
//                            }
//                        }


                        /*Maintaining Log*/
                        $order_log =  new order_logs();
                        $order_log->message = "Order synced to Multivendor on ".date_create($new->created_at)->format('d M, Y h:i a');
                        $order_log->status = "Newly Synced";
                        $order_log->order_id = $new->id;
                        $order_log->save();
                    }
                }
            }
        }

        return redirect()->route('orders.index')->with('success','Orders Synced Successfully');

    }

    function order_details($id)
    {
        $order=order::find($id);

//        $order_details=order_line_items::where('order_id',$id)->paginate(10);

        return view('admin.order_details')->with(['order'=>$order]);
    }

    public function fulfill_order($id){
        $order  = order::find($id);

        if($order != null){
//
//            if($order->paid == 1)
//            {
                return view('admin.fullfilment')->with([
                    'order' => $order
                ]);
            //}
//            else{
//
//                return back()->with('form_error','Refunded Order Cant Be Processed Fulfillment');
//            }

        }
    }
//    public function fulfillment_order(Request $request,$id){
//        $order  = order::find($id);
//
//
//        dd($order);
//            if($order->paid == 1){
//                $fulfillable_quantities = $request->input('item_fulfill_quantity');
//                if($order->custom == 0){
//                    $shop = $this->helper->getSpecificShop($order->shop_id);
//                    $shopify_fulfillment = null;
//                    if($shop != null){
//                        $location_response = $shop->api()->rest('GET','/admin/locations.json');
//                        if(!$location_response->errors){
//                            $data = [
//                                "fulfillment" => [
//                                    "location_id"=> $location_response->body->locations[0]->id,
//                                    "tracking_number"=> null,
//                                    "line_items" => [
//
//                                    ]
//                                ]
//                            ];
//                            foreach ($request->input('item_id') as $index => $item) {
//                                $line_item = order_line_items::find($item);
//                                if ($line_item != null && $fulfillable_quantities[$index] > 0) {
//                                    array_push($data['fulfillment']['line_items'], [
//                                        "id" => $line_item->retailer_product_variant_id,
//                                        "quantity" => $fulfillable_quantities[$index],
//                                    ]);
//                                }
//                            }
//                            $response = $shop->api()->rest('POST','/admin/orders/'.$order->shopify_order_id.'/fulfillments.json',$data);
//                            if($response->errors){
//                                return redirect()->back()->with('error','Cant Fulfill Items of Order in Related Store!');
//
//                            }
//                            else{
//
//                                return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, $response);
//                            }
//                        }
//                        else{
//                            return redirect()->back()->with('error','Cant Fulfill Item Cause Related Store Dont have Location Stored!');
//                        }
//                    }
//                    else{
//                        return redirect()->back()->with('error','Order Related Store Not Found');
//                    }
//                }
//
//                else{
//                    return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, '');
//                }
//
//        }
//        else{
//            return redirect()->route('admin.order')->with('error','Order Not Found To Process Fulfillment');
//        }
//
//    }


    function vendorOrder(Request $request)
    {
        $product=Product::where('vendor_id',Auth::id())->get();

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

        $array1 = [];

            foreach ($orders as $order) {



                array_push($array1, $order->order_id);



            }


        $array=(array_unique($array1));


            $order_new=order::whereIn('id',$array)->paginate(30);



        if($request->has('search')){
            $order_new->where('name','LIKE','%'.$request->input('search').'%');

        }

        return view('vendor.orders')->with([
            'orders' => $order_new,
            'payments' =>$payments,
            'search' => $request->input('search')
        ]);

    }

    function vendor_order_details($id)
    {
        $order=order::find($id);

        $order_details=order_line_items::where('order_id',$id)->where('vendor_id',Auth::id())->get();

//        $order_details=order_line_items::where('order_id',$id)->paginate(10);
        return view('vendor.order_details')->with(['order'=>$order,'order_details'=>$order_details]);
    }

    function vendor_fulfill_order($id)
    {

        $order_details=order_line_items::where('order_id',$id)->where('vendor_id',Auth::id())->get();
        if($order_details != null){
//
//            if($order->paid == 1)
//            {
            $order=order::find($id);
            return view('vendor.fullfillment')->with([
                'order' => $order,
                'order_details'=>$order_details
            ]);
            //}
//            else{
//
//                return back()->with('form_error','Refunded Order Cant Be Processed Fulfillment');
//            }

        }



    }
    function vendor_fulfillment_order(Request $request,$id)
    {
        $order  = order::find($id);


            $fulfillable_quantities = $request->input('item_fulfill_quantity');

                $shop = $this->helper->getShopify();
                $shopify_fulfillment = null;
                    $location_response = $shop->rest('GET','/admin/locations.json')['body']['locations'][0];

                    if(count($location_response)>0){
                        $data = [
                            "fulfillment" => [
                                "location_id"=> $location_response['id'],
                                "tracking_number"=> null,
                                "line_items" => [

                                ]
                            ]
                        ];
                        foreach ($request->input('item_id') as $index => $item) {

                            $line_item = order_line_items::find($item);
                            if ($line_item != null && $fulfillable_quantities[$index] > 0) {
                                array_push($data['fulfillment']['line_items'], [
                                    "id" => $line_item->product_variant_id,
                                    "quantity" => $fulfillable_quantities[$index],
                                ]);
                            }
                        }

                        $response = $shop->rest('POST','/admin/orders/'.$order->shopify_order_id.'/fulfillments.json',$data);


                        if($response['errors']!=false){
                            return redirect()->back()->with('error','Cant Fulfill Items of Order in Related Store!');

                        }
                        else{

                            return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, $response);
                        }
                    }
//
                    else{
//                         return $this->set_fulfilments($request, $id, $fulfillable_quantities, $order, '');
        return redirect()->back()->with('error','Cant Fulfill location not found');
                    }




    }
    public function set_fulfilments(Request $request, $id, $fulfillable_quantities, $order, $response): \Illuminate\Http\RedirectResponse
    {
        foreach ($request->input('item_id') as $index => $item) {
            $line_item = order_line_items::find($item);
            if ($line_item != null && $fulfillable_quantities[$index] > 0) {
                if ($fulfillable_quantities[$index] == $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'fulfilled';

                } else if ($fulfillable_quantities[$index] < $line_item->fulfillable_quantity) {
                    $line_item->fulfillment_status = 'partially-fulfilled';
                }
                $line_item->fulfillable_quantity = $line_item->fulfillable_quantity - $fulfillable_quantities[$index];
            }
            $line_item->save();
        }
        $order->status = $order->getStatus($order);
        $order->save();

        $fulfillment = new OrderFulfillments();

            $fulfillment->fulfillment_shopify_id = $response['body']['fulfillment']['id'];
            $fulfillment->name = $response['body']['fulfillment']['name'];

        $fulfillment->order_id = $order->id;
        $fulfillment->vendor_id = Auth::id();
        $fulfillment->status = 'fulfilled';
        $fulfillment->save();

        /*Maintaining Log*/
        $order_log = new order_logs();
        $order_log->message = "A fulfillment named " . $fulfillment->name . " has been processed successfully on " . date_create($fulfillment->created_at)->format('d M, Y h:i a');
        $order_log->status = "Fulfillment";
        $order_log->order_id = $order->id;
        $order_log->save();

        foreach ($request->input('item_id') as $index => $item) {
            if ($fulfillable_quantities[$index] > 0) {
                $fulfillment_line_item = new FulfillmentLineItems();
                $fulfillment_line_item->fulfilled_quantity = $fulfillable_quantities[$index];
                $fulfillment_line_item->order_fulfillment_id = $fulfillment->id;
                $fulfillment_line_item->order_line_item_id = $item;
                $fulfillment_line_item->save();

            }
        }
        $vendor= DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.id','users.name','users.email','users.package')
            ->where('model_has_roles.role_id','=','2')
            ->where('users.id','=',Auth::id())
            ->first();

        if($vendor == true) {


            return redirect()->route('orders.vendor.index', $id)->with('success', 'Order Line Items Marked as Fulfilled Successfully!');

        }
        else{
            return redirect()->route('orders.index', $id)->with('success', 'Order Line Items Marked as Fulfilled Successfully!');

        }
    }

    public function fulfillment_add_tracking(Request $request){
        $order = order::find($request->id);

        if($order != null ){
//            if($order->paid == 1) {
                $fulfillments = $request->input('fulfillment');
                $tracking_numbers = $request->input('tracking_number');
                $tracking_urls = $request->input('tracking_url');
                $tracking_notes = $request->input('tracking_notes');
//                if ($order->custom == 0) {
                    $shop = $this->helper->getShopify();
//                    if ($shop != null) {
                        foreach ($fulfillments as $index => $f) {
                            $current = OrderFulfillments::find($f);
                            if ($current != null) {
                                $data = [
                                    "fulfillment" => [
                                        "tracking_number" => $tracking_numbers[$index],
                                        "tracking_url" => $tracking_urls[$index],
                                    ]
                                ];
                                $response = $shop->rest('PUT', '/admin/orders/' . $order->shopify_order_id . '/fulfillments/' . $current->fulfillment_shopify_id . '.json', $data);

                                if ($response['errors']==false) {
                                    $current->tracking_number = $tracking_numbers[$index];
                                    $current->tracking_url = $tracking_urls[$index];
                                    $current->tracking_notes = $tracking_notes[$index];
                                    $current->save();

                                    /*Maintaining Log*/
                                    $order_log = new order_logs();
                                    $order_log->message = "Tracking detailed added to fulfillment named " . $current->name . "  successfully on " . now()->format('d M, Y h:i a');
                                    $order_log->status = "Tracking Details Added";
                                    $order_log->order_id = $order->id;
                                    $order_log->save();
                                }

                            }
                        }
//                    } else {
//                        return redirect()->back()->with('error', 'Order Related Store Not Found');
//                    }
                }
//                else {
//                    foreach ($fulfillments as $index => $f) {
//                        $current = OrderFulfillment::find($f);
//                        if ($current != null) {
//                            $current->tracking_number = $tracking_numbers[$index];
//                            $current->tracking_url = $tracking_urls[$index];
//                            $current->tracking_notes = $tracking_notes[$index];
//                            $current->save();
//
//                            /*Maintaining Log*/
//                            $order_log = new OrderLog();
//                            $order_log->message = "Tracking detailed added to fulfillment named " . $current->name . "  successfully on " . now()->format('d M, Y h:i a');
//                            $order_log->status = "Tracking Details Added";
//                            $order_log->retailer_order_id = $order->id;
//                            $order_log->save();
//                        }
//
//                    }
//                }
                $count = 0;
                $fulfillment_count = count($order->fulfillments);
                foreach ($order->fulfillments as $f) {
                    if ($f->tracking_number != null) {
                        $count++;
                    }
                }
                if ($count == $fulfillment_count) {
                    $order->status = 'shipped';
                } else {
                    $order->status = 'partially-shipped';
                }

                $order->save();


                return redirect()->back()->with('success', 'Tracking Details Added To Fulfillment Successfully!');
//            }
//            else{
//                return redirect()-back()->with('error','Refunded Order Cant Be Processed Fulfillment');
//            }

//        }
//        else{
//            return redirect()->route('admin.order')->with('error','Order Not Found To Add Tracking In Fulfillment');
//
//        }
    }
}
