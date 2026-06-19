<?php

namespace App\Services;

use App\Models\BioProfile;
use App\Models\User;
use App\Repositories\BioProfileRepository;
use App\Services\FileService;

class BioProfileServices
{
    protected BioProfileRepository $bioProfileRepo;

    public function __construct(BioProfileRepository $bioProfileRepo)
    {
        $this->bioProfileRepo = $bioProfileRepo;
    }

    public function store(array $data): BioProfile
    {
        
        $data = $this->bioProfileRepo->store($data);
        return $data;
    }

    public function delete(int $id): BioProfile
    {
        $data = BioProfile::findOrFail($id);
        $result = $this->bioProfileRepo->delete($data);
        return $result;
    }

    public function update(array $data): BioProfile
    {
        
        $data = $this->bioProfileRepo->update($data);
        return $data;
    }
    public function updatePersonalInfo(array $data): User
    {
        if($data['profile_picture']){
           $profile_name=FileService::upload($data['profile_picture'],'uploads/general/media/profile');
           $data['profile_picture']=$profile_name;
        }
        $data = $this->bioProfileRepo->updatePersonalInfo($data);
        return $data;
    }
}
