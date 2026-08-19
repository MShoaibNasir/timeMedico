<?php

namespace App\Services;

use App\Repositories\FeedbackReposatory;

class FeedbackServices
{
    protected FeedbackReposatory $feedbackReposatory;

    public function __construct(FeedbackReposatory $feedbackReposatory)
    {
        $this->feedbackReposatory = $feedbackReposatory;
    }

    public function upload(array $data)
    {
        $feedback = $this->feedbackReposatory->upload($data);
        AdminNotificationService::newFeedback($feedback);

        return $feedback;
    }

    public function list()
    {
        return $this->feedbackReposatory->list();
    }
}
