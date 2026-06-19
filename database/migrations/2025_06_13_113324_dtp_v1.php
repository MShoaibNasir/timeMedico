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
        Schema::create('dtp', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name', 50)->nullable();
            $table->enum('type', ['Articles', 'Whitepapers', 'Research', 'Reports', 'Journals', 'Factsheets', 'Newsletter', 'Shareholders rights information'])->nullable();
            $table->text('link')->nullable();
            $table->string('resource_type', 2555)->nullable();
            $table->string('file', 2555)->nullable();
            $table->bigInteger('price')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtp');
    }
};
