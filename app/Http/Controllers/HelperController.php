<?php

namespace App\Http\Controllers;

use App\User;
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
        $domain = 'mullti-vendors.myshopify.com';
        $api = new BasicShopifyAPI($options);
        $shop = User::where('name', $domain)->first();
        $api->setSession(new Session('mullti-vendors.myshopify.com', $shop->password));
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
}
