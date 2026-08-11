<?php

namespace App\Repositories;

use App\Models\Education;
use App\Services\FileService;

class EducationRepository
{
    public function store(array $data): Education
    {

        return Education::create($data);
    }

    public function delete(Education $education): Education
    {
        FileService::delete($education->education_document);
        $education->delete();

        return $education;
    }

    public function update(array $data): Education
    {
        $education = Education::findOrFail($data['education_id']);
        $education->update($data);

        return $education->fresh();
    }
}
