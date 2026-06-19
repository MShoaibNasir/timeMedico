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
        Schema::create('bio_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('bio_summery')->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->string('website_url', 2555)->nullable();
            $table->string('facebook_url', 2555)->nullable();
            $table->string('twitter_url', 2555)->nullable();
            $table->string('instagram_url', 2555)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_profile');
    }
};
