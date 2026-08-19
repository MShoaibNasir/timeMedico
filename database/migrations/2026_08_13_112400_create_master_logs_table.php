<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_logs', function (Blueprint $table) {
            $table->id();
            $table->string('actor_type', 50)->default('guest')->index(); // admin, user, guest, system
            $table->unsignedBigInteger('actor_id')->nullable()->index();
            $table->string('actor_name')->nullable();
            $table->string('actor_role')->nullable();
            $table->string('source', 50)->default('frontend')->index(); // admin_panel, frontend, mobile_app, api, system
            $table->string('action', 100)->nullable()->index();
            $table->string('module', 100)->nullable()->index();
            $table->string('description')->nullable();
            $table->string('method', 15)->nullable();
            $table->string('route_name')->nullable();
            $table->text('url')->nullable();
            $table->string('ip_address', 45)->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->unsignedSmallInteger('response_status')->nullable();
            $table->json('request_data')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_logs');
    }
};
