<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendInquiryRequest;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function sendMessage(SendInquiryRequest $request)
    {
        $this->notificationService->sendNotification($request);

        return response()->json(['message' => 'Message has been sent successfully']);
    }
}
