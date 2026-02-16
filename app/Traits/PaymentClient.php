<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait PaymentClient
{
    protected $paymentClient;

    public function fetchPaymentToken()
    {
        $url = config('app.payment_gateway_api_url') . '/token';
        return Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])->post($url, [
            "username" => config('app.payment_gateway_api_username'),
            "password" => config('app.payment_gateway_api_password'),
        ]);
    }

    public function initPayment($request, $external_reference)
    {
        $url = config('app.payment_gateway_api_url') . '/collect';
        $tokenResponse = $this->fetchPaymentToken();
        return Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Token ' . $tokenResponse->json('token'),
        ])->post($url, [
            "amount" => $request->amount,
            "currency" => $request->currency ?? 'XAF',
            'description' => $request->description,
            'from' => $request->account_number,
            'external_reference' => $external_reference
        ]);
    }

    public function checkPaymentStatus($external_reference)
    {
        $url = config('app.payment_gateway_api_url') . '/transaction/' . $external_reference;
        $tokenResponse = $this->fetchPaymentToken();
        return Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Token ' . $tokenResponse->json('token'),
        ])->get($url);
    }


}
