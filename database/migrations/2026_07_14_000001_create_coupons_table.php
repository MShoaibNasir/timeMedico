<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent'])->default('fixed');
            $table->decimal('value', 10, 2); // fixed amount ya percentage number
            $table->decimal('min_order_amount', 10, 2)->default(0); // kam se kam order value jis par coupon apply ho
            $table->decimal('max_discount_amount', 10, 2)->nullable(); // percent type ke liye discount ki upper limit
            $table->unsignedInteger('usage_limit')->nullable(); // total kitni baar use ho sakta hai (null = unlimited)
            $table->unsignedInteger('used_count')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};