<?php

namespace App\Services;

use App\Mail\InquiryMail;
use Exception;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendNotification($request)
    {
        try {
            Mail::to(env('INQUIRY_EMAIL_ADDRESS'))->send(new InquiryMail($request->all()));
        } catch (Exception $e) {
            return response()->json(['msg' => "Could not send message"]);
        }
    }
}