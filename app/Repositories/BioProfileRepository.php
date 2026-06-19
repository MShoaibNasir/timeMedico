<?php

namespace App\Repositories;

use App\Models\BioProfile;
use App\Models\User;

class BioProfileRepository
{
    public function store(array $data): BioProfile
    {
        return BioProfile::create($data);
    }
    public function updatePersonalInfo(array $data): User
    {
        
       
        
        User::where('id',$data['user_id'])->update([
            'name'=>$data['name'] ?? null,
            'phone_number'=>$data['phone_number'] ?? null,
            'gender'=>$data['gender'] ?? null,
            'nationality'=>$data['nationality'] ?? null,
            'cnic_or_passport'=>$data['cnic_or_passport'] ?? null,
            'date_of_birth'=>$data['date_of_birth'] ?? null,
            'residential_address'=>$data['residential_address'] ?? null,
            'profile_picture'=>$data['profile_picture'] ?? null,
            'professional'=>$data['professional'] ?? null,
            'introduction'=>$data['introduction'] ?? null,
            ]);
        return User::find($data['user_id']);   
    }

    public function delete(BioProfile $skill): BioProfile
    {
        $skill->delete();

        return $skill;
    }

    public function update(array $data): BioProfile
    {
            $skill = BioProfile::updateOrCreate(
                ['user_id' => $data['user_id']], 
                $data                  
            );
            
            return $skill;
    }
}
