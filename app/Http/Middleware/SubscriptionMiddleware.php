<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $active_subscription= $request->user()->load('subscriptions')->where('status', 'active')->first();
        if(!$active_subscription){
            ResponseTrait::sendError('Access denied', 'Your orgnisation does have any active subscription. Please renew your subscription fee', 403);
        }
        return $next($request);
    }
}
