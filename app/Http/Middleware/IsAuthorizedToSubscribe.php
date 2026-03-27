<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuthorizedToSubscribe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();

        if (!$user) {
            return ResponseTrait::sendError('Access denied', 'You are not authorized to login', 403);
        }

        $allowedRoles = ['ADMIN', 'PRESIDENT', 'FINANCIAL_SECRETARY', 'TREASURER', 'AUDITOR', 'SYSTEM_ADMIN'];
        $userRoles = $user->roles->whereIn('name', $allowedRoles);

        if ($userRoles->isEmpty()) {
            return ResponseTrait::sendError('Access denied', 'You do not have a role assigned.', 403);
        }

        if (!$user->organisation) {
            return ResponseTrait::sendError('Access denied', "You don't have an organisation configured.", 403);
        }

        $request->attributes->add(['user' => $user]);
        return $next($request);
    }
}
