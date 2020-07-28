<?php

namespace App\Http\Controllers;

use App\Membership;
use App\Paypal\plan_create;
use App\Paypal\subscribe;
use Illuminate\Http\Request;
use App\Package;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Response;
use Session;
use Validator;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $apicontext;
    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AYHY_Ep9ZwoT6_jVVkY3cyFmZhvziMvp6Xvashf237LA9hPUNaqWYKVIXO7xO1m5pmbcmm8JH16ujhfB',     // ClientID
                'ECABlwQy-EvpdL12pB815aw3c8nPd3c4mWPU554IOpCfDnLJ1tqI8eKXUE79o6-pjLaA4x0eWE8iSMFs'      // ClientSecret
            )
        );
    }

    public  function create_plan1()
    {
        $plan =new plan_create();
        $plan->create1();

    }
    public  function create_plan2()
    {
        $plan =new plan_create();
        $plan->create2();

    }
    public function index()
    {
        return view('admin/admin_packages');
    }
    public  function list()
    {
        $plan =new plan_create();
        $plan->list();

    }
    public  function plan_detail($id)
    {
        $plan =new plan_create();
        return $plan->plan_detail($id);

    }
    public  function plan_activ($id)
    {
        $plan =new plan_create();
        $plan->plan_activ($id);

    }
    public  function subscribe($id)
    {

        $plan =new plan_create();
        return $plan->execute($id);

    }
    public  function subscribe2($id)
    {

        $plan =new plan_create();
        return $plan->execute2($id);

    }
    public function  succes($status){

if($status =='true')
{
    $plan =new plan_create();
  $plan->final1(request('token'));
$id= Auth::id();
$member=new Membership();
$member->token =\request('token');
$member->user_id=$id;
$member->save();
echo 'done';
}
    }
public function page()
{
    return view('vendor/buy_packages');
}

    public function all()
    {
        $package=Package::all();
        return view('admin/all_packages',['packages'=>$package]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function package_save(Request $request)
    {
         $rules = [
            'days' => 'required|string|max:100',
            'products' => 'required',
            'price' => 'required|string'
        ];
        $messages = array(
            'days.required'=>'This field is required',
            'products.required'=>'This field is required',
            'price.required'=>'This field is required',
        );
        $validator = Validator::make($request->all(), $rules, $messages);
 if($validator->fails()){
            return Response::json(['success'=>'0','validation'=>'0','message'=>$validator->errors()]);
        }
    else{
         $package = Package::create([
           'Days'=>$request->days,
           'Products'=>$request->products,
           'Price' => $request->price,
       ]);
         if($package)
         {
         return Response::json(['success'=>'1','message'=>'New membercheck has been sucessfully added']);
         }
         else
            {
               return Response::json(['success'=>'0','message'=>'Error whille adding membercheck']);
            }
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
