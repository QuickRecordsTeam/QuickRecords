<?php

namespace App\Services;

use App\Http\Resources\SubscriptionPlanResource;
use App\Interfaces\SubscriptionPlanInterface;
use App\Models\SubscriptionPlan;

class SubscriptionPlanService implements SubscriptionPlanInterface
{

    public function createSubscriptionPlan($request)
    {
        SubscriptionPlan::create([
            'name' => $request->name,
            'status' => true,
            'price' => $request->price,
            'discount_percentage' => $request->discount_percentage,
            'features' => implode(',', $request->features),
            'billing_cycle' => $request->billing_cycle,
            'is_discount_applicable' => $request->is_discount_applicable,
            'trial_duration_days' => $request->trial_duration_days
        ]);
    }
    public function updateSubscriptionPlan($id, $request)
    {
        SubscriptionPlan::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'price' => $request->price,
            'discount_percentage' => $request->discount_percentage,
            'features' => implode(',', $request->features),
            'billing_cycle' => $request->billing_cycle,
            'is_discount_applicable' => $request->is_discount_applicable,
            'trial_duration_days' => $request->trial_duration_days
        ]);
    }
    public function getSubscriptionPlan($id)
    {
        return new SubscriptionPlanResource(SubscriptionPlan::findOrFail($id));
    }
    public function deleteSubscriptionPlan($id)
    {
        return SubscriptionPlan::findOrFail($id)->delete();
    }
    public function filterSubscriptionPlan($request)
    {
        $SubscriptionPlans = SubscriptionPlan::query()
            ->when($request->name, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->is_discount_applicable, function ($query) use ($request) {
                $query->where('is_discount_applicable',  $request->is_discount_applicable);
            })
            ->when($request->billing_cycle, function ($query) use ($request) {
                $query->where('billing_cycle', $request->billing_cycle);
            })
            ->get();

        return SubscriptionPlanResource::collection($SubscriptionPlans);

    }
    public function fetchAllSubscriptionPlans($request)
    {
        return SubscriptionPlanResource::collection(SubscriptionPlan::all());
    }
}
