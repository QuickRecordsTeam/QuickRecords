<?php

use App\Constants\PaymentItemType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnPaymentItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_items', function (Blueprint $table) {
            $table->enum('type', [PaymentItemType::A_MEMBER, PaymentItemType::ALL_MEMBERS, PaymentItemType::GROUPED_MEMBERS])->default(PaymentItemType::ALL_MEMBERS);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
