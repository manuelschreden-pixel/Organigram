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
        Schema::create('orderstatus', function (Blueprint $table) {
            $table->bigIncrements('orderstatus_id');
            $table->string('status_name');
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('order_id'); 
            $table->unsignedBigInteger('customer_id'); 
            $table->unsignedBigInteger('orderstatus_id');
            $table->date('order_date');
            $table->date('delivery_date')->nullable();
            $table->string('PickupLocation')->nullable();
            //$table->decimal('price', 10, 2);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                  ->references('customer_id')
                  ->on('customers')
                  ->cascadeOnDelete();

            $table->foreign('orderstatus_id')
                  ->references('orderstatus_id')
                  ->on('orderstatus')
                  ->cascadeOnDelete();
        });

        Schema::create('orderinfo', function (Blueprint $table) {
            $table->bigIncrements('orderinfo_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('order_id')
                  ->on('order')
                  ->cascadeOnDelete();
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('products')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
        Schema::dropIfExists('orderstatus');
        Schema::dropIfExists('orderinfo');
    }
};
