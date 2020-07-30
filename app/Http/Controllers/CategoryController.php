<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Shipping_rate;
use App\Shipping_zone;
use App\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

    public function category_update(Request $request)
    {
        if($request->hasFile('icon')&& $request->icon->isValid())
        {
            $name = $request->icon->getClientOriginalName();
            $filename = $name;
            $request->icon->move(public_path() . '/icons/', $name);
        }
        else{
            $filename='no-icon.jpg';
        }
        $category = Categorie::find($request->category_id);
        $category->name = $request->name;
        $category->icon =$filename;
        $category_update =$category->save();
        if($category_update)
        {
            return  back()->with('message','Category update successfully');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_delete($id)
    {
        $category = Categorie::find($id);
        $shop = $this->helper->getShopify();

        $response = $shop->rest('DELETE','/admin/api/2020-07/smart_collections/'.$category->shopify_id.'.json');

     //   dd($response);
        $category->delete();


        return redirect()->back()->with('message', 'Category  Deleted  Successfully');
    }
    public function subcategory_delete($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with('message', 'Subcategory  Deleted  Successfully');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subcategory_update(Request $request)
    {
        $subcategory = Subcategory::find($request->subcategory_id);
        $subcategory->categorie_id = $request->category_id;
        $subcategory->Subcategory_name = $request->subcategory_name;
        $subcategory_update =$subcategory->save();
        if($subcategory_update)
        {
            return  back()->with('message','Subcategory update successfully');
        }
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
}
