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
        Schema::create('website_settings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Website Information
            |--------------------------------------------------------------------------
            */
            $table->string('site_name')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Social Media
            |--------------------------------------------------------------------------
            */
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Website Marquee
            |--------------------------------------------------------------------------
            */
            $table->longText('marquee')->nullable();
			
			/*
            |--------------------------------------------------------------------------
            | Website Footer
            |--------------------------------------------------------------------------
            */
            $table->text('copyright_text')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Google Map
            |--------------------------------------------------------------------------
            */
            $table->longText('location_map')->nullable();

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */
            $table->string('google_site_verification')->nullable();
            $table->longText('google_analytic')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};