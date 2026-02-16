<?php

namespace Database\Seeders;

use App\Constants\BillingCyclePlans;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubscriptionSeeder extends Seeder
{

    private $organisationIds;
    private $subscriptionPlans;

    public function __construct()
    {
        $this->organisationIds = \App\Models\Organisation::pluck('id')->toArray();
        $this->subscriptionPlans = \App\Models\SubscriptionPlan::all();
    }
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $subscription_plan = $faker->randomElement($this->subscriptionPlans);
        $current_period_start_date = $subscription_plan['billing_cycle'] == BillingCyclePlans::MONTHLY ? $faker->dateTimeBetween('-1 month', 'now') : $faker->dateTimeBetween('-1 year', 'now');
        $current_period_end_date = $subscription_plan['billing_cycle'] == BillingCyclePlans::MONTHLY ? $faker->dateTimeBetween('now', '+1 month') : $faker->dateTimeBetween('now', '+1 year');
        $is_trail = $faker->boolean;
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Subscription::create([
                'organisation_id' => $faker->randomElement($this->organisationIds),
                'subscription_plan_id' => $subscription_plan['id'],
                'status' => $faker->randomElement(['active', 'inactive', 'cancelled']),
                'auto_renewal' => $faker->boolean,
                'referral_code_discount' => $faker->randomFloat(2, 0, 20),
                'current_period_start_date' => $current_period_start_date,
                'current_period_end_date' => $current_period_end_date,
                'trial_period_start_date' => $is_trail ? $faker->dateTimeBetween('-1 month', 'now') : null,
                'trial_period_end_date' => $is_trail ? $faker->dateTimeBetween('now', '+1 month') : null,
                'is_trail' => $is_trail
            ]);
        }
    }
}
