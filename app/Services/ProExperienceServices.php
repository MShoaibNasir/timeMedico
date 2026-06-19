<?php

namespace App\Services;

use App\Models\ProfessionalExperience;
use App\Repositories\ProfessionalExperienceRepository;

class ProExperienceServices
{
    protected ProfessionalExperienceRepository $prorepo;

    public function __construct(ProfessionalExperienceRepository $prorepo)
    {
        $this->prorepo = $prorepo;
    }

    public function store(array $data): ProfessionalExperience
    {
        if (isset($data['affidavit'])) {
            $data['affidavit']=1;
            // $file_name = FileService::upload($data['affidavit'], 'uploads/general/media/professional/affidavit');
            // $data['affidavit'] = $file_name;
        }
        $data = $this->prorepo->store($data);

        return $data;
    }

    public function delete(int $id): ProfessionalExperience
    {
        $data = ProfessionalExperience::findOrFail($id);
        $result = $this->prorepo->delete($data);

        return $result;
    }

    public function update(array $data): ProfessionalExperience
    {

        $proexp = ProfessionalExperience::find($data['id']);
        if (isset($data['affidavit'])) {
            $file_name = FileService::upload($data['affidavit'], 'uploads/general/media/professional/affidavit');
            $data['affidavit'] = $file_name;
            FileService::delete($proexp->affidavit);
        }
        $data = $this->prorepo->update($data);

        return $data;
    }
}
