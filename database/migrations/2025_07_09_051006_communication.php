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
        Schema::create('communications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('created_by');
            $table->string('title', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('duration', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('resource_type', 255)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('agenda')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
