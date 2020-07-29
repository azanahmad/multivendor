<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $vendor= DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.id','users.name','users.email','users.package')
            ->where('model_has_roles.role_id','=','2')
            ->where('users.id','=',Auth::id())
            ->first();

        $admin= DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.id','users.name','users.email','users.package')
            ->where('model_has_roles.role_id','=','1')
            ->where('users.id','=',Auth::id())
            ->first();

        if($vendor == true)
        {

//            if (\auth()->user()->subscribed('default')) {
//
//            }
            $user=User::find(Auth::id());
            //$user->has_subscription();

            if(count($user->has_subscription)) {


                foreach ($user->has_subscription as $sub) {

                    if ($sub->stripe == '1') {

                        if($sub->stripe_status =='active') {
                            return view('dashboard.index');
                        }
                    }

                    if($sub->paypal == '1')
                    {
                        if($sub->paypal_status =='Active') {
                            return view('dashboard.index');
                        }
                    }


                }


            }


        }

        if($admin == true)
        {

            return view('dashboard.index');

        }

            return view('dashboard.index');





    }
}
