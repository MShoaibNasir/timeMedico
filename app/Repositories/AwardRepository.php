<?php

namespace App\Repositories;

use App\Models\Award;
use App\Services\FileService;

class AwardRepository
{
    public function store(array $data): Award
    {
        return Award::create($data);
    }

    public function delete(Award $data): Award
    {
        FileService::delete($data->affidavit);
        $data->delete();

        return $data;
    }

    public function update(array $data): Award
    {
        $professional_experience = Award::findOrFail($data['id']);
        $professional_experience->update($data);

        return $professional_experience->fresh();
    }
}
