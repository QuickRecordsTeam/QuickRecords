<?php

namespace App\Http\Middleware;

use App\Constants\SessionStatus;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateByLogId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $loginId = $request->header('X-Log-ID');

        logger()->info("Middleware Check - LogID: " . $loginId);

        if (!($loginId)) {
            logger()->info("No- LogID header: " . $loginId);
            return response()->json(['error', 'Unauthorized!'], 403);
        }
        $user = \App\Models\User::find($loginId);
        if (!$user) {
            logger()->info("User account not found with - LogID: " . $loginId);
            return response()->json(['error' => 'Unauthorized! Invalid Account'], 403);
        }

        if ($user->status === SessionStatus::IN_ACTIVE) {
            logger()->info("User account is inactive for - LogID: " . $loginId);
            return response()->json(['error' => "User's Account has been deactivated! Please contact the Admin or President"], 401);
        }
        $allowedRoles = ['ADMIN', 'PRESIDENT', 'FINANCIAL_SECRETARY', 'TREASURER', 'AUDITOR', 'SYSTEM_ADMIN'];
        $userRoles = $user->roles->whereIn('name', $allowedRoles);

        if ($userRoles->isEmpty()) {
            logger()->info("User account does not have the required role with LOGID: " . $loginId);
            return response()->json(['error' => 'Access denied', 'You do not have a role assigned.'], 403);
        }

        logger()->info("Authorizing user: " . $user);

        Auth::login($user);

        logger()->info("completed authorization for user " . $user);

        return $next($request);
    }
}
