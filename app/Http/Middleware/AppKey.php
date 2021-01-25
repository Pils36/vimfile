<?php

namespace App\Http\Middleware;

use Closure;

class AppKey
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

        $token = $request->bearerToken();


        if(isset($token) == true){

            $user = \App\User::where('api_token', $token)->first();

            if(!$user){

                return response()->json(['data' => 'Invalid Authorization Key', 'status' => 401], 401);

            }

        }
        else{
            return response()->json(['data' => 'Please provide Authorization Key', 'status' => 401], 401);
        }

        return $next($request);
    }
}
