<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Subscription;
use App\Models\User;


class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
//     if (!auth()->check() || !auth()->user()->isSubscribed()) {
//     return redirect()->route('subscription.form')->with('error', 'Langganan diperlukan');
// }

// return $next($request);

}

}
