<?php

namespace App\Services;

use App\Http\Resources\InitPaymentResource;
use App\Http\Resources\PaymentResource;
use App\Interfaces\PaymentInterface;
use App\Models\Subscription;
use App\Traits\PaymentClient;
use App\Models\Payment;
use App\Models\User;

class SubscriptionPaymentService implements PaymentInterface
{
    use PaymentClient;

    public function fetchPaymentToken()
    {
        return $this->fetchPaymentToken();
    }
    public function initiatePayment($request)
    {
        $user = User::findOrFail($request->login_id);
        $subscription = $user->organisation()->subscription()->where('id', $request->subscription_id)->first();
        if(!$subscription) {
            throw new \App\Exceptions\BusinessValidationException('Subscription not found for the organisation', 404);
        }
        $subPayment = Payment::create([
            'subscription_id' => $subscription->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'transaction_status' => 'PENDING',
            'payment_date' => now(),
        ]);
        $initResponse = PaymentClient::initPayment($request, $subPayment->id);
        $subPayment->update([
            'transaction_id' => $initResponse->json('reference'),
            'payment_method' => $initResponse->json('payment_method'),
        ]);

        return new InitPaymentResource($initResponse->json('reference'), $initResponse->json('ussd_code'));
    }
    public function getPayment($id) {
        return new PaymentResource(Payment::findOrFail($id));
    }
    public function checkPaymentStatus($request)
    {
        $initiatedPayment = Payment::findOrFail($request->transaction_id);
        $response = PaymentClient::checkPaymentStatus($initiatedPayment->transaction_id);
        $initiatedPayment->update([
            'transaction_status' => $response->json('status'),
            'external_transaction_id' => $response->json('code'),
            'financial_transaction_id' => $response->json('operator_reference'),
            'transaction_type' => $response->json('endpoint'),
        ]);
        return new PaymentResource($initiatedPayment->fresh());

    }
    public function handlePaymentCallback($request)
    {
        $initiatedPayment = Payment::findOrFail($request->reference);

        $initiatedPayment->update([
            'transaction_status' => $request->status,
            'external_transaction_id' => $request->code,
            'financial_transaction_id' => $request->operator_reference,
            'transaction_type' => $request->endpoint,
        ]);

        if($request->status === 'SUCCESSFUL') {
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

        if($request->has('transaction_number')) {
            $query->where('transaction_number', $request->subscription_id);
        }

        if($request->has('transaction_id')) {
            $query->where('transaction_id', $request->subscription_id);
        }

        return PaymentResource::collection($query->get());
    }

    public function fetchClientPayments($request)
    {
        $clientPayments = Payment::whereHas('subscription', function($query) use ($request) {
            $query->where('organisation_id', $request->user->organisation->id);
        })->get();

        return PaymentResource::collection($clientPayments);
    }
}
