<?php

namespace App\Interfaces;

interface SubscriptionPlanInterface
{
    public function createSubscriptionPlan($request);
    public function updateSubscriptionPlan($id, $request);
    public function getSubscriptionPlan($id);
    public function deleteSubscriptionPlan($id);
    public function filterSubscriptionPlan($request);
    public function fetchAllSubscriptionPlans($request);
}
