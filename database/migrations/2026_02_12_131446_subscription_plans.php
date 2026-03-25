<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('features')->nullable();
            $table->boolean('status')->default(true);
            $table->decimal('price', 10, 2);
            $table->enum('billing_cycle', ['monthly', 'yearly']);
            $table->float('discount_percentage')->nullable();
            $table->boolean('is_discount_applicable')->nullable();
            $table->integer('trial_duration_days')->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('subscription_plans');
    }
};
