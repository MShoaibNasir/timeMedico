<?php

namespace App\Repositories;

use App\Models\Feedback;

class FeedbackReposatory
{
    public function upload(array $data)
    {
        return Feedback::create($data);
    }
    public function list()
    {
        return  Feedback::where('status', 1)
            ->latest()
            ->paginate(10);
    }
}
