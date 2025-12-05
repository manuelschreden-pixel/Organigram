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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements("product_id");
            $table->string("product_name");
            $table->text("description")->nullable();
            $table->decimal("price", 8, 2);
            $table->decimal("stock_quantity");
            $table->unsignedBigInteger("category_id");
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('categories')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
