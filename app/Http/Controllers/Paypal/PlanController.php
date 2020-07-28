<?


use App\Email;
use App\Jobs\EmailQueue;
use App\Mail\SubscriptionCancelledNotification;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


class PaypalController extends Controller
{
    public $apicontext;

    public function __construct()
    {
        $this->apicontext = new ApiContext(
            new OAuthTokenCredential(
                'AZPeDPJuNGx0ib9bx6TNaQU6gRrtPyu-sexfhdYbRfprYoWHbhdz_hUq0Fim2JHPyArUSWR9KUv82Y-9',     // ClientID
                'EAlREK3FZWbSK_65s9kc9Punh_kIhqcFoTqMJRnysWQQnPNhAEpvYhIsrRJPAkn_G7AQRTXcqikIyltY'      // ClientSecret
            )
        );;
    }

    public function create_paypal_plans(Request $request)
    {

        /*BASIC PLAN*/
        $basic_plan_details = \App\Plan::where('name', 'basic')->first();
        $plan = $this->setplan('Basic', 'Cleverly Basic Plan');
        $paymentDefinition = $this->setCharges('Cleverly Basic Plan', 'REGULAR', 'MONTH', '1', '12', $basic_plan_details->price, 'USD');
        $merchantPreferences = $this->setmerchantPreferences();
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        $basic_plan = $plan->create($this->apicontext);

        $basic_plan_details->paypal_plan_id = $basic_plan->id;
        $basic_plan_details->save();

        /*ADVANCED PLAN*/
        $advanced_plan_details = \App\Plan::where('name', 'Advanced')->first();

        $plan = $this->setplan('Advanced', 'Cleverly Advanced Plan');
        $paymentDefinition = $this->setCharges('Cleverly Advanced Plan', 'REGULAR', 'MONTH', '1', '12', $advanced_plan_details->price, 'USD');
        $merchantPreferences = $this->setmerchantPreferences();
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $advanced_plan = $plan->create($this->apicontext);

        $advanced_plan_details->paypal_plan_id = $advanced_plan->id;
        $advanced_plan_details->save();

        /*PREMIUM PLAN*/
        $premium_plan_details = \App\Plan::where('name', 'Premium')->first();

        $plan = $this->setplan('Premium', 'Cleverly Premium Plan');
        $paymentDefinition = $this->setCharges('Cleverly Premium Plan', 'REGULAR', 'MONTH', '1', '12', $premium_plan_details->price, 'USD');
        $merchantPreferences = $this->setmerchantPreferences();
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        $premium_plan = $plan->create($this->apicontext);

        $premium_plan_details->paypal_plan_id = $premium_plan->id;
        $premium_plan_details->save();

        return 'plans created';

    }

    public function create_custom_plan(){
        /*custom PLAN*/
        $custom_plan_details = \App\Plan::where('type', 'custom')->whereNull('paypal_plan_id')->first();
        $plan = $this->setplan( $custom_plan_details->name , 'Cleverly Custom Plan');
        $paymentDefinition = $this->setCharges('Cleverly Custom Plan', 'REGULAR', 'MONTH', '1', '12', $custom_plan_details->price, 'USD');
        $merchantPreferences = $this->setmerchantPreferences();
        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);
        $custom_plan = $plan->create($this->apicontext);

