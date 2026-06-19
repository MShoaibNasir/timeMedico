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
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('degree', 50)->nullable();
            $table->string('degree_title', 255)->nullable();
            $table->string('majors')->nullable();
            $table->string('institute_name', 100)->nullable();
            $table->string('board_name', 100)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('obtained_marks')->nullable();
            $table->bigInteger('total_marks')->nullable();
            $table->decimal('obtained_percentage', 5, 2)->nullable();
            $table->string('grade', 100)->nullable();
            $table->enum('foreign_qualified', ['Yes', 'No'])->nullable();
            $table->string('education_document', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
