<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckRole
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
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if($roles == null){
            return $next($request);
        } else {
            $user = auth()->user();
            if(!$user){
                return response()->json([
                    'message' => 'Token not provied. Unauthorized.',
                ], 401);
            } else {
                if($user->hasAnyRole($roles)){
                    return $next($request);
                } else {
                    return response()->json([
                        'message' => 'Your role havent got access to this resource',
                    ], 401);
                }
            }
        }

        
    }
}
