<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // agar user_id already hai to optional: remove/comment later
            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');

            $table->foreignId('admin_id')
                ->after('id')
                ->constrained('admins')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }
};