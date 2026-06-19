<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarketingBlast extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;

    public string $subjectText;

    public string $bodyText;

    public function __construct(User $user, string $subjectText, string $bodyText)
    {
        $this->user = $user;
        $this->subjectText = $subjectText;
        $this->bodyText = $bodyText;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
            ->markdown('emails.marketing-blast');
    }
}
