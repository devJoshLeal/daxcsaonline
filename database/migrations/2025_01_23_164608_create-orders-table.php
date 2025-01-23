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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('tracking_id')->unique(); // Added tracking_id column

            // Adding new fields
            $table->timestamp('order_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->string('phone')->nullable(); // New phone field
            $table->string('address')->nullable(); // New address field

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
