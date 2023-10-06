<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_receipt', function (Blueprint $table) {
            $table->bigIncrements('receipt_id')->from(1000000);
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->text('customer_note')->nullable();
            $table->text('receipt_product');
            $table->integer('receipt_status')->nullable();
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->bigInteger('total_money');
            $table->timestamp('receipt_date')->nullable()->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_receipt');
    }
};
