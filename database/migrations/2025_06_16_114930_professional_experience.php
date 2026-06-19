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
        Schema::create('professional_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('job_title')->nullable();
            $table->string('organization_name', 255)->nullable();
            $table->string('job_description', 2555)->nullable();
            $table->string('start_date', 2555)->nullable();
            $table->string('end_date', 2555)->nullable();
            $table->unsignedInteger('Country')->nullable();
            $table->tinyInteger('affidavit')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_experience');
    }
};
