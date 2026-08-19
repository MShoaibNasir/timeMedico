<?php

namespace App\Mail;

use App\Models\UserDataFotOTP;
use App\Models\WebsiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public UserDataFotOTP $otpRecord,
        public string $otp,
        public $expiresAt,
        public int $expiresInMinutes
    ) {
    }

    public function envelope(): Envelope
    {
        $siteName = $this->siteName();

        return new Envelope(
            subject: $siteName.' verification code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
            text: 'emails.otp-text',
            with: [
                'otp' => $this->otp,
                'name' => $this->otpRecord->name ?: 'Customer',
                'expiresAt' => $this->expiresAt,
                'expiresInMinutes' => $this->expiresInMinutes,
                'siteName' => $this->siteName(),
                'logoUrl' => $this->logoUrl(),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    protected function siteName(): string
    {
        try {
            $name = WebsiteSetting::query()->value('site_name');
            if (is_string($name) && trim($name) !== '') {
                return trim($name);
            }
        } catch (Throwable $e) {
            // fall through
        }

        return config('app.name') ?: 'Time Medico';
    }

    protected function logoUrl(): string
    {
        try {
            $setting = WebsiteSetting::query()->first();
            if ($setting && $setting->hasMedia('logo')) {
                $url = $setting->getFirstMediaUrl('logo', 'small') ?: $setting->getFirstMediaUrl('logo');
                if (is_string($url) && $url !== '') {
                    return str_starts_with($url, 'http') ? $url : url($url);
                }
            }
        } catch (Throwable $e) {
            // fall through
        }

        return asset('frontend/images/timemedio-logo.png');
    }
}
