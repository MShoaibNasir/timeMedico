<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Throwable;

class FcmService
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function send(string $token, string $title, string $body, array $data = [])
    {
        $token = trim($token);
        if ($token === '') {
            return null;
        }

        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body))
            ->withData($this->stringifyData($data))
            ->toToken($token);

        try {
            return $this->messaging->send($message);
        } catch (MessagingException $e) {
            if ($this->isInvalidTokenError($e)) {
                DeviceTokenService::forgetTokens([$token]);
            }

            throw $e;
        }
    }

    public function sendToMultiple(array $tokens, string $title, string $body, array $data = [])
    {
        $tokens = array_values(array_unique(array_filter(array_map('trim', $tokens))));
        if ($tokens === []) {
            return null;
        }

        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body))
            ->withData($this->stringifyData($data));

        $report = $this->messaging->sendMulticast($message, $tokens);

        $invalid = [];
        if (method_exists($report, 'invalidTokens')) {
            $invalid = array_merge($invalid, $report->invalidTokens());
        }
        if (method_exists($report, 'unknownTokens')) {
            $invalid = array_merge($invalid, $report->unknownTokens());
        }
        DeviceTokenService::forgetTokens($invalid);

        return $report;
    }

    public function sendToUser($user, string $title, string $body, array $data = []): bool
    {
        $tokens = DeviceTokenService::tokensFor($user);
        if ($tokens === []) {
            return false;
        }

        try {
            $this->sendToMultiple($tokens, $title, $body, $data);

            return true;
        } catch (Throwable $e) {
            Log::warning('FcmService::sendToUser failed: '.$e->getMessage(), [
                'user_id' => $user->id ?? null,
            ]);

            return false;
        }
    }

    public function sendToTopic(string $topic, string $title, string $body, array $data = [])
    {
        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body))
            ->withData($this->stringifyData($data))
            ->toTopic($topic);

        return $this->messaging->send($message);
    }

    public function sendSafe(string $token, string $title, string $body, array $data = []): bool
    {
        try {
            $this->send($token, $title, $body, $data);

            return true;
        } catch (Throwable $e) {
            Log::warning('FcmService::sendSafe failed: '.$e->getMessage());

            return false;
        }
    }

    protected function isInvalidTokenError(Throwable $e): bool
    {
        $message = strtolower($e->getMessage());

        return str_contains($message, 'not registered')
            || str_contains($message, 'invalid registration')
            || str_contains($message, 'unregistered')
            || str_contains($message, 'requested entity was not found');
    }

    protected function stringifyData(array $data): array
    {
        $out = [];
        foreach ($data as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $out[(string) $key] = json_encode($value);
            } elseif (is_bool($value)) {
                $out[(string) $key] = $value ? '1' : '0';
            } elseif ($value === null) {
                $out[(string) $key] = '';
            } else {
                $out[(string) $key] = (string) $value;
            }
        }

        return $out;
    }
}
