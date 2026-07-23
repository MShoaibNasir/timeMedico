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
        return $this->feedbackReposatory->upload($data);
    }
    public function list()
    {
        return $this->feedbackReposatory->list();
    }
}