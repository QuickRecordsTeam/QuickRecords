<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class PaymentSeeder extends Seeder
{
    private $subscriptionIds;

    public function __construct()
    {
        $this->subscriptionIds = \App\Models\Subscription::pluck('id')->toArray();
    }
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            \App\Models\Payment::create([
                'subscription_id' => $faker->randomElement($this->subscriptionIds),
                'amount' => $faker->randomFloat(2, 10, 100),
                'payment_method' => $faker->randomElement(['credit_card', 'momo', 'bank_transfer']),
                'transaction_status' => $faker->randomElement(['PENDING', 'COMPLETE', 'FAILED']),
                'payment_date' => $faker->dateTimeBetween('-1 month', 'now'),
                'transaction_id' => $faker->uuid,
                'transaction_number' => $faker->numerify('TXN-########')
            ]);
        }
    }
}
