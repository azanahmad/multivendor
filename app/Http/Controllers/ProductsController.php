<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Countries;
use App\Country;
use App\CountryZone;
use App\PackageModel;
use App\Shipping;
use App\Option1;
use App\Product_categorie;
use App\Product_imageModel;
use App\Product_status;
use App\Products;
use App\Subcategory;
use App\Zone;
use Illuminate\Http\Request;
use App\Product;
use App\Vareint;
use App\User;
use Illuminate\Support\Facades\Auth;
use Response;
use Session;
use Symfony\Component\Console\Input\Input;
use Validator;
use Illuminate\Support\Facades\File;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
        $this->middleware('auth');
    }



    public function index()
    {

        $categories=Categorie::all();

//        $countries =CountryZone::all();
        $countries = Countries::all();
        return view('vendor/products')->with(['categories'=>$categories,'countries'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_save(Request $request)
    {


        if ($request->category) {
            foreach ($request->category as $category) {
                $cat[] = $category;
            }
        }
        else {
            $cat[] = 'no category selected';
        }
        if ($request->sub_cat) {
            foreach ($request->sub_cat as $subcategory) {
                $sub_cat[] = $subcategory;
            }
        } else {
            $sub_cat[] = 'no sub category selected';
        }

//        $value1 =$request->option1_value;
//        $value2 =$request->option2_value;
//        $value3 =$request->option3_value;
        $title[]='';
        $image='';
//        $array1=array($value1,$value2,$value3);
//        $array =array_push($title,$title1,$title2,$title3);
//        array_shift($title);
        if($request->hasfile('files'))
        {
            $data=array();
            foreach($request->file('files') as $file) {

                $fileName = time() . rand() . '.' . $file->extension();

                $file->move(public_path(). '/images/', $fileName);

                $data[] = $fileName;
                $image=$fileName;
//                $product_images=new Product_imageModel();
//                $product_images->product_id=$product->id;
//
//                $product_images->save();
            }
        }

        $id =Auth::id();
        if($request->category_id)
        {
            foreach ($request->category_id as $category) {
                $cat[] = $category;
            }
        }
        else{
            $cat[] ='no category selected';
        }
        //dd($request->option_title1,'',$request->option_title2,'',$request->option_title3);

        $product = Product::create([
            'vendor_id'=>$id,
            'Title'=>$request->title,
            'Discription'=>$request->descrip,
            'Price' => $request->price,
            'Compare_price'=>$request->compare_price ? $request->compare_price : 0,
            'SKU' => $request->sku,
            'Barcode' => $request->barcode ? $request->barcode : 0,
            'Image'=>$image,
            'Quantity'=>$request->quantity,
            'Weight'=>$request->weight,
            'County/zone'=>$request->country,
            'vendor_status'=>$request->status,
            'option_name1'=>$request->option_title1,
            'option_name2'=>$request->option_title2,
            'option_name3'=>$request->option_title3,
            'categories' => json_encode($cat),
            'sub_categories' => json_encode($sub_cat),
        ]);
        Product_status::create([
            'product_id'=>$product->id,
        ]);
        if($request->countries)
        {
            foreach ($request->countries as $country) {
                $countries[] = $country;
            }
        }
        else{
            $countries[] ='no country selected';
        }

//        Shipping::create([
//            'product_id'=>$product->id,
//            'countries'=>json_encode($countries),
//            'shipping_rate'=>$request->shipping_rate,
//            'shipping_time'=>$request->shipping_time,
//            'processing_time'=>$request->processing_time,
//        ]);

        if($product)
        {

            if($request->hasfile('files'))
            {
                //$data=array();
                foreach($data as $file) {

//                    $name = $file->getClientOriginalName();


//                     $data[] = $name;
                    $product_images=new Product_imageModel();
                    $product_images->product_id=$product->id;
                    $product_images->src=$file;
                    $product_images->save();
                }
            }


            for ($i = 0; $i < count($request->variant_title); $i++) {
                $options = explode('/', $request->variant_title[$i]);
                $variants = new Vareint();
                if (!empty($options[0])) {
                    $variants->option1 = $options[0];
                }
                if (!empty($options[1])) {
                    $variants->option2 = $options[1];
                }
                if (!empty($options[2])) {
                    $variants->option3 = $options[2];
                }
                $variants->product_id =$product->id;
                $variants->title = $request->variant_title[$i];
                $variants->price = $request->variant_price[$i];
                $variants->quantity = $request->variant_quantity[$i];
                $variants->sku = $request->variant_sku[$i];
                $variants->barcode = $request->variant_barcode[$i];
                //  $variants->image = $product->Image;
                $variants->save();
            }
            return redirect('edit/'.$product->id);
        }
        else
        {
            return Response::json(['success'=>'0','message'=>'Error whille adding product']);
        }
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
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $product=Product::paginate(15);
        return view('admin/all_products',compact('product'));
    }
    public function all_vendor()
    {
        $vendor=User::all();
        return view('admin/all_vendor',compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request,$id)
    {

        if ($request->category) {
            foreach ($request->category as $category) {
                $cat[] = $category;
            }
        }
        else {
            $cat[] = 'no category selected';
        }
        if ($request->sub_cat) {
            foreach ($request->sub_cat as $subcategory) {
                $sub_cat[] = $subcategory;
            }
        } else {
            $sub_cat[] = 'no sub category selected';
        }

        if($request->file('files') ) {
            foreach ($request->file('files') as $file) {

                $fileName = time() . rand() . '.' . $file->extension();

                $file->move(public_path() . '/images/', $fileName);


                $product_images = new Product_imageModel();
                $product_images->product_id = $id;
                $product_images->src = $fileName;
                $product_images->save();

            }
        }
//        $value1 = $request->option1_value;
//        $value2 = $request->option2_value;
//        $value3 = $request->option3_value;
//        $array1 = array($value1, $value2, $value3);
//        dd(json_encode($array1));
        $product = Product::find($id);
        $product->Title = $request->title;
        $product->Discription = $request->descrip;
        $product->Price = $request->price;
        $product->Compare_price = $request->price ? $request->price : 0;
        $product->SKU = $request->sku;
        $product->Barcode = $request->barcode;
        $product->Quantity = $request->quantity;
        $product->Weight = $request->weight;
        //$product->options = json_encode($array1);
        $product->vendor_status = $request->status;
//        unlink(public_path().'images/'.$id->Image);
        // $product->Image = json_encode($data);
        $product->categories = json_encode($cat);
        $product->sub_categories = json_encode($sub_cat);
        $saved = $product->save();
        if ($saved) {
            $variants = Vareint::where('product_id', $id)->get();
            foreach ($variants as $variant) {
                $variant->price = $request->variant_price[$variant->id];
                $variant->quantity = $request->variant_quantity[$variant->id];;
                $variant->sku = $request->variant_sku[$variant->id];;
                $variant->barcode = $request->variant_barcode[$variant->id];;
                $varient_update = $variant->save();
            }
        }
        // if ($varient_update) {
        return back()->with('message', 'Your product has been successfully updated');

        //}
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        //
    }
    public function category()
    {
        $categories=Categorie::all();
        return view('admin/category_page',compact('categories'));

    }
    public  function category_save(Request $request)
    {
        $categories = Categorie::create([
            'name'=>$request->cat_name,
            'icon'=>'no-icon.jpg',
        ]);


        $rules= [];
        array_push($rules,[
            "column"=> "tag",
            "relation" => "equals",
            "condition" =>  $request->cate_name
        ]);

        $collections=[
            "smart_collection" =>[
                "title"=>$request->cat_name,
                "rules"=>$rules,
            ]
        ];

       // dd($collections);

        $shop = $this->helper->getShopify();

        $response = $shop->rest('POST','/admin/api/2020-07/smart_collections.json',$collections)['body']['smart_collection'];



        $cat = new Categorie();
        $cat->exists=true;
        $cat->id = $categories->id;
        $cat->shopify_id = $response['id'];

        $cat->save();




        if ($categories)
        {
            return back()->with('message','Category added successfully');
        }
    }
    public  function sub_category_save(Request $request)
    {

        $categories = Subcategory::create([
            'Categorie_id'=>$request->category_id,
            'Subcategory_name'=>$request->sub_name
        ]);
        if ($categories)
        {
            return back()->with('message','Subcategory added successfully');
        }
    }
    public function all_product()
    {
        $products=Product::where('vendor_id',Auth::id())->paginate(5);

        return view('vendor/all_products',compact('products'));
    }
    public  function  edit($id)
    {
        $product =Product::find($id);
        $categories =Categorie::all();

        $zones =  Zone::where('product_id',$id)->get();
        $countries = Countries::all();

        return view('vendor/edit')->with([
            'product' => $product,
            'categories'=>$categories,
            'countries' =>$countries,
            'countries1' =>$countries,

            'zones'=>$zones

        ]);
    }
    public function product_view($id)
    {
        $product =Product::find($id);
        return view('admin/view_product')->with(['product'=>$product]);
    }
    public function view_product($id)
    {
        $product =Product::find($id);
        return view('vendor/view_product')->with(['product'=>$product]);
    }
    public function delete_product($id)
    {
        $product = Product::find($id);
        $variants = Vareint::where('product_id', $id)->get();
        foreach ($variants as $variant) {
            $variant->delete();
        }
//        unlink(public_path().'/images/'.$user->image);
        if ($product->Image == '') {
            $product->categories()->detach();
            $product->delete();
            return redirect()->back()->with('message', 'Product Deleted with Variants Successfully');
        } else {

            if(file_exists(public_path() . '/images/' . $product->Image))
            {

                unlink(public_path() . '/images/' . $product->Image);
            }

            $product_image = Product_imageModel::where('product_id', $id)->get();

            if($product->has_image)
            {

                foreach ($product_image as $product_image1)
                {

                    if(file_exists(public_path() . '/images/' . $product_image1->src))
                    {

                        unlink(public_path() . '/images/' . $product_image1->src);
                    }
                }

            }


            foreach ($product_image as $product_image1) {
                $product_image1->delete();
            }

            $product->categories()->detach();
            $product->delete();
            return redirect()->back()->with('message', 'Product Deleted with Variants Successfully');
        }
    }

    function edit_varient($product_id,$id)
    {
        // echo $product_id,' '.$id;


        $varient=Vareint::find($id);
        $product=Product::find($product_id);


        return view('vendor.edit_varient')->with(['varient'=>$varient,'product'=>$product]);

    }

    function edit_varient_save(Request $request,$id,$product_id)
    {
        $option1=$request->Option1;
        $option2='';
        $option3='';


        if(isset($request->Option3) && isset($request->Option2) && isset($request->Option1))
        {
            $option3=$request->Option3;
            $option2=$request->Option2;
            $varient2=Vareint::where('product_id',$product_id)->where('Option1',$option1)->where('Option2',$option2)
                ->where('Option3',$option3)
                ->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('form_error', 'Size and Color and material Value already exsits');
            }

            $varient=new Vareint();
            $varient->exists=true;
            $varient->id = $id;
            $varient->Option1=$option1;
            $varient->Option2=$option2;
            $varient->Option3=$option3;
            $varient->Title=$option1.'/'.$option2.'/'.$option3;

            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('success', 'Varient Update Successfully');

            }
            else{
                return redirect()->back()->with('form_error', 'something went wrong please update again!');

            }

        }

        if(isset($request->Option1) && !isset($request->option2))
        {

            $option2=$request->Option2;

            $varient2=Vareint::where('product_id',$product_id)->where('Option1',$option1)->where('Option2',$option2)->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('form_error', 'Size and Color Value already exsits');
            }

            $varient=new Vareint();
            $varient->exists=true;
            $varient->id = $id;
            $varient->Option1=$option1;
            $varient->Option2=$option2;
            $varient->Title=$option1.'/'.$option2;


            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('success', 'Varient Update Successfully');

            }
            else{
                return redirect()->back()->with('form_error', 'something went wrong please update again!');

            }
        }

        if(isset($request->Option1))
        {

            $option2=$request->Option2;

            $varient2=Vareint::where('product_id',$product_id)->where('Option1',$option1)->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('form_error', 'Size Value already exsits');
            }

            $varient=new Vareint();
            $varient->exists=true;
            $varient->id = $id;
            $varient->Option1=$option1;
            $varient->Title=$option1;


            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('success', 'Varient Update Successfully');

            }
            else{
                return redirect()->back()->with('form_error', 'something went wrong please update again!');

            }
        }

    }

    function edit_varient_details(Request $request,$id,$product_id)
    {

        $varient=new Vareint();
        $varient->exists=true;
        $varient->id = $id;
        $varient->Price=$request->Price;
        $varient->Quantity=$request->Quantity;
        $varient->SKU=$request->SKU;
        $varient->Barcode=$request->Barcode;

        $varient->save();

        if($varient==true)
        {
            return redirect()->back()->with('varient_success', 'Varient Update Successfully');

        }
        else{
            return redirect()->back()->with('varient_form_error', 'something went wrong please update again!');

        }
    }

    function varient_update(Request $request,$id,$product_id)
    {
        if ($request->hasfile('file')) {

            $fileName = time() . rand() . '.' . $request->file->extension();

            $request->file->move(public_path(). '/images/', $fileName);
            //$product_images=new Product_imageModel();
            $product_images = Product_imageModel::create([
                'product_id'=>$product_id,
                'src'=>$fileName
            ]);

            $varient=new Vareint();
            $varient->exists=true;
            $varient->id = $id;
            $varient->Image=$product_images->id;

            $varient->save();
            return redirect()->back()->with('varient_image_success', 'Varient Image Update Successfully');

        }
        else{
            return redirect()->back()->with('varient_image_form_error', 'Please Select Image');

        }
    }

    function varient_delete(Request $request)
    {

        $variants = Vareint::where('id', $request->id)->first();

        $variants->delete();
        return redirect()->back()->with('message', "Varient Delete successfully");
    }

    function varient_image_add(Request $request)
    {

        if(isset($request->image)) {
            $varient = new Vareint();
            $varient->exists = true;
            $varient->id = $request->id;
            $varient->Image = $request->image;

            $varient->save();
            if ($varient == true) {
                return redirect()->back()->with('message', 'Varient Image Update Successfully');
            } else {
                return redirect()->back()->with('message', 'Please Select Image');

            }
        }
        else{
            return redirect()->back()->with('message', 'Please Select Image');

        }

    }

    function varient_add(Request $request,$id)
    {
        $option1=$request->Option1;
        $option2='';
        $option3='';


        if(isset($request->Option3) && isset($request->Option2) && isset($request->Option1))
        {
            $option3=$request->Option3;
            $option2=$request->Option2;
            $varient2=Vareint::where('product_id',$id)->where('Option1',$option1)->where('Option2',$option2)
                ->where('Option3',$option3)
                ->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('message', 'Size and Color and material Value already exsits');
            }

            $varient=new Vareint();
            $varient->Option1=$option1;
            $varient->Option2=$option2;
            $varient->Option3=$option3;
            $varient->Title=$option1.'/'.$option2.'/'.$option3;
            $varient->Price=$request->Price;
            $varient->Quantity=$request->Quantity;
            $varient->SKU=$request->SKU;
            $varient->Barcode=$request->Barcode;
            $varient->product_id=$id;
            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('message', 'Varient Added Successfully');

            }
            else{
                return redirect()->back()->with('message', 'something went wrong please update again!');

            }

        }

        if(isset($request->Option1) && !isset($request->option2))
        {

            $option2=$request->Option2;

            $varient2=Vareint::where('product_id',$id)->where('Option1',$option1)->where('Option2',$option2)->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('message', 'Size and Color Value already exsits');
            }

            $varient=new Vareint();
            $varient->Option1=$option1;
            $varient->Option2=$option2;
            $varient->Title=$option1.'/'.$option2;
            $varient->Price=$request->Price;
            $varient->Quantity=$request->Quantity;
            $varient->SKU=$request->SKU;
            $varient->Barcode=$request->Barcode;
            $varient->product_id=$id;

            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('message', 'Varient Added Successfully');

            }
            else{
                return redirect()->back()->with('message', 'something went wrong please update again!');

            }
        }

        if(isset($request->Option1))
        {

            $option2=$request->Option2;

            $varient2=Vareint::where('product_id',$id)->where('Option1',$option1)->get();

            if(count($varient2) > 0)
            {
                return redirect()->back()->with('message', 'Size Value already exsits');
            }

            $varient=new Vareint();
            $varient->Option1=$option1;
            $varient->Title=$option1;
            $varient->Price=$request->Price;
            $varient->Quantity=$request->Quantity;
            $varient->SKU=$request->SKU;
            $varient->Barcode=$request->Barcode;
            $varient->product_id=$id;
            $varient->save();

            if($varient==true)
            {
                return redirect()->back()->with('message', 'Varient Added Successfully');

            }
            else{
                return redirect()->back()->with('message', 'something went wrong please update again!');

            }
        }
    }

    function image_delete(Request $request)
    {
        $product=Product_imageModel::find($request->id);


        if(file_exists(public_path() . '/images/' . $product->src))
        {

            unlink(public_path() . '/images/' . $product->src);

            $product->delete();
            return redirect()->back()->with('message', 'Image Deleted Successfully');
        }
        else
        {

            return redirect()->back()->with('message', 'Image not found');
        }



    }

}
