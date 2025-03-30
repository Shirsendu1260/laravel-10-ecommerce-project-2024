<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // Discount coupon code
            $table->string('name')->nullable(); // Discount coupon code name (human readable)
            $table->text('description')->nullable(); // Discount coupon description
            $table->integer('max_uses')->nullable(); // The max no. of uses the coupon has
            $table->integer('max_uses_user')->nullable(); // The no. of times user can use the coupon
            $table->enum('type', ['percent', 'fixed'])->default('fixed'); // Whether or not the coupon is a percentage or a fixed price type
            $table->double('discount_amount', 10, 2); // The amount to discount based on type (If amount is 10, then 10% for 'percent' type, else 10 Rs. for 'fixed' type)
            $table->double('min_amount', 10, 2)->nullable(); // Should be lesser than or equal to subtotal
            $table->timestamp('starts_at')->nullable(); // Coupon begin time
            $table->timestamp('expires_at')->nullable(); // Coupon expire time
            $table->enum('status', [1, 0])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
