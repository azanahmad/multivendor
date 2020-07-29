<?php

namespace App\Http\Controllers;
use App\order;
use App\order_line_items;
use App\Product;
use App\Product_status;
use App\User;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

class AdminController extends Controller
{
    private $helper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->helper = new HelperController();
    }



    public function index()
    {
//        return view('admin/Admin');

        $domain = 'mullti-vendors.myshopify.com';
        $shop = User::where('name', $domain)->first();
        $options = new Options();
        $options->setVersion('2020-01');
//
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session('mullti-vendors.myshopify.com', $shop->password));
        $count = $api->rest('GET', '/admin/api/2020-07/orders.json')['body']['orders'];

        dd($count);

//
//
//
//        $someArray = json_decode($count, true);
//
        //   echo $someArray;
//        $product = Product::find('4');
//
//        $image=json_decode($product->Image,true);
//
//
//        foreach ($image as $image)
//        {
//            echo $image;
//        }


//        $tags=json_decode($product->categories,true);
//
//        $tags=implode(',',$tags);
//
//        dd($tags);

//        $options_array=[];
//
//        $product = Product::find('10');
//        $options=json_decode($product->options,true);
//        foreach ($options as  $index => $option)
//        {
//            if($index ==0)
//            {
//                array_push($options_array, [
//                    'name' => 'size',
//                    'position' => '1',
//                    'values' => $option,
//                ]);
//            }
//            if($index ==1) {
//                if ($option != null)
//                {
//                    array_push($options_array, [
//                        'name' => 'color',
//                        'position' => '2',
//                        'values' => $option,
//                    ]);
//            }
//            }
//            if($index == 2) {
//                if ($option != null)
//                    array_push($options_array, [
//                        'name' => 'materiel',
//                        'position' => '3',
//                        'values' => $option,
//                    ]);
//            }
//
//
//        }
//
//        dd($options_array);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Request $request)
    {
        $id=$request->id;

        $product = Product_status::where('product_id', $id)->first();
        if ($product) {
            if ($product->admin_status == 'null') {
                $product->admin_status = 'approved';
            }
            $save1 = $product->save();
            $product2 = Product::where('id', $id)->first();
            if ($product2) {
                if ($product2->vendor_status == 'published') {
                    $product2->vendor_status = 'draft';
                }
                $save2 = $product2->save();
                if ($save1 || $save2) {


                    $product = Product::find($id);
                    if ($product != null) {
                        $variants_array = [];
                        $options_array = [];
                        $images_array = [];
                        //converting variants into shopify api format
                        $variants_array =  $this->variants_template_array($product);
                        /*Product Options*/
                        $options_array = $this->options_template_array($product);
                        /*Product Images*/

                        $image1=json_decode($product->Image,true);

                        if($product->has_image) {
                            foreach ($product->has_image as $index => $image) {
//                            if ($image->isV == 0) {
//                                $src = asset('images') . '/' . $image->image;
//                            } else {
//                                $src = asset('images/variants') . '/' . $image->image;
//                            }
                                array_push($images_array, [
                                    'alt' => $product->Title . '_' . $index,
                                    'position' => $index + 1,
                                    'src' => asset('images') . '/' . $image->src,
                                ]);
                            }
                        }
                        $shop = $this->helper->getShopify();


                        $tags='';
                        $sub_tags='';
                        /*Categories and Subcategories*/
                        if($product->categories !='') {
                            $tags = json_decode($product->categories, true);

                            $tags = implode(',', $tags);

                        }


                        if($product->sub_categories !='')
                        {
                            $sub_tags = json_decode($product->sub_categories, true);

                            $sub_tagss = implode(',', $sub_tags);


                            $sub_tags=','.$sub_tagss;
                        }





//                        if(count($product->has_categories) > 0){
//                            $categories = implode(',',$product->has_categories->pluck('title')->toArray());
//                            $tags = $tags.','.$categories;
//                        }
//                        if(count($product->has_subcategories) > 0){
//                            $subcategories = implode(',',$product->has_subcategories->pluck('title')->toArray());
//                            $tags = $tags.','.$subcategories;
//                        }


//                        if($product->vendor_status == 'published'){
//                            $published = true;
//                        }
//                        else{
//                            $published = false;
//                        }

                        $vendor=User::find($product->vendor_id);

//                        $option[]=json_decode($product->options,true);
//

//                        $options=json_decode($product->options,true);
//                        foreach ($options as  $index => $option)
//                        {
//                            if($index ==0)
//                            {
//                                array_push($options_array, [
//                                    'name' => 'size',
//                                    'position' => '1',
//                                    'values' => $option,
//                                ]);
//                            }
//                            if($index ==1) {
//                                if ($option != null)
//                                {
//                                    array_push($options_array, [
//                                        'name' => 'color',
//                                        'position' => '2',
//                                        'values' => $option,
//                                    ]);
//                                }
//                            }
//                            if($index == 2) {
//                                if ($option != null)
//                                    array_push($options_array, [
//                                        'name' => 'materiel',
//                                        'position' => '3',
//                                        'values' => $option,
//                                    ]);
//                            }
//
//
//                        }

                        $productdata = [
                            "product" => [
                                "title" => $product->Title,
                                "body_html" => $product->Discription,
                                "vendor" => $vendor->name,
                                "tags" => $tags,
//                                "product_type" => $product->type,
                                "variants" => $variants_array,
                                "options" => $options_array,
                                "images" => $images_array,
//                                "image" =>$product->Image,
                                "published"=>  true
                            ]
                        ];


                        $response = $shop->rest('POST', '/admin/api/2020-01/products.json', $productdata)['body']['product'];

                        $product_shopify_id =  $response->id;


                        $product->shopify_id = $product_shopify_id;
                        $price = $product->Price;
                        $product->save();




                        $shopifyImages = $response->images;
                        $shopifyVariants = $response->variants;
                        if(count($product->varients) == 0){
                            $variant_id = $shopifyVariants[0]->id;
                            $i = [
                                'variant' => [
                                    'price' =>$price,
                                ]
                            ];
                            $shop->rest('PUT', '/admin/api/2019-10/variants/' . $variant_id .'.json', $i);
                        }

                        foreach ($product->varients as $index => $v){
                            $v->shopify_id = $shopifyVariants[$index]->id;
                            $v->save();
                        }



//                        foreach ($product->has_platforms as $index => $platform){
//                            $index = $index+1;
//                            $productdata = [
//                                "metafield" => [
//                                    "key" => "warned_platform".$index,
//                                    "value"=> $platform->name,
//                                    "value_type"=> "string",
//                                    "namespace"=> "platform"
//                                ]
//                            ];
//                            $resp =  $shop->api()->rest('POST', '/admin/api/2019-10/products/'.$product_shopify_id.'/metafields.json',$productdata);
//                        }
//
//                        $count =0;

                        // $image1=json_decode($product->Image,true);
//                        foreach ($image1 as $index => $image) {
//                            $count++;
//                            array_push($images_array, [
//                                'alt' => $product->Title . '_' . $index,
//                                'position' => $index + 1,
//                                'src' => asset('images').'/'.$image,
//                            ]);
//                        }

                        if(count($shopifyImages) == count($product->has_image)){
                            foreach ($product->has_images as $index => $image){
                                $image->shopify_id = $shopifyImages[$index]->id;
                                $image->save();
                            }
                        }
                        dd($response);
                        foreach ($product->varients as $index => $v){
                            if($v->has_image != null){
                                $i = [
                                    'image' => [
                                        'id' => $v->shopify_id,
                                        'variant_ids' => [$v->shopify_id]
                                    ]
                                ];
                                $imagesResponse = $shop->rest('PUT', '/admin/api/2019-10/products/' . $product_shopify_id . '/images/' . $v->shopify_id . '.json', $i);
                            }
                        }


//                        return redirect()->route('product.view',$product->id)->with('success','Product Generated and Push to Store Successfully!');
                    }



//                    return Response::json(['status' => '0', 'message' => 'Product has been approved and published on store successfully']);

                    return redirect()->back()->with('success', 'Product has been approved and published on store successfully');

                } else {
                    return Response::json(['status' => '1', 'message' => 'Error during status changed']);

                }

            }
        }
    }
    public function rejected(Request $request)
    {
        $id=$request->id;

        $product = Product_status::where('product_id',$id)->first();
        if ($product) {
            if ($product->admin_status == 'null') {
                $product->admin_status = 'rejected';
                $product->note = $request->note;
            }
            $save = $product->save();
            if ($save) {
                return redirect()->back()->with('success', 'Product has been rejected');

//                return Response::json(['status' => '0', 'message' => 'Product has been rejected']);
            } else {
//                return Response::json(['status' => '1', 'message' => 'Error during status changed']);
                return redirect()->back()->with('form_error', 'Error during status changed');
            }

        }
    }
    public function shopping()
    {
        return view('admin/shipping_zone');
    }
    public function options_template_array($product){
        $options_array = [];
        if (count($product->option1($product)) > 0) {
            $temp = [];
            foreach ($product->option2($product)  as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => $product->option_name1,
                'position' => '1',
                'values' => json_encode($temp),
            ]);
        }

        if (count($product->option2($product)) > 0) {
            $temp = [];
            foreach ($product->option2($product) as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => $product->option_name2,
                'position' => '2',
                'values' => json_encode($temp),
            ]);
        }
        if (count($product->option3($product)) > 0) {
            $temp = [];
            foreach ($product->option3($product) as $a) {
                array_push($temp, $a);
            }
            array_push($options_array, [
                'name' => $product->option_name3,
                'position' => '3',
                'values' => json_encode($temp),
            ]);
        }


        return $options_array;
    }
    public function variants_template_array($product){
        $variants_array = [];
        foreach ($product->varients as $index => $varaint) {


            array_push($variants_array, [
                'title' => $varaint->Title,
                'sku' => $varaint->SKU,
                'option1' => $varaint->Option1,
                'option2' => $varaint->Option2,
                'option3' => $varaint->Option3,
                'inventory_quantity' => $varaint->Quantity,
                'inventory_management' => 'shopify',
                'grams' => $product->Weight * 1000,
                'weight' => $product->Weight,
                'weight_unit' => 'kg',
                'barcode' => $varaint->Barcode,
                'price' => $varaint->Price,
//                'cost' => $varaint->cost,
            ]);
        }

        return $variants_array;

    }
    public function dashboard(Request $request)
    {

       // return view('dashboard.index');


        if ($request->has('date-range')) {
            $date_range = explode('-',$request->input('date-range'));
            $start_date = $date_range[0];
            $end_date = $date_range[1];
            $comparing_start_date = Carbon::parse($start_date)->format('Y-m-d');
            $comparing_end_date = Carbon::parse($end_date)->format('Y-m-d');


            $orders = order_line_items::whereIN('payment_status',[1,2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->groupby('order_id')->count();


            $sales = order_line_items::whereIN('payment_status',[1,2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->sum('price');

            $refund = order_line_items::whereIN('payment_status',[2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->sum('price');

//
//            $orders = order::whereIN('paid',[1,2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->count();
//            $sales = order::whereIN('paid',[1,2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->sum('cost_to_pay');
//            $refund = order::whereIN('paid',[2])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->sum('cost_to_pay');

            //$stores = Shop::whereNotIn('shopify_domain',['wefullfill.myshopify.com'])->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->count();
            $stores= DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->select('users.id','users.name','users.email','users.package')
                ->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])->count();

//
//            $ordersQ = DB::table('retailer_orders')
//                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(cost_to_pay) as total_sum'))
//                ->whereIn('paid',[1,2])
//                ->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])
//                ->groupBy('date')
//                ->get();

            $ordersQ = DB::table('order_line_items')
                //  ->join('order_line_items','orders.id','order_line_items.order_id')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(price) as total_sum'))
                ->whereIn('payment_status',[1,2])
                ->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])

                ->groupBy('date')
                ->get();


//            $ordersQR = DB::table('orders')
//                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(cost_to_pay) as total_sum'))
//                ->whereIn('paid',[2])
//                ->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])
//                ->groupBy('date')
//                ->get();

            $ordersQR = DB::table('order_line_items')
                //  ->join('order_line_items','orders.id','order_line_items.order_id')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(price) as total_sum'))
                ->whereIn('payment_status',[1])
                ->whereBetween('created_at', [$comparing_start_date, $comparing_end_date])
                ->groupBy('date')
                ->get();

//            $shopQ = DB::table('shops')
//                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
//                ->whereNotIn('shopify_domain',['wefullfill.myshopify.com'])

            $shopQ= DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->select(DB::raw('DATE(users.created_at) as date'), DB::raw('count(*) as total'))
                ->where('model_has_roles.role_id','=','2')
                ->whereBetween('users.created_at', [$comparing_start_date, $comparing_end_date])
                ->groupBy('date')
                ->get();

        } else {

            $orders = order_line_items::whereIN('payment_status',[1,2])->groupby('order_id')->count();


            $sales = order_line_items::whereIN('payment_status',[1,2])->sum('price');

            $refund = order_line_items::whereIN('payment_status',[2])->sum('price');



            $stores= DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->select('users.id','users.name','users.email','users.package')
                ->where('model_has_roles.role_id','=','2')
                ->count();


            //$stores = Shop::whereNotIn('shopify_domain',['wefullfill.myshopify.com'])->count();



            $ordersQ = DB::table('order_line_items')
              //  ->join('order_line_items','orders.id','order_line_items.order_id')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(price) as total_sum'))
                ->whereIn('payment_status',[1,2])
                ->groupBy('date')
                ->get();


//            $ordersQR = DB::table('orders')
//                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(cost_to_pay) as total_sum'))
//                ->whereIn('paid',[2])
//                ->groupBy('date')
//                ->get();

            $ordersQR = DB::table('order_line_items')
                //  ->join('order_line_items','orders.id','order_line_items.order_id')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total, sum(price) as total_sum'))
                ->whereIn('payment_status',[1])
                ->groupBy('date')
                ->get();


//            $shopQ = DB::table('shops')
//                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
//                ->whereNotIn('shopify_domain',['wefullfill.myshopify.com'])
//                ->groupBy('date')
//                ->get();

            $shopQ= DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->select(DB::raw('DATE(users.created_at) as date'), DB::raw('count(*) as total'))
                ->where('model_has_roles.role_id','=','2')
                ->groupBy('date')
                ->get();


        }


        $graph_one_order_dates = $ordersQ->pluck('date')->toArray();
        $graph_one_order_values = $ordersQ->pluck('total')->toArray();
        $graph_two_order_values = $ordersQ->pluck('total_sum')->toArray();

        $graph_three_order_dates = $ordersQR->pluck('date')->toArray();
        $graph_three_order_values = $ordersQR->pluck('total_sum')->toArray();

        $graph_four_order_dates = $shopQ->pluck('date')->toArray();
        $graph_four_order_values = $shopQ->pluck('total')->toArray();




        $top_products_users =  Product::join('order_line_items',function($join) {
            $join->on('order_line_items.shopify_product_id','=','products.shopify_id')
                ->whereIn('order_line_items.payment_status',[1,2]);
//                ->join('orders',function($o) {
//                    $o->on('order_line_items.order_id','=','orders.id')
//                        ->whereIn('order_line_items.payment_status',[1,2]);
//                });
        })->select('products.*',DB::raw('sum(order_line_items.quantity) as sold'),DB::raw('sum(order_line_items.cost) as selling_cost'))
            ->groupBy('order_line_items.shopify_product_id')
            ->orderBy('sold','DESC')
            ->get()
            ->take(5);

//        dd($top_products_users);

//        $top_products_stores = Product::join('products',function($join) {
//            $join->on('retailer_products.linked_product_id', '=', 'products.id')
//                ->join('retailer_order_line_items', function ($join) {
//                    $join->on('retailer_order_line_items.shopify_product_id', '=', 'retailer_products.shopify_id')
//                        ->join('retailer_orders', function ($o) {
//                            $o->on('retailer_order_line_items.retailer_order_id', '=', 'retailer_orders.id')
//                                ->whereIn('paid', [1, 2]);
//                        });
//                });
//        })->select('products.*',DB::raw('sum(retailer_order_line_items.quantity) as sold'),DB::raw('sum(retailer_order_line_items.cost) as selling_cost'))
//            ->groupBy('products.id')
//            ->orderBy('sold','DESC')
//            ->get()
//            ->take(5);

////        dd($top_products_stores,$top_products_users);
//
//
//
//        $top_stores = Shop::whereNotIn('shopify_domain',['wefullfill.myshopify.com'])
//            ->join('retailer_products',function($join) {
//                $join->on('retailer_products.shop_id','=','shops.id')
//                    ->join('retailer_order_line_items',function ($j){
//                        $j->on('retailer_order_line_items.shopify_product_id','=','retailer_products.shopify_id')
//                            ->join('retailer_orders',function($o){
//                                $o->on('retailer_order_line_items.retailer_order_id','=','retailer_orders.id')
//                                    ->whereIn('paid',[1,2]);
//                            });
//                    });
//            })
//            ->select('shops.*',DB::raw('sum(retailer_order_line_items.quantity) as sold'),DB::raw('sum(retailer_order_line_items.cost) as selling_cost'))
//            ->groupBy('shops.id')
//            ->orderBy('sold','DESC')
//            ->get()
//            ->take(10);
//
//        $top_users = User::role('non-shopify-users')->join('retailer_products',function($join){
//            $join->on('retailer_products.user_id','=','users.id')
//                ->join('retailer_order_line_items',function ($j){
//                    $j->join('products',function ($p){
//                        $p->on('retailer_order_line_items.shopify_product_id','=','products.shopify_id');
//                    });
//                    $j->join('retailer_orders',function($o){
//                        $o->on('retailer_order_line_items.retailer_order_id','=','retailer_orders.id')
//                            ->whereIn('paid',[1,2]);
//                    });
//                });
//        })->select('users.*',DB::raw('sum(retailer_order_line_items.quantity) as sold'),DB::raw('sum(retailer_order_line_items.cost) as selling_cost'))
//            ->groupBy('users.id')
//            ->orderBy('sold','DESC')
//            ->get()
//            ->take(10);

//        dd($top_products);


        return view('dashboard.index')->with([
            'date_range' => $request->input('date-range'),
            'orders' => $orders,
            'refunds' => $refund,
            'sales' =>$sales,
            'stores' => $stores,
            'graph_one_labels' => $graph_one_order_dates,
            'graph_one_values' => $graph_one_order_values,
            'graph_two_values' => $graph_two_order_values,
            'graph_three_labels' => $graph_three_order_dates,
            'graph_three_values' => $graph_three_order_values,
            'graph_four_values' => $graph_four_order_values,
            'graph_four_labels' => $graph_four_order_dates,
           // 'top_products_stores' => $top_products_stores,
            'top_products_users' => $top_products_users,
//            'top_stores' => $top_stores,
//            'top_users' => $top_users
        ]);
    }

}

