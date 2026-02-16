<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitPaymentRequest;
use App\Http\Requests\PaymentCallbackRequest;
use App\Models\Payment;
use App\Models\Subscription;
use App\Services\SubscriptionPaymentService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ResponseTrait;
    private SubscriptionPaymentService $paymentService;

    public function __construct(SubscriptionPaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function filterPayments(Request $request)
    {
        $data = $this->paymentService->filterPayments($request);
        return $this->successResponse($data, "Payments filtered successfully");
    }


    public function fetchClientPayments(Request $request)
    {
        $data = $this->paymentService->fetchClientPayments($request);
        return $this->successResponse($data, "Client payments retrieved successfully");
    }

    public function initiatePayment(InitPaymentRequest $request)
    {
        $data = $this->paymentService->initiatePayment($request);
        return $this->successResponse($data, "Payment initiated successfully");
    }


    public function showPayment(Payment $payment)
    {
        $data = $this->paymentService->getPayment($payment->id);
        return $this->successResponse($data, "Payment details retrieved successfully");
    }

    public function checkPaymentStatus($reference)
    {
        $data = $this->paymentService->checkPaymentStatus($reference);
        return $this->successResponse($data, "Payment status retrieved successfully");
    }

    public function handlePaymentCallback(PaymentCallbackRequest $request)
    {
        $data = $this->paymentService->handlePaymentCallback($request);
        return $this->successResponse($data, "Payment callback handled successfully");
    }
}
