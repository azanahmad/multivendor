<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $vendor= DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.id','users.name','users.email','users.package')
            ->where('model_has_roles.role_id','=','2')
            ->where('users.id','=',Auth::id())
            ->first();

        if($vendor == true)
        {


            $user=User::find(Auth::id());
            //$user->has_subscription();

            if(count($user->has_subscription)) {

                foreach ($user->has_subscription as $sub) {

                        if($sub->stripe_status =='active') {
                            return $next($request);
                        }

                        if($sub->paypal_status =='Active') {
                            return $next($request);
                        }

                            return redirect()->route('package.pricing');




                }
            }
            else{

                return redirect()->route('package.pricing');
            }

        }
        else
        {
            return $next($request);
        }



    }
}
