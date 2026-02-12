<?php

use App\Constants\PaymentStatus;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscription_id');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->enum('transaction_status', ["PENDING", "COMPLETE", "FAILED"])->default('PENDING');
            $table->dateTime('payment_date');
            $table->string('transaction_id');
            $table->string('transaction_number');
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
