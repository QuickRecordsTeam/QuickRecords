<?php

namespace App\Http\Middleware;

use App\Constants\SessionStatus;
use App\Models\User;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAuthorizedToAccessPlatform
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loginId = $request->input('login_id');
        $user = User::with(['roles', 'organisation.subscriptions'])
            ->where('username', $loginId)
            ->orWhere('email', $loginId)
            ->first();

        if (!$user) {
            return ResponseTrait::sendError('Access denied', 'Unauthorized! Invalid Account', 403);
        }

        if ($user->status === SessionStatus::IN_ACTIVE) {
            return ResponseTrait::sendError("User's Account has been deactivated! Please contact the Admin or President", 401);
        }

        $allowedRoles = ['ADMIN', 'PRESIDENT', 'FINANCIAL_SECRETARY', 'TREASURER', 'AUDITOR', 'SYSTEM_ADMIN'];
        $userRoles = $user->roles->whereIn('name', $allowedRoles);

        if ($userRoles->isEmpty()) {
            return ResponseTrait::sendError('Access denied', 'You do not have a role assigned.', 403);
        }

        if ($userRoles->contains('name', 'SYSTEM_ADMIN')) {
            $request->attributes->add(['user' => $user]);
            return $next($request);
        }

        if (!$user->organisation) {
            return ResponseTrait::sendError('Access denied', "You don't have an organisation configured.", 403);
        }

        $subscription = $user->organisation->subscriptions
            ->whereIn('status', ['active', 'past_due', 'trialing'])
            ->first();

        if (!$subscription) {
            return ResponseTrait::sendError('Access denied', 'Your organisation does not have an active subscription', 403);
        }

        $now = now();

        if ($subscription->status === 'past_due') {
            $cautionPeriod = config('app.subscription_caution_period', 3); // Use config() instead of env()
            $daysPastDue = $now->diffInDays($subscription->current_period_end_date);

            if ($daysPastDue > $cautionPeriod) {
                return ResponseTrait::sendError('Access denied', 'Subscription past due. Please renew.', 403);
            }
        }

        if ($subscription->status === 'trialing' && $now->greaterThan($subscription->trial_ends_at)) {
            return ResponseTrait::sendError('Access denied', 'Trial period has ended.', 403);
        }

        $request->attributes->add(['user' => $user]);
        return $next($request);
    }
}
