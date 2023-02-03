<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(Auth::guard($guards)->check()){
            $user_type = Auth::user()->user_type;
            $status = Auth::user()->status;
            if($user_type == 'Admin' && $status == 'Active'){
                return redirect()->guest(route('admin'));
            }else if($user_type == 'Staff' && $status == 'Active'){
                return redirect()->guest(route('staff'));
            }else{
                Auth::logout();
                return '/login';
            }
            // switch($user_type){
            //     case 'Admin':
            //         return redirect()->guest(route('admin'));
            //         break;
            //     case 'Staff':
            //         return redirect()->guest(route('staff'));
            //         break;
            //     default:
            //         return redirect('/login');
            //         break;
            // }
        }
        return $next($request);
    }
}
