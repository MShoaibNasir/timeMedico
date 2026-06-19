<?php

namespace App\Repositories;

use App\Models\Publication;
use App\Services\FileService;

class PublicationRepository
{
    public function store(array $data): Publication
    {
        return Publication::create($data);
    }

    public function delete(Publication $data): Publication
    {
        FileService::delete($data->affidavit);
        $data->delete();

        return $data;
    }

    public function update(array $data): Publication
    {

        $professional_experience = Publication::findOrFail($data['id']);
        $professional_experience->update($data);

        return $professional_experience->fresh();
    }
}
