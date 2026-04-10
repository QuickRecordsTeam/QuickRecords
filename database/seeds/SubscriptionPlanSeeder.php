<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubscriptionPlanSeeder extends Seeder
{
    private const APP_FEATURES = [
        ['name' => "Member Management", 'requires_subscription' => false],
        'name' => "Income Management",
        'requires_subscription' => false,
        'name' => "Expenditure Management",
        'requires_subscription' => false,
        'name' => "Contribution Management",
        'requires_subscription' => false,
        'name' => "Member's Saving",
        'requires_subscription' => false,
        'name' => "Reports and Statistics",
        'requires_subscription' => false,
        'name' => "Balance Sheets",
        'requires_subscription' => false,
        'name' => "Logs and Tracability",
        'requires_subscription' => false,
        'name' => "Security and Secure Storage",
        'requires_subscription' => false,
        'name' => "Free Training and Support",
        'requires_subscription' => false,
        'name' => "Free Data Migration",
        'requires_subscription' => true,
        'name' => "Free Customization & Updates",
        'requires_subscription' => true,
    ];

    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        \App\Models\SubscriptionPlan::create([
            'name' => 'Monthly Plan',
            'status' => true,
            'price' => 10000,
            'discount_percentage' => 0,
            'features' => json_encode(self::APP_FEATURES),
            'billing_cycle' => 'monthly',
            'is_discount_applicable' => false,
            'trial_duration_days' => 30
        ]);

        \App\Models\SubscriptionPlan::create([
            'name' => 'Yearly Plan',
            'status' => true,
            'price' => 130000,
            'discount_percentage' => 0,
            'features' => implode(',', $faker->words(5)),
            'billing_cycle' => 'yearly',
            'is_discount_applicable' => false,
            'trial_duration_days' => 90
        ]);
    }
}
