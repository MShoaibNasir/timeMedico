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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('created_by');
            $table->string('name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('model_type', 255)->nullable();
            $table->timestamp('date')->nullable();
            $table->bigInteger('slots')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('speaker_name', 255)->nullable();
            $table->string('speaker_pic', 255)->nullable();
            $table->bigInteger('registeration_fee')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
