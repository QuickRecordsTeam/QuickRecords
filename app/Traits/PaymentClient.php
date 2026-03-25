<?php

namespace App\Traits;

use App\Exceptions\BusinessValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait PaymentClient
{
    protected $paymentClient;

    public static function getPaymentToken()
    {
        $url = config('app.payment_gateway_api_url') . '/token';

        try {
            $response =  $response = Http::withOptions([
                'allow_redirects' => [
                    'strict' => true,
                ],
            ])->post($url, [
                "username" => config('app.payment_gateway_api_username'),
                "password" => config('app.payment_gateway_api_password'),
            ]);

            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new BusinessValidationException("Could not connect to Payment Provider", 408);
        }
    }

    public static function initPayment($request, $amountPayable, $external_reference)
    {
        $url = config('app.payment_gateway_api_url') . '/collect';
        $tokenResponse = PaymentClient::getPaymentToken();
        Log::info("initiating payment for ". $request);
        Log::info("amount payable ". $amountPayable);
        $amountPayable = 25;
        try {
            $response =  Http::withHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Token ' . $tokenResponse->json('token'),
            ])->withOptions([
                'allow_redirects' => [
                    'strict' => true,
                ],
            ])->post($url, [
                "amount" => $amountPayable,
                "currency" => $request->currency ?? 'XAF',
                "description" => $request->description,
                "from" => $request->transaction_number,
                "external_reference" => $external_reference
            ])->throw();

            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new BusinessValidationException("Could not connect to Payment Provider", 408);
        }
    }

    public static function checkPaymentStatus($external_reference)
    {
        $url = config('app.payment_gateway_api_url') . '/transaction/' . $external_reference;
        $tokenResponse = PaymentClient::getPaymentToken();
        try {
            $response =  Http::withHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Token ' . $tokenResponse->json('token'),
            ])->withOptions([
                'allow_redirects' => [
                    'strict' => true,
                ],
            ])->get($url);

            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new BusinessValidationException("Could not connect to Payment Provider", 408);
        }
    }
}
