<?php

namespace App\Repositories;

use App\Models\ProfessionalExperience;
use App\Services\FileService;

class ProfessionalExperienceRepository
{
    public function store(array $data): ProfessionalExperience
    {
        return ProfessionalExperience::create($data);
    }

    public function delete(ProfessionalExperience $data): ProfessionalExperience
    {
        FileService::delete($data->affidavit);
        $data->delete();

        return $data;
    }

    public function update(array $data): ProfessionalExperience
    {

        $professional_experience = ProfessionalExperience::findOrFail($data['id']);
        $professional_experience->update($data);

        return $professional_experience->fresh();
    }
}
