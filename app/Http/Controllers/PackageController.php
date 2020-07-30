<?php

namespace App\Http\Controllers;


use App\PackageModel;
use App\Subscription;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\Payer;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use Stripe\Charge;
use Stripe\Error\ApiConnection;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;


class PackageController extends Controller
{
    public $apicontext;

    public function __construct()
    {
        $this->apicontext = new  \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AZPsITqkKResvbPmLfS73RL8On2yH0o58eLp1xGUPthmhqR6qmacVW8Swl6zI0-4C7LsZuIdHNi7Piws',     // ClientID
                'ENaJ8k_F_6F3x9pG63XhUuOaISgb_c-yvFFRTULMZpXQsVmtQVQHyU20SlcSo5YKKKxU-7HseIwFnCjQ'// ClientSecret
            )
        );

        $this->middleware('auth');

    }

    public function index()
    {
        return view('package.add_package');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'rates' => 'required|integer',
            ]
        );

        if($validator->fails()){
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }



        $package = new PackageModel();

        $package->package_name = $request->package_name;
        $package->no_products_allow = $request->no_products_allow;
        $package->rates = $request->rates;
        $package->plan_description = $request->plan_description;
        $package->type=$request->type;

        $frequency='1';

        if($request->type=="every 3 months")
        {



            $request->type='Month';
            $frequency='3';
        }

        if($request->type=="every 6 months")
        {


            $request->type='Month';
            $frequency='6';

        }

        $plan=$this->setplan($request->package_name,$request->plan_description);




        $paymentDefinition = $this->setCharges($request->plan_description, 'REGULAR', $request->type, $frequency, '12', $request->rates, 'USD');

        $merchantPreferences = $this->setmerchantPreferences();

        $plan->setPaymentDefinitions(array($paymentDefinition));

        $plan->setMerchantPreferences($merchantPreferences);


        try
        {

            $basic_plan = $plan->create($this->apicontext);

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {


        dd($ex);
        }



        $package->paypal_plan_id = $basic_plan->id;

        $package->status = '0';
        $array=explode(' ',$request->package_name);
        $strip_id=$array[0].rand(10,100).rand(10,100);
        Stripe::setApiKey("sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr");
        try {
            if ($request->type == 'Month') {
                $fre = 'month';
                $in = '12';

            }

            if ($request->type == 'Year') {
                $fre = 'year';
                $in = '1';
            }

            if ($request->type == "every 6 months") {


                $fre = 'month';
                $in = '6';

            }

            if ($request->type == "every 3 months") {


                $fre = 'month';
                $in = '3';
            }

            $rates = $request->rates * 100;

            if ($rates == 0) {

                \Stripe\Plan::create(array(
                    // "amount" => $request->rates,
                    "amount" => $rates,
                    "interval" => $fre,
                    "interval_count" => '1',
                    "product" => array(
                        "name" => $request->package_name
                    ),
                    "currency" => "USD",
                    "id" => "$strip_id",
                ));

            }
            else {

            \Stripe\Plan::create(array(
                // "amount" => $request->rates,
                "amount" => $rates,
                "interval" => $fre,
                "interval_count" => $in,
                "product" => array(
                    "name" => $request->package_name
                ),
                "currency" => "USD",
                "id" => "$strip_id",
            ));
        }


        }
        catch (Exception $msg)
        {
            dd($msg);
        }

        $package->strip_id=$strip_id;
        $package->save();

        if($package ==true)
        {
            return redirect()
                ->back()
                ->with('success', 'Package created successfully');
        }
        else
         {
            return redirect()
                ->back()
                ->withInput()
                ->with('form_error', 'Something is wrong with these Inputs Please Check And Re Submit Again!');
        }

    }

    /**
     * Display the specified resource.
     *

     */
    public function show()
    {
        $package=PackageModel::get();

        return view('package.view_package')->with(['package'=>$package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $package=PackageModel::where('id',$id)->first();

        return view('package.add_package')->with(['package'=>$package]);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $package = new PackageModel();
        $package->exists=true;
        $package->id = $id;
        $package->package_name = $request->package_name;
        $package->no_products_allow = $request->no_products_allow;
        $package->rates = $request->rates;
        $package->plan_description=$request->plan_description;
        $package->type=$request->type;

        $package->save();

        if($package ==true)
        {

            if($package->status==0) {
                $package_plan = PackageModel::find($id);

                $patch = new Patch();

                $value = new PayPalModel('{
                "name":"' . $request->package_name . '",
                "description":"' . $request->plan_description . '"
                     }');

                $patch->setOp('replace')
                    ->setPath('/')
                    ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $plan = Plan::get($package_plan->paypal_plan_id, $this->apicontext);

                $plan->update($patchRequest, $this->apicontext);

                $paymentDefinitions = $plan->getPaymentDefinitions();
                $paymentDefinitionId = $paymentDefinitions[0]->getId();
                $patch->setOp('replace')
                    ->setPath('/payment-definitions/' . $paymentDefinitionId)
                    ->setValue(json_decode(
                        '{
                        "frequency": "'.$request->type.'",
                    "amount": {
                        "currency": "USD",
                        "value": "'.$request->rates.'"
                    }
                        }'
                    ));
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);

                $plan->update($patchRequest, $this->apicontext);

                //strip plan update
//                Stripe::setApiKey("sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr");
//                try{
//                    if($request->type=='Month')
//                    {
//                        $fre='month';
//                        $in='12';
//
//                    }else{
//                        $fre='year';
//                        $in='1';
//                    }
//
//                    $rates=$request->rates*100;
//                    \Stripe\Plan::update(
//                        "$package_plan->strip_id",
//                        [
//                        "amount" => "$rates"
//                    ]
//                    );
//                }catch (Exception $msg)
//                {
//                    dd($msg);
//                }


            }

            return redirect()
                ->back()
                ->with('success', 'Package updated successfully');
        }
        else{
            return redirect()
                ->back()
                ->withInput()
                ->with('form_error', 'You have made no changes to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        $package=PackageModel::find($request->id);
        $plan = Plan::get($package->paypal_plan_id, $this->apicontext);
        $plan->delete($this->apicontext);
        $stripe = new \Stripe\StripeClient(
            'sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr'
        );
        $stripe->plans->delete($package->strip_id, []);

        $delete = PackageModel::destroy($request->id);
        if($delete)
        {
            return redirect()
                ->back()
                ->with('success', 'Package deleted successfully');
        }
        else
        {
            return redirect()
                ->back()
                ->withInput()
                ->with('form_error', 'Package not deleted');
        }
    }

    public function pricing()
    {
        $package=PackageModel::where('status','1')->get();
        return view('pricing')->with(['package'=>$package]);
    }

    public function payment()
    {

    }

    public function setplan($name, $desc): Plan
    {
        $plan = new Plan();
        $plan->setName($name)
            ->setDescription($desc)
            ->setType('fixed');


        return $plan;
    }

    public function setCharges($name, $type, $frequency, $frequencyInterval, $cycles, $charges, $currency): PaymentDefinition
    {



        $paymentDefinition = new PaymentDefinition();

        if($charges==0)
        {

            if ($frequency == 'Month') {

                $in = 1*30;

            }

            if ($frequency == 'Year') {

                $in = 12*30;
            }

            if ($frequency == "every 6 months") {



                $in = 6*30;

            }

            if ($frequency == "every 3 months") {


                $in = 3*30;
            }



            $paymentDefinition->setName($name)
                ->setType('TRIAL')
                ->setFrequency('day')
                ->setFrequencyInterval($in)
                ->setCycles("1")
                ->setAmount(new Currency(array('value' => 0, 'currency' => 'USD')));
        }
        else {
            $paymentDefinition->setName($name)
                ->setType($type)
                ->setFrequency($frequency)
                ->setFrequencyInterval($frequencyInterval)
                ->setCycles($cycles)
                ->setAmount(new Currency(array('value' => $charges, 'currency' => $currency)));
        }

        return $paymentDefinition;
    }

    public function setmerchantPreferences(): MerchantPreferences
    {
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(env('APP_URL').'/execute/agreement/true')
            ->setCancelUrl(env('APP_URL').'/execute/agreement/false')
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setMaxFailAttempts('3');

        return $merchantPreferences;

    }
    public function getPlans(Request $request)
    {

        $paypal_plan_ids = \App\Plan::where('name', 'Basic')
            ->Where('name', 'Advanced')
            ->pluck('paypal_plan_id')->toArray();
        $array = array();
        foreach ($paypal_plan_ids as $id) {
            $plan = Plan::get($id, $this->apicontext);
            array_push($array,$plan);
        }
        dd($array);

    }
    function activate($id)
    {

        $plan_id=PackageModel::find($id);

        $patch = new Patch();

        $value = new PayPalModel('{
          "state":"ACTIVE"
        }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);
        $plan = Plan::get($plan_id->paypal_plan_id, $this->apicontext);
        $plan->update($patchRequest, $this->apicontext);

        $package = new PackageModel();
        $package->exists=true;
        $package->id = $id;
        $package->status='1';
        $package->save();

        return redirect()
            ->back()
            ->with('success', 'Package Activated successfully');
    }

    function list_plan()
    {
//        $params = array('page_size' => '1');
//        $planList = Plan::all($params, $this->apicontext);
//
//        dd($planList);
//

//
//      $plan->delete($this->apicontext);
////        echo 'ok';
//        dd($plan);
//        $params = array('page_size' => '2');
//        $planList = Plan::all($params, $this->apicontext);
//        foreach ($planList->plans as $plan) {
//            $plan->delete($this->apicontext);
//        }
//        dd('ok');
//P-82P883281T467380FJPNVB7A

        // $patch = new Patch();
        $plan = Plan::get('P-0MT81827ME090193RKI53XHI', $this->apicontext);
        dd($plan);


//        $paymentDefinitions = $plan->getPaymentDefinitions();
//        $paymentDefinitionId = $paymentDefinitions[0]->getId();
//        $patch->setOp('replace')
//            ->setPath('/payment-definitions/' . $paymentDefinitionId)
//            ->setValue(json_decode(
//                '{
//                    "amount": {
//                        "currency": "USD",
//                        "value": "500"
//                    }
//            }'
//            ));
//        $patchRequest = new PatchRequest();
//        $patchRequest->addPatch($patch);
//
//        $plan->update($patchRequest, $this->apicontext);

//        $patch = new Patch();
//
//        $value = new PayPalModel('{
//          "state":"CREATED"
//        }');
//
//        $patch->setOp('replace')
//            ->setPath('/')
//            ->setValue($value);
//        $patchRequest = new PatchRequest();
//        $patchRequest->addPatch($patch);
//        $plan = Plan::get('P-1L570850J11735635JPS5MXA', $this->apicontext);
//        dd($plan);
//        $plan->update($patchRequest, $this->apicontext);

    }
    function create_agreement(Request $request)
    {
        $id=decrypt($request->id);
        $plan_info=PackageModel::find($id);

        if($request->payment_method=='paypal')
        {
            $id=$plan_info->paypal_plan_id;
            $plan_details = PackageModel::where('paypal_plan_id', $id)->first();

            date_default_timezone_set('Asia/Karachi');
            $date = date("Y-m-d\TH:i:s\Z", time());

            $agreement = new Agreement();

            $agreement->setName($plan_details->package_name )
                ->setDescription($plan_details->plan_description)
                ->setStartDate($date);


            $created_plan = Plan::get($id, $this->apicontext);
            $plan = new Plan();
            $plan->setId($created_plan->getId());
            $agreement->setPlan($plan);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');
            $agreement->setPayer($payer);

            try {
                // Create agreement
                $agreement = $agreement->create($this->apicontext);

                $subcription = new Subscription();
                $subcription->user_id = Auth::id();
                $subcription->pay_pal_plan_id = $plan_details->paypal_plan_id;
                $subcription->billing_address = $request->input('street') . ' ' . $request->input('city') . ' ' . $request->input('country') . ' ' . $request->input('zip_code');
                $subcription->paypal_status = 'new';
                $subcription->paypal_active_subscription= 'no';
                $subcription->plan_id=$plan_details->id;
                $subcription->name='PayPal';


                $subcription->save();

                // Extract approval URL to redirect user
                $approvalUrl = $agreement->getApprovalLink();
                return redirect($approvalUrl);

            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        }

        if($request->payment_method=='strip'){

            $address = $request->input('street') . ' ' . $request->input('city') . ' ' . $request->input('country') . ' ' . $request->input('zip_code');

            return view('payment',['package' =>$plan_info,'address'=>$address,
                'intent' => \auth()->user()->createSetupIntent()
            ]);

        }

    }
    function success()
    {
        return redirect(route('home'))->with('success', 'Stripe Subscription Purchased');
    }

    function strip_subscribe(Request $request)
    {
        $user = \auth()->user();
        $paymentMethod=$request->payment_method;
        $billing=$request->address;
        $plan=PackageModel::find($request->id);
        $planid=$plan->strip_id;

        $user->newSubscription('Basic', $planid)->create($paymentMethod);



//            $update=DB::table('subscriptions')->where('stripe_id','=',$paymentMethod)
//            ->update(['strip'=>1,'billing_address'=>$billing]);
//            return redirect(route('home'))->with('success', 'Strip Subscription Purchased');
        return 'success';


    }
    public function execute_agreement(Request $request)
    {

        if (isset($_GET['token']) && $request->status == 'true') {
            $token = $_GET['token'];
            $agreement = new \PayPal\Api\Agreement();

            try {
                // Execute agreement
                $output = $agreement->execute($token, $this->apicontext);

                $old_subscription = Subscription::where('user_id', Auth::id())
                    ->where('paypal_active_subscription','yes')->first();
                if($old_subscription != null){
                    if($old_subscription != null && $old_subscription->paypal_status == 'Active'){

                        $old_agreement = Agreement::get($old_subscription->paypal_subscription_id, $this->apicontext);
                        $agreementStateDescriptor = new AgreementStateDescriptor();
                        $agreementStateDescriptor->setNote("User Re-Buy Subscription ");

                        $old_agreement->cancel($agreementStateDescriptor, $this->apicontext);
                        $old_subscription->paypal_active_subscription = 'no';
                        $old_subscription->paypal_status	= "Cancel";
                        $old_subscription->save();
                    }
                    else{
                        $old_subscription->paypal_active_subscription= 'no';
                        $old_subscription->paypal_status = "Cancel";
                        $old_subscription->save();
                    }
                }


                $subcription = Subscription::where('user_id', Auth::id())
                    ->where('paypal_status', 'new')->first();
                $subcription->paypal_subscription_id = $output->id;
                $subcription->paypal_status = $output->state;
                date_default_timezone_set('Asia/Karachi');
                $date = date_create($output->start_date)->format('Y-m-d H:i:s');
                $subcription->paypal_subscription_starts_at = $date;
                $subcription->paypal_active_subscription = 'yes';
                $subcription->paypal=1;
                $subcription->save();


                $user = new User();
                $user->exists=true;
                $user->id = Auth::id();
                $user->package = '1';
                $user->save();

//                $planController = new PlanController();
//                $planController->upgrade_plan($subcription->plan_id);

                return redirect(route('dashboard'))->with('success', 'Paypal Subscription Purchased');

            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } else {
            $subcriptions = Subscription::where('user_id', Auth::id())
                ->where('paypal_status', 'new')->get();
            foreach ($subcriptions as $subcription) {
                $subcription->delete();
            }

            return redirect()->route('dashboard')->with('form_error', 'user canceled agreement');

        }

    }

    function check()
    {
//        Stripe::setApiKey("pk_test_51H5ARTEmGDZcZ7jt08AZRJFdxtweiG6NEYbwYuTOnK8d0QT9lK2MOZ07MQYINKxVJshfKElIwAMpbzc3aaFX8BZS00beoKvw2J
//");
//
//        try{
//            \Stripe\Plan::create(array(
//                "amount" => 5000,
//                "interval" => "month",
//                "product" => array(
//                    "name" => "Bronze standard"
//                ),
//                "currency" => "USD",
//                "id" => "bronze-standard"
//            ));
//        }catch (Exception $msg)
//        {
//            dd($msg);
//        }


//        Stripe::setApiKey("sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr");
////        try{
//
//        $type='Month';
//        if($type=='Month')
//        {
//            $fre='month';
//
//        }else{
//            $fre='year';
//        }
//        $strip_id="asdasddda";
//        $rates=500*100;
//        \Stripe\Plan::create(array(
//            "amount_decimal" => "$rates",
//            "interval" => $fre,
//            "aggregate_usage"=> null,
//            "product" => array(
//                "name" => "latest"
//            ),
//            "currency" => "USD",
//            "id" => "$strip_id",
//        ));

//    Stripe::setApiKey("sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr");
////        $stripe->plans->delete('gold', []);
//        try {
//            (new \Stripe\Plan)->delete('Professional4433', []);
//        } catch (ApiErrorException $e) {
//            dd($e);
//        }
        $stripe = new \Stripe\StripeClient(
            'sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr'
        );
        $stripe->plans->delete('Professional4433', []);
    }

    function cart($id)
    {


        $id= decrypt($id);
        $package=PackageModel::find($id);

        return view('pricing_cart',['package'=>$package]);

    }

}

