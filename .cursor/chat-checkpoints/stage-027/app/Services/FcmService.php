<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Contract\Messaging;
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
        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body))
            ->withData($this->stringifyData($data))
            ->toToken($token);

        return $this->messaging->send($message);
    }

    public function sendToMultiple(array $tokens, string $title, string $body, array $data = [])
    {
        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body))
            ->withData($this->stringifyData($data));

        return $this->messaging->sendMulticast($message, $tokens);
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
