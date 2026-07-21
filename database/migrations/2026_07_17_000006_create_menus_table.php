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
        Schema::create('menus', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */
            $table->unsignedTinyInteger('type')->default(1);

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('menus')
                ->nullOnDelete();

            $table->foreignId('page_id')
                ->nullable()
                ->constrained('pages')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Menu Details
            |--------------------------------------------------------------------------
            */
            $table->string('title', 1000);
            $table->string('title_ur', 1000);

            $table->string('icon')->nullable();

            /*
                1 = Page
                2 = Route
                3 = External URL
            */
            $table->unsignedTinyInteger('redirection_type');

            $table->string('route')->nullable();

            $table->text('url')->nullable();

            $table->boolean('status')->default(false);

            $table->unsignedInteger('sorting')->default(0);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index('type');
            $table->index('status');
            $table->index('sorting');
            $table->index('redirection_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};