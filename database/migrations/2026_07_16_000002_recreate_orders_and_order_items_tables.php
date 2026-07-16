<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Purani tables hata dein (order_items pehle, kyunke wo orders ko reference karti hai)
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');

        // ===================== orders =====================
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // bigIncrements - agar users/products.id bhi bigint hai to match rahega

            $table->string('order_no')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete(); // user delete na ho sake agar uske orders maujood hon

            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('phone');
            $table->text('address'); // delivery address ka snapshot text
            $table->text('delivery_instruction')->nullable();

            $table->decimal('total_amount', 10, 2)->default(0);       // sub total (discount se pehle)
            $table->decimal('discount', 10, 2)->default(0);            // product-level total discount
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount', 10, 2)->default(0);
            $table->decimal('after_discount_amount', 10, 2)->default(0);
            $table->decimal('delivery_charges', 10, 2)->default(0);
            $table->decimal('platform_fee', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);         // final payable amount

            $table->string('payment_type');                           // 'cod' | 'online'
            $table->string('image_payment_slip')->nullable();

            $table->enum('status', ['Pending', 'Processing', 'On The way', 'Delivered', 'Cancelled'])
                ->default('Pending');

            $table->timestamps();
        });

        // ===================== order_items =====================
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete(); // order delete ho to uske items bhi hat jayein

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete(); // product delete na ho agar kisi order mein use hua ho

            $table->string('name'); // product name ka snapshot (order ke time ka)
            $table->unsignedInteger('quantity');

            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->default(0); // 0.00 - 100.00
            $table->decimal('price_after_discount', 10, 2);
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
