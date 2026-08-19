<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Models\UserDataFotOTP;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Throwable;

class OtpDeliveryService
{
    public const EXPIRY_MINUTES = 10;

    /**
     * Generate an OTP with the existing 4-digit logic, persist it, and
     * email it once. A short lock prevents duplicate emails from double-clicks.
     */
    public static function issueAndMail(array $payload): UserDataFotOTP
    {
        $email = trim((string) ($payload['email'] ?? ''));
        $phone = trim((string) ($payload['phone_number'] ?? ''));

        if ($email === '' || $phone === '') {
            throw new RuntimeException('Email and phone number are required to send an OTP.');
        }

        $lockKey = 'otp-mail:'.strtolower($email).':'.$phone;
        $locked = false;

        try {
            $locked = Cache::add($lockKey, 1, now()->addSeconds(8));
        } catch (Throwable $e) {
            $locked = true;
        }

        if (! $locked) {
            $existing = self::latestRecord($email, $phone);
            if ($existing) {
                return $existing;
            }

            throw new RuntimeException('OTP is already being sent. Please wait a moment.');
        }

        $otp = (string) random_int(1000, 9999);

        $record = self::latestRecord($email, $phone);
        $data = array_merge($payload, [
            'email' => $email,
            'phone_number' => $phone,
            'otp' => $otp,
        ]);

        if ($record) {
            $record->fill($data);
            $record->save();
        } else {
            $record = UserDataFotOTP::create($data);
        }

        try {
            self::sendOnce($record, $otp);
        } catch (Throwable $e) {
            try {
                Cache::forget($lockKey);
            } catch (Throwable $ignored) {
                //
            }

            throw $e;
        }

        try {
            Cache::forget($lockKey);
        } catch (Throwable $ignored) {
            //
        }

        return $record;
    }

    public static function latestRecord(string $email, string $phone): ?UserDataFotOTP
    {
        return UserDataFotOTP::query()
            ->where('email', $email)
            ->where('phone_number', $phone)
            ->latest('id')
            ->first();
    }

    protected static function sendOnce(UserDataFotOTP $record, string $otp): void
    {
        try {
            Mail::to($record->email)->send(new OtpMail(
                $record,
                $otp,
                now()->addMinutes(self::EXPIRY_MINUTES),
                self::EXPIRY_MINUTES
            ));
        } catch (Throwable $e) {
            Log::error('OTP email failed: '.$e->getMessage(), [
                'email' => $record->email,
            ]);

            throw $e;
        }
    }
}
