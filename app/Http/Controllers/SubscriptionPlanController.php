<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionPlanRequest;
use App\Services\SubscriptionPlanService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    use ResponseTrait;
    private SubscriptionPlanService $subscriptionPlanService;

    public function __construct(SubscriptionPlanService $subscriptionPlanService)
    {
        $this->subscriptionPlanService = $subscriptionPlanService;
    }

    public function createSubscriptionPlan(SubscriptionPlanRequest $request)
    {
        $this->subscriptionPlanService->createSubscriptionPlan($request);
        return $this->sendResponse('success', 'Subscription Plan created successfully');
    }

    public function updateSubscriptionPlan(SubscriptionPlanRequest $request, $id)
    {
        $this->subscriptionPlanService->updateSubscriptionPlan($id, $request);
        return $this->sendResponse('success', 'Subscription Plan updated successfully');
    }

    public function getSubscriptionPlan($id)
    {
        $data = $this->subscriptionPlanService->getSubscriptionPlan($id);
        return $this->sendResponse($data, 200);
    }

    public function deleteSubscriptionPlan($id)
    {
        $this->subscriptionPlanService->deleteSubscriptionPlan($id);
        return $this->sendResponse('success', 'Subscription Plan deleted successfully');
    }

    public function filterSubscriptionPlan(Request $request)
    {
        $data = $this->subscriptionPlanService->filterSubscriptionPlan($request);
        return $this->sendResponse($data, 200);
    }

    public function fetchAllSubscriptionPlans(Request $request)
    {
        $data = $this->subscriptionPlanService->fetchAllSubscriptionPlans($request);
        return $this->sendResponse($data, 200);
    }
}
