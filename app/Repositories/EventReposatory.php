<?php

namespace App\Repositories;

use App\Models\Event;
use App\Services\FileService;

class EventReposatory
{
    public function store(array $data): Event
    {

        return Event::create($data);
    }

    public function delete(Event $data): Event
    {
        if (isset($data->recording)) {
            FileService::delete($data->recording);
        }
        if (isset($data->speaker_pic)) {
            FileService::delete($data->speaker_pic);
        }
        $data->delete();

        return $data;
    }

    public function update(array $data): Event
    {

        $event = Event::findOrFail($data['id']);
        $event->update($data);

        return $event->fresh();
    }
}
