<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDevice;

class DeviceTokenService
{
    public static function register(User $user, string $fcmToken, ?string $deviceId = null, array $meta = []): UserDevice
    {
        $fcmToken = trim($fcmToken);
        $deviceId = $deviceId !== null ? trim($deviceId) : null;
        $deviceId = $deviceId === '' ? null : $deviceId;

        $record = null;
        if ($deviceId) {
            $record = UserDevice::query()
                ->where('user_id', $user->id)
                ->where('device_id', $deviceId)
                ->first();
        }

        if (! $record) {
            $record = UserDevice::query()->where('fcm_token', $fcmToken)->first();
        }

        $payload = [
            'user_id' => $user->id,
            'device_id' => $deviceId,
            'fcm_token' => $fcmToken,
        ];

        if (array_key_exists('phoneModel', $meta) || array_key_exists('phone_model', $meta)) {
            $payload['phone_model'] = $meta['phoneModel'] ?? $meta['phone_model'];
        }
        if (array_key_exists('phoneMake', $meta) || array_key_exists('phone_make', $meta)) {
            $payload['phone_make'] = $meta['phoneMake'] ?? $meta['phone_make'];
        }
        if (array_key_exists('appVersion', $meta) || array_key_exists('app_version', $meta)) {
            $payload['app_version'] = $meta['appVersion'] ?? $meta['app_version'];
        }

        if ($record) {
            $record->fill($payload);
            $record->save();
        } else {
            $record = UserDevice::create($payload);
        }

        $userFill = ['fcmToken' => $fcmToken];
        if ($deviceId) {
            $userFill['deviceId'] = $deviceId;
        }
        if (! empty($payload['phone_model'])) {
            $userFill['phoneModel'] = $payload['phone_model'];
        }
        if (! empty($payload['phone_make'])) {
            $userFill['phoneMake'] = $payload['phone_make'];
        }
        if (! empty($payload['app_version'])) {
            $userFill['appVersion'] = $payload['app_version'];
        }

        $user->forceFill($userFill)->save();

        return $record;
    }

    public static function tokensFor(User $user): array
    {
        $tokens = UserDevice::query()
            ->where('user_id', $user->id)
            ->pluck('fcm_token')
            ->all();

        $legacy = trim((string) ($user->fcmToken ?? ''));
        if ($legacy !== '') {
            $tokens[] = $legacy;
        }

        $tokens = array_values(array_unique(array_filter(array_map('trim', $tokens))));

        return $tokens;
    }

    public static function forgetTokens(array $tokens): void
    {
        $tokens = array_values(array_unique(array_filter($tokens)));
        if ($tokens === []) {
            return;
        }

        UserDevice::query()->whereIn('fcm_token', $tokens)->delete();
        User::query()->whereIn('fcmToken', $tokens)->update(['fcmToken' => null]);
    }
}
