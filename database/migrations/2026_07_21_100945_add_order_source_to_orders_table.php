<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->enum('order_source', [
                'Web Application',
                'Mobile Application',
                'Admin Panel'
            ])->default('Web Application')->after('payment_type');
            $table->unsignedBigInteger('address_id')
                ->nullable()
                ->after('order_source');

            $table->string('social_media_order_source')
                ->nullable()
                ->after('order_source');

            $table->tinyInteger('order_confirmed_by_admin')
                ->default(0)
                ->after('social_media_order_source');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_source',
                'social_media_order_source',
                'order_confirmed_by_admin'
            ]);
        });
    }
};