        $custom_plan_details->paypal_plan_id = $custom_plan->id;
        $custom_plan_details->save();
        return 'plan created';
    }

    public function getPlans(Request $request)
    {

        $paypal_plan_ids = \App\Plan::where('name', 'Basic')
            ->orWhere('name', 'Advanced')
            ->orWhere('name', 'Premium')->pluck('paypal_plan_id')->toArray();
        $array = array();
        foreach ($paypal_plan_ids as $id) {
            $plan = Plan::get($id, $this->apicontext);
            array_push($array,$plan);
        }
        dd($array);

    }


    public function create_agreement(Request $request)
    {
        $plan_details = \App\Plan::where('paypal_plan_id', $request->input('paypal_plan_id'))->first();

        date_default_timezone_set('Asia/Karachi');
        $date = date("Y-m-d\TH:i:s\Z", time());

        $agreement = new Agreement();

        $agreement->setName('Cleverly ' . $plan_details->name . ' Monthly Subscription')
            ->setDescription('Cleverly ' . $plan_details->name . ' Monthly Plan')
            ->setStartDate($date);

        $created_plan = Plan::get($request->input('paypal_plan_id'), $this->apicontext);
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
            $subcription->plan_id = $plan_details->id;
            $subcription->billing_address = $request->input('street') . ' ' . $request->input('city') . ' ' . $request->input('country') . ' ' . $request->input('zip_code');
            $subcription->status = 'new';
            $subcription->active_subscription = 'no';
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

    public function execute_agreement(Request $request)
    {

        if (isset($_GET['token']) && $request->status == 'true') {
            $token = $_GET['token'];
            $agreement = new \PayPal\Api\Agreement();

            try {
                // Execute agreement
                $output = $agreement->execute($token, $this->apicontext);

                $old_subscription = Subscription::where('user_id', Auth::id())
                    ->where('active_subscription','yes')->first();
                if($old_subscription != null){
                    if($old_subscription != null && $old_subscription->status == 'Active'){

                        $old_agreement = Agreement::get($old_subscription->paypal_subscription_id, $this->apicontext);
                        $agreementStateDescriptor = new AgreementStateDescriptor();
                        $agreementStateDescriptor->setNote("User Re-Buy Subscription ");

                        $old_agreement->cancel($agreementStateDescriptor, $this->apicontext);
                        $old_subscription->active_subscription = 'no';
                        $old_subscription->status = "Cancel";
                        $old_subscription->save();
                    }
                    else{
                        $old_subscription->active_subscription = 'no';
                        $old_subscription->status = "Cancel";
                        $old_subscription->save();
                    }
                }


                $subcription = Subscription::where('user_id', Auth::id())
                    ->where('status', 'new')->first();
                $subcription->paypal_subscription_id = $output->id;
                $subcription->status = $output->state;
                date_default_timezone_set('Asia/Karachi');
                $date = date_create($output->start_date)->format('Y-m-d H:i:s');
                $subcription->subscription_starts_at = $date;
                $subcription->active_subscription = 'yes';
                $subcription->save();

                $planController = new PlanController();
                $planController->upgrade_plan($subcription->plan_id);


                return redirect(route('app.dashboard'))->with('msg', 'Subscription Purchased');

            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } else {
            $subcriptions = Subscription::where('user_id', Auth::id())
                ->where('status', 'new')->get();
            foreach ($subcriptions as $subcription) {
                $subcription->delete();
            }

            return redirect()->route('app.dashboard')->with('msg', 'user canceled agreement');

        }

    }

    public function get_agreement(Request $request)
    {
        $agreement = Agreement::get('I-XK2HYVC73V7C', $this->apicontext);

//        $params = array('start_date' => date('Y-m-d', strtotime('-15 years')), 'end_date' => date('Y-m-d', strtotime('+5 days')));
//        $result = Agreement::searchTransactions('I-KXMKDGEUPBH9', $params, $this->apicontext);
//        dd($result);

//        $params = array('start_date' => date('Y-m-d', strtotime('-15 years')), 'end_date' => date('Y-m-d', strtotime('+5 days')));
//        $agreement_transaction = Agreement::searchTransactions('I-D3S7VDBEDNEE',$params,$this->apicontext);
//        $agreementStateDescriptor = new AgreementStateDescriptor();
//        $agreementStateDescriptor->setNote("Suspending the agreement Because You Violated Our Rules");
//        $agreement->suspend($agreementStateDescriptor, $this->apicontext);
////       Lets get the updated Agreement Object


//        $agreementStateDescriptor = new AgreementStateDescriptor();
//        $agreementStateDescriptor->setNote("Cancel the agreement ");
////        $agreement->reActivate($agreementStateDescriptor, $this->apicontext);
////        $agreement = Agreement::get('I-D3S7VDBEDNEE', $this->apicontext);
//        $agreement->cancel($agreementStateDescriptor,$this->apicontext);
//        $agreement = Agreement::get('I-UKLS7R7CMP2X', $this->apicontext);

        dd($agreement);
    }


    /**
     * @param $name
     * @param $desc
     * @return Plan
     */
    public function setplan($name, $desc): Plan
    {
        $plan = new Plan();
        $plan->setName($name)
            ->setDescription($desc)
            ->setType('fixed');
        return $plan;
    }

    public function deletePlan(Request $request)
    {
        $params = array('page_size' => '10');
        $planList = Plan::all($params, $this->apicontext);
        foreach ($planList->plans as $plan) {
            $plan->delete($this->apicontext);
        }
        dd('ok');
    }

    public function ActivatePlans(Request $request)
    {

        $paypal_plan_ids = \App\Plan::where('name', 'Basic')
            ->orWhere('name', 'Advanced')
            ->orWhere('name', 'Premium')->pluck('paypal_plan_id')->toArray();
//        dd($paypal_plan_ids);

        $patch = new Patch();

        $value = new PayPalModel('{
          "state":"ACTIVE"
        }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);
        foreach ($paypal_plan_ids as $id) {
            $plan = Plan::get($id, $this->apicontext);
            $plan->update($patchRequest, $this->apicontext);
        }
        dd('plans activated');
    }

    /**
     * @param $name
     * @param $type
     * @param $frequency
     * @param $frequencyInterval
     * @param $cycles
     * @param $charges
     * @param $currency
     * @return PaymentDefinition
     */
    public function setCharges($name, $type, $frequency, $frequencyInterval, $cycles, $charges, $currency): PaymentDefinition
    {
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName($name)
            ->setType($type)
            ->setFrequency($frequency)
            ->setFrequencyInterval($frequencyInterval)
            ->setCycles($cycles)
            ->setAmount(new Currency(array('value' => $charges, 'currency' => $currency)));
        return $paymentDefinition;
    }

    /**
     * @return MerchantPreferences
     */
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

    public function addWebhook(Request $request)
    {

    }


    public function cancel_subscription(Request $request)
    {

        $agreement = Agreement::get($request->id, $this->apicontext);
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("User Cancelled Agreement ");
        $agreement->cancel($agreementStateDescriptor, $this->apicontext);

        $subscription = Subscription::where('paypal_subscription_id', $request->id)
            ->where('user_id', Auth::id())->first();

        $subscription->status = "Cancel";
        $subscription->save();

        $user = User::find(Auth::id());
        if (Email::where('email_name' , 'SubscriptionCancelledNotification')->where('status', 1)->get()->first()) {
            $mail = new SubscriptionCancelledNotification($user);
            dispatch(new EmailQueue($user, $mail));
        }
        return redirect()->back()->with('msg','Subscription Cancelled');


    }

}
