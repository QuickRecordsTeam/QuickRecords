<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Constants\SubscriptionStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organisation_id');
            $table->uuid('subscription_plan_id');
            $table->boolean('auto_renewal')->default(false);
            $table->float('referral_code_discount_percentage')->nullable();
            $table->dateTime('current_period_start_date');
            $table->dateTime('current_period_end_date');
            $table->enum('status', ['active', 'cancelled', 'inactive', 'incomplete', 'past_due', 'trialing'])->default('active');
            $table->dateTime('trial_period_end_date')->nullable();
            $table->dateTime('trial_period_start_date')->nullable();
            $table->boolean('is_trail')->nullable();
            $table->timestamps();

            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->foreign('subscription_plan_id')->references('id')->on('subscription_plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
