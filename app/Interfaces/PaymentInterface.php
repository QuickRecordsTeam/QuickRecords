<?php

namespace App\Interfaces;

interface PaymentInterface
{
    public function fetchPaymentToken();
    public function initiatePayment($request);
    public function getPayment($id);
    public function checkPaymentStatus($request);
    public function handlePaymentCallback($request);
    public function filterPayments($request);
    public function fetchClientPayments($request);
}
