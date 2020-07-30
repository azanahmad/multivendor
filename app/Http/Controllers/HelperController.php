<?php

namespace App\Http\Controllers;

use App\customer;
use App\order;
use App\order_line_items;
use App\order_logs;
use App\Product;
use App\User;
use App\Vareint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

class HelperController extends Controller
{

    public $shop;
    public function getShopify()
    {
//            $shop = Auth::user();
//            $this->api = $shop->api();
//            return $this->api;
        $options = new Options();
        $options->setVersion('2020-01');
        $domain = 'cursosdereiki.myshopify.com';
        $api = new BasicShopifyAPI($options);
        $shop = User::where('name', $domain)->first();
        $api->setSession(new Session('cursosdereiki.myshopify.com', $shop->password));
        return $api;

    }

    public function SuperAdminCreate()
    {
        if (!User::where('email', 'admin@tesanandum.com')->exists()) {
         $user=  User::create([
                'name' => 'Admin',
                'email' => 'admin@tesanandum.com',
                'password' => Hash::make('tesanandum@admin'),
            ]);
            $data1 =array('role_id'=>'1','model_type'=>'App\User','model_id'=>$user->id);
            DB::table('model_has_roles')->insert($data1);

        }
        if (!User::where('email', 'admin@tesanandum.com')->exists()) {
            $user= User::create([
                'name' => 'Admin',
                'email' => 'admin@tesanandum.com',
                'password' => Hash::make('tesanandum@admin'),
            ]);
            $data1 =array('role_id'=>'1','model_type'=>'App\User','model_id'=>$user->id);
            DB::table('model_has_roles')->insert($data1);
        }
    }

//    function  getShopifyDomain($domain)
//    {
//        $this->api = new BasicShopifyAPI();
//        $shop = User::where('name', $domain)->first();
//        $this->api->setVersion('2020-04');
//        $this->api->setShop($shop->name);
//        $this->api->setApiKey(env('SHOPIFY_API_KEY'));
//        $this->api->setApiSecret(env('SHOPIFY_API_SECRET'));
//        $this->api->setAccessToken($shop->password);
//        return $this->api;
//    }
//
//    public function getShopDomain($domain){
//        $this->shop = User::where('name',$domain)->first();
//        return $this->shop;
//    }
//
//    public function getShop(){
//        $domain = 'mullti-vendors.myshopify.com';
////        $this->shop = User::where('name',Auth::user()->name)->first();
//        $this->shop = User::where('name', $domain)->first();
//        return $this->shop;
//    }

    function order_sync($order)
    {



        $product_ids = [];
        $variant_ids  = [];
        foreach($order->line_items as $item){
            array_push($variant_ids,$item->variant_id);
            array_push($product_ids,$item->product_id);
        }



        if(Product::whereIn('shopify_id',$product_ids)->exists()){



            if(!order::where('shopify_order_id',$order->id)->exists()){


                $new = new order();
                $new->shopify_order_id = $order->id;
                $new->email = $order->email;
                $new->phone = $order->phone;
                $new->shopify_created_at = date_create($order->created_at)->format('Y-m-d h:i:s');
                $new->shopify_updated_at =date_create($order->updated_at)->format('Y-m-d h:i:s');
                $new->note = $order->note;
                $new->name = $order->name;
                $new->total_price = $order->total_price;
                $new->subtotal_price = $order->subtotal_price;
                $new->total_weight = $order->total_weight;
                $new->taxes_included = $order->taxes_included;
                $new->total_tax = $order->total_tax;
                $new->currency = $order->currency;
                $new->total_discounts = $order->total_discounts;

                if(isset($order->customer)){
                    if (customer::where('customer_shopify_id',$order->customer->id)->exists()){
                        $customer = customer::where('customer_shopify_id',$order->customer->id)->first();
                        $new->customer_id = $customer->id;
                    }
                    else{
                        $customer = new customer();
                        $customer->customer_shopify_id = $order->customer->id;
                        $customer->first_name = $order->customer->first_name;
                        $customer->last_name = $order->customer->last_name;
                        $customer->phone = $order->customer->phone;
                        $customer->email = $order->customer->email;
                        $customer->total_spent = $order->customer->total_spent;
//                                $customer->shop_id = $shop['id'];
//                                $local_shop = $this->helper->getLocalShop();
//                                if(count($local_shop->has_user) > 0){
//                                    $customer->user_id = $local_shop->has_user[0]->id;
//                                }
                        $customer->save();

                        $new->customer_id = $customer->id;
                    }
                    $new->customer = json_encode($order->customer,true);
                }

                if(isset($order->shipping_address)){
                    $new->shipping_address = json_encode($order->shipping_address,true);
                }

                if(isset($order->billing_address)){
                    $new->billing_address = json_encode($order->billing_address,true);
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

                foreach ($order->line_items as $item){
                    $new_line = new order_line_items();
                    $new_line->order_id = $new->id;
                    $new_line->product_variant_id = $item->id;
                    $new_line->shopify_product_id = $item->product_id;
                    $new_line->shopify_variant_id = $item->variant_id;
                    $new_line->title = $item->title;
                    $new_line->quantity = $item->quantity;
                    $new_line->sku = $item->sku;
                    $new_line->variant_title = $item->variant_title;
                    $new_line->vendor = $item->vendor;
                    $new_line->price = $item->price;
                    $new_line->requires_shipping = $item->requires_shipping;
                    $new_line->taxable = $item->taxable;
                    $new_line->name = $item->name;
                    $new_line->payment_status = '0';
                    $new_line->properties = json_encode($item->properties,true);
                    $new_line->fulfillable_quantity = $item->fulfillable_quantity;
                    $new_line->fulfillment_status = $item->fulfillment_status;

                    $retailer_product = Product::where('shopify_id',$item->product_id)->first();
                    if($retailer_product != null){
                        $new_line->fulfilled_by = 'store';
                        $new_line->vendor_id=$retailer_product->vendor_id;

                        if(isset($order->customer)) {
                            if (customer::where('customer_shopify_id', $order->customer->id)->exists()) {
                                $customer = customer::where('customer_shopify_id', $order->customer->id)->first();
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
                    $related_variant = Vareint::where('shopify_id',$item->variant_id)->first();
                    if($related_variant != null){
                        $new_line->cost = $related_variant->Price;
                        $cost_to_pay = $cost_to_pay + $related_variant->Price * $item->quantity;
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


    public function create_carrier(Request $request)
    {
        $data = [
            "carrier_service" => [
                "name" => 'Shipping Rate Provider',
                "callback_url" => "https://app.tesanandum.com/checkout/get_shopify_checkout/",
                "service_discovery" => true,

            ]
        ];

        $shop = $this->getShopify();

        $response = $shop->rest('POST ','/admin/api/2020-07/carrier_services.json',$data);


        dd($response);
    }

}



