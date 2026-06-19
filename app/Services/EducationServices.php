<?php

namespace App\Services;

use App\Models\Education;
use App\Repositories\EducationRepository;

class EducationServices
{
    protected EducationRepository $educationRepo;

    public function __construct(EducationRepository $educationRepo)
    {
        $this->educationRepo = $educationRepo;
    }

    public function store(array $data): Education
    {
        if(isset($data['education_document'])){            
            $file_name = FileService::upload($data['education_document'], 'uploads/general/media/educationDocument');
            $data['education_document'] = $file_name;
        }
        $data = $this->educationRepo->store($data);
        return $data;
    }

    public function delete(int $id): Education
    {
        $data = Education::findOrFail($id);
        $result = $this->educationRepo->delete($data);

        return $result;
    }

    public function update(array $data): Education
    {
        $education = Education::findOrFail($data['education_id']);

        if (isset($data['education_document'])) {
            FileService::delete($education->education_document);
            $file_name = FileService::upload(
                $data['education_document'],
                'uploads/general/media/educationDocument'
            );
            $data['education_document'] = $file_name;
        }
        $data = $this->educationRepo->update($data);

        return $data;
    }
}
