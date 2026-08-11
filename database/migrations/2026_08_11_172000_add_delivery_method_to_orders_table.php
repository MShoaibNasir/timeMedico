<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'delivery_method')) {
                $table->string('delivery_method', 30)->default('local')->after('delivery_charges');
            }
            if (! Schema::hasColumn('orders', 'delivery_area_text')) {
                $table->string('delivery_area_text')->nullable()->after('delivery_method');
            }
            if (! Schema::hasColumn('orders', 'area')) {
                $table->string('area')->nullable()->after('address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'delivery_area_text')) {
                $table->dropColumn('delivery_area_text');
            }
            if (Schema::hasColumn('orders', 'delivery_method')) {
                $table->dropColumn('delivery_method');
            }
        });
    }
};