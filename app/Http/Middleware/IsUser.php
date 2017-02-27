<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use DB;
class IsUser
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
      if(auth()->check() && $request->user()->role==2){
          if(Request::is('rtrwnet/'.'*')){
            $result = DB::table('ms_admin_rtrwnet')->where('kdRtRwNet','=',$request->kd)->where('kdUser','=',$request->user()->id)->first();
            if($result != null){
              return $next($request);
            }else{
                  return Redirect()->action('DashboardCon@index');
            }
          }

      }
        //return $next($request);
    }
}
