<?php

namespace App\Http\Middleware;

use App\Constants\Roles;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;

class IsPresidentOrIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         $allowedRoles =  [Roles::MEMBER, Roles::PRESIDENT, Roles::ADMIN];
        $userRoles = $request->user()->roles->whereIn('name', $allowedRoles);

        if ($userRoles->isEmpty() || count($userRoles) < 2) {
            return ResponseTrait::sendError('Access denied', 'You dont have the role to access this route', 403);
        }
        return $next($request);
    }
}
