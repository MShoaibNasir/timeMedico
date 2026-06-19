<?php

namespace App\Jobs;

use App\Mail\MarketingBlast;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class BulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $ids;

    public string $subject;

    public string $body;

    public function __construct(array $ids, string $subject, string $body)
    {
        $this->ids = $ids;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function handle(): void
    {
        Log::info('BulkEmailJob started.');
        $query = User::whereNotNull('email');
        if (! empty($this->ids)) {
            $query->whereIn('id', $this->ids);
        }

        $query->chunkById(500, function ($users) {
            foreach ($users as $user) {
                Mail::to($user)->queue(new MarketingBlast($user, $this->subject, $this->body));
            }
        });
        Log::info('BulkEmailJob completed.');
    }
}
