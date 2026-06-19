<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventReposatory;

class EventServices
{
    protected EventReposatory $eventRepo;

    public function __construct(EventReposatory $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function store(array $data): Event
    {
        if (isset($data['recording'])) {
            $file_name = FileService::upload($data['recording'], 'uploads/general/media/event/recording');
            $data['recording'] = $file_name;
        }
        if (isset($data['speaker_pic'])) {
            $file_name = FileService::upload($data['speaker_pic'], 'uploads/general/media/event/speaker');
            $data['speaker_pic'] = $file_name;
        }
        $data = $this->eventRepo->store($data);

        return $data;
    }

    public function delete(int $id): Event
    {
        $data = Event::findOrFail($id);
        $result = $this->eventRepo->delete($data);

        return $result;
    }

    public function update($data, $id)
    {

        $event = Event::findOrFail($id);
        if (isset($data['speaker_pic'])) {
            FileService::delete($event->speaker_pic);
            $file_name = FileService::upload(
                $data['speaker_pic'],
                'uploads/general/media/event/speaker'
            );
            $data['speaker_pic'] = $file_name;
        }
        if (isset($data['recording'])) {
            FileService::delete($event->recording);
            $file_name = FileService::upload(
                $data['recording'],
                'uploads/general/media/event/recording'
            );
            $data['recording'] = $file_name;
        }

        $data['id'] = $id;
        $data = $this->eventRepo->update($data);

        return $data;
    }
}
