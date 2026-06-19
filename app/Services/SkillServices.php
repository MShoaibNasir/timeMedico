<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\UserSkill;
use App\Repositories\SkillRepository;

class SkillServices
{
    protected SkillRepository $skillRepo;

    public function __construct(SkillRepository $skillRepo)
    {
        $this->skillRepo = $skillRepo;
    }

    public function store(array $data): Skill
    {
        $data = $this->skillRepo->store($data);
        return $data;
    }
    public function storeUserSkill(array $data): UserSkill
    {
        $data = $this->skillRepo->storeUserSkill($data);
        return $data;
    }

    public function delete(int $id): Skill
    {
        $data = Skill::findOrFail($id);
        $result = $this->skillRepo->delete($data);

        return $result;
    }

    public function update(array $data): Skill
    {
        
        $data = $this->skillRepo->update($data);

        return $data;
    }
}
