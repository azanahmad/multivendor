<?php

namespace App\Http\Controllers;

use App\order_line_items;
use App\OrderPayments;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index(Request $request,$id,$total)
    {


        $orders=order_line_items::where('vendor_id','=',$id)
            ->where('fulfillment_status','fulfilled')
            ->where('payment_status',0)->get();

        $payments = DB::table('order_line_items')
            ->select(DB::raw('sum(price) as total,order_id'))
            ->where('vendor_id','=',$id)
            ->where('fulfillment_status','fulfilled')
            ->where('payment_status',0)
            ->groupBy('order_id')->get();



//
//
//        foreach ($orders as $order) {
//            echo $order->id.'<br>';
//        }

//        die();
//sb-fjyes2622070@personal.example.com'
        $payouts = new \PayPal\Api\Payout();
        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");

        $senderItem = new \PayPal\Api\PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($request->email)
            ->setSenderItemId(uniqid())
            ->setAmount(new \PayPal\Api\Currency('{
                        "value":'.$total.',
                        "currency":"USD"
                    }'));


        $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);

        $request = clone $payouts;


        try
        {
            $output = $payouts->createSynchronous($this->apicontext );
            $batch_id =$output->batch_header->payout_batch_id;
            foreach ($payments as $payment)
            {
                $order_payment=new OrderPayments();
                $order_payment->order_id=$payment->order_id;
                $order_payment->vendor_id=$id;
                $order_payment->paypal='1';
                $order_payment->payment=$payment->total;
                $order_payment->paypal_batch_id=$batch_id;
                $order_payment->status='paid';
                $order_payment->save();
            }
            dd('hello');

            foreach ($payments as $pay)
            {
                $update=DB::table('order_line_items')->where('vendor_id','=',$id)
                    ->where('order_id','=',$pay->order_id)
                    ->update(['payment_status' =>'1']);
            }

            return redirect()->back()->with('success','Payment Transfer Successfully');
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {


            return redirect()->back()->with('form_error','Try again later!');
        }

    }

    function stripe_payment(Request $request,$id,$total)
    {
        $date='';
        if (isset($request->date))
        {
            $date = $request->date;
            $date = explode('-', $date);
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];
        }


        $orders=order_line_items::where('vendor_id','=',$id)
            ->where('fulfillment_status','fulfilled')
            ->where('payment_status',0)->get();

        $payments = DB::table('order_line_items')
            ->select(DB::raw('sum(price) as total,order_id'))
            ->where('vendor_id','=',$id)
            ->where('fulfillment_status','fulfilled')
            ->where('payment_status',0)
            ->groupBy('order_id')->get();


        foreach ($payments as $payment)
        {
            $order_payment=new OrderPayments();
            $order_payment->order_id=$payment->order_id;
            $order_payment->vendor_id=$id;
            $order_payment->stripe='1';
            $order_payment->payment=$payment->total;
            $order_payment->status='paid';
            $order_payment->notes=$request->note;
            $order_payment->date=$date;
            $order_payment->tracking=$request->tracking;
            $order_payment->save();
        }

        if($order_payment == true)
        {
            foreach ($payments as $pay)
            {
                $update=DB::table('order_line_items')->where('vendor_id','=',$id)
                    ->where('order_id','=',$pay->order_id)
                    ->update(['payment_status' =>'1']);
            }

            return redirect()->back()->with('success','Payout Generated Successfully');

        }
        else
        {
            return redirect()->back()->with('form_error','Try again later!');


        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


//        $users=DB::table('users')->where('id','=',$id)->first();
//        // Stripe::setApiKey("sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr");
//
//        $stripe = new \Stripe\StripeClient(
//            'sk_test_51H5ARTEmGDZcZ7jtPYU3vAagQXZuRUR0cUdiCilwWt6MAGrAYZdTPCh0fjSEVUglYwoeSXGa55H0IQDWdDy080Dw00fVenefWr'
//        );
//
//
//        try{
//            $stripe->payouts->create([
//                'amount' => $total,
//                'currency' => 'usd',
//                'destination' => $users->stripe_id,
//                "source_type" => $users->card_last_four,
////                "type"=> "bank_account"
//            ]);
//
//        }
//
//        catch (\Exception $exception){
//
//            dd($exception);
//        }


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
