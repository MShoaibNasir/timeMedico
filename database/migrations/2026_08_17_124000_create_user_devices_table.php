<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('device_id', 191)->nullable();
            $table->string('fcm_token', 512);
            $table->string('phone_model')->nullable();
            $table->string('phone_make')->nullable();
            $table->string('app_version')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->unique('fcm_token');
        });

        $users = DB::table('users')
            ->whereNotNull('fcmToken')
            ->where('fcmToken', '!=', '')
            ->get(['id', 'fcmToken', 'deviceId', 'phoneModel', 'phoneMake', 'appVersion']);

        foreach ($users as $user) {
            DB::table('user_devices')->updateOrInsert(
                ['fcm_token' => $user->fcmToken],
                [
                    'user_id' => $user->id,
                    'device_id' => $user->deviceId,
                    'phone_model' => $user->phoneModel ?? null,
                    'phone_make' => $user->phoneMake ?? null,
                    'app_version' => $user->appVersion ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_devices');
    }
};
