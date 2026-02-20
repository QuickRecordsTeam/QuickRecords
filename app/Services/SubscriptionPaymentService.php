<?php

namespace App\Services;

use App\Constants\BillingCyclePlans;
use App\Constants\PaymentStatus;
use App\Exceptions\BusinessValidationException;
use App\Http\Resources\InitPaymentResource;
use App\Http\Resources\PaymentResource;
use App\Interfaces\PaymentInterface;
use App\Traits\PaymentClient;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubscriptionPaymentService implements PaymentInterface
{
    use PaymentClient;
    private SubscriptionService $subscriptionService;
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function fetchPaymentToken()
    {
        return $this->fetchPaymentToken();
    }
    public function initiatePayment($request)
    {

        $response = DB::transaction(function () use ($request) {
            $user = User::find($request->login_id);
            if (!$user) {
                throw new \App\Exceptions\BusinessValidationException('User account not found', 404);
            }

            $subscription = $user->organisation->subscriptions()->where('id', $request->subscription_id)->first();

            if (!$subscription) {
                throw new \App\Exceptions\BusinessValidationException('Subscription not found for the organisation', 404);
            }
            $amountPayable = $this->getTotalAmountPayable($subscription->id, $user->organisation->id);

            $subPayment = Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => $amountPayable,
                'payment_method' => $request->payment_method,
                'transaction_status' => PaymentStatus::PENDING,
                'payment_date' => now(),
                'transaction_number' => $request->transaction_number,
                'description' => $request->description,
            ]);
            $initResponse = PaymentClient::initPayment($request, $amountPayable, $subPayment->id);

            $subPayment->update([
                'transaction_id' => $initResponse->json('reference'),
            ]);

            return new InitPaymentResource($initResponse, $initResponse->json('reference') ?? null, $initResponse->json('ussd_code'));
        });

        return $response;
    }
    public function getPayment($id)
    {
        return new PaymentResource(Payment::findOrFail($id));
    }
    public function checkPaymentStatus($transaction_id)
    {
        $initiatedPayment = Payment::where('transaction_id', $transaction_id)->first();
        if (!$initiatedPayment) {
            throw new BusinessValidationException("Invalid transaction id", 404);
        }
        $response = PaymentClient::checkPaymentStatus($initiatedPayment->transaction_id);
        $initiatedPayment->update([
            'transaction_status' => $response->json('status'),
            'external_transaction_id' => $response->json('code'),
            'financial_transaction_id' => $response->json('operator_reference'),
            'transaction_type' => $response->json('endpoint'),
        ]);
        if ($response->json('status') === PaymentStatus::SUCCESSFUL) {
            $subscription = $initiatedPayment->subscription()->first();
            $subscription->update([
                'status' => 'active',
                'current_period_start_date' => now(),
                'current_period_end_date' => now()->addMonth(),
                'trial_period_start_date' => null,
                'trial_period_end_date' => null,
            ]);
        }
        return new PaymentResource($initiatedPayment->fresh());
    }
    public function handlePaymentCallback($request)
    {
        $initiatedPayment = Payment::where('id', $request->external_reference)->where('transaction_id', $request->reference)->first();
        if (!$initiatedPayment) {
            throw new BusinessValidationException('Invalid payment request', 403);
        }
        $initiatedPayment->update([
            'transaction_status' => $request->status,
            'external_transaction_id' => $request->code,
            'financial_transaction_id' => $request->operator_reference,
            'transaction_type' => $request->endpoint,
            'payment_method'   => $request->operator
        ]);

        if ($request->status === PaymentStatus::SUCCESSFUL) {
            $subscription = $initiatedPayment->subscription()->first();
            $subscription->update([
                'status' => 'active',
                'current_period_start_date' => $this->getSubscriptionDuration($subscription->subscriptionPlan)['current_period_start_date'],
                'current_period_end_date' => $this->getSubscriptionDuration($subscription->subscriptionPlan)['current_period_end_date'],
                'trial_period_start_date' => null,
                'trial_period_end_date' => null,
            ]);
        }

        return new PaymentResource($initiatedPayment->fresh());
    }
    public function filterPayments($request)
    {
        $query = Payment::query();

        if ($request->has('status')) {
            $query->where('transaction_status', $request->status);
        }

        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('payment_date', [$request->start_date, $request->end_date]);
        }

        if ($request->has('transaction_number')) {
            $query->where('transaction_number', $request->subscription_id);
        }

        if ($request->has('transaction_id')) {
            $query->where('transaction_id', $request->subscription_id);
        }

        return PaymentResource::collection($query->get());
    }

    public function fetchClientPayments($request)
    {
        $clientPayments = Payment::whereHas('subscription', function ($query) use ($request) {
            $query->where('organisation_id', $request->user->organisation->id);
        })->get();

        return PaymentResource::collection($clientPayments);
    }

    private function getTotalAmountPayable($subscriptionId, $orgId)
    {
        $subAmountInfo = $this->subscriptionService->computeTotalSubscriptionAmount($subscriptionId, $orgId);

        $subscriptionAmount = ($subAmountInfo['totalAmount']  * ($subAmountInfo['chargeable_fee'] / 100)) + $subAmountInfo['totalAmount'];

        return round($subscriptionAmount);
    }

    private function getSubscriptionDuration($subscription_plan)
    {
        $start = BillingCyclePlans::MONTHLY === $subscription_plan->billing_cycle ? \Carbon\Carbon::now()->startOfDay() : \Carbon\Carbon::now()->startOfYear();
        $end = BillingCyclePlans::MONTHLY === $subscription_plan->billing_cycle ? \Carbon\Carbon::now()->addMonths(1) : \Carbon\Carbon::now()->addYears(1);
        return [
            'current_period_start_date' => $start,
            'current_period_end_date' => $end
        ];
    }
}
