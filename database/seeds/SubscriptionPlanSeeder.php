<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 2; $i++) {
            \App\Models\SubscriptionPlan::create([
                'name' => $faker->word . ' Plan',
                'status' => $faker->randomElement(['active', 'inactive']),
                'price' => $faker->randomFloat(2, 10, 100),
                'discount_percentage' => $faker->randomFloat(2, 0, 20),
                'features' => implode(',', $faker->words(5)),
                'billing_cycle' => $faker->randomElement(['monthly', 'yearly']),
                'is_discount_applicable' => $faker->boolean,
                'trial_duration_days' => $faker->numberBetween(0, 30)
            ]);
        }
    }
}
