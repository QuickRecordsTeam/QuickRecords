<?php

namespace App\Interfaces;

interface PaymentInterface
{
    public function createPayment($request);
    public function updatePayment($id, $request);
    public function getPayment($id);
    public function deletePayment($id);
    public function filterPayments($request);
    public function fetchAllPayments($request);
}
