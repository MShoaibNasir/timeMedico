<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\UserSkill;

class SkillRepository
{
    public function store(array $data): Skill
    {
        return Skill::create($data);
    }
    public function storeUserSkill(array $data): UserSkill
    {
        return UserSkill::create($data);
    }

    public function delete(Skill $skill): Skill
    {
        $skill->delete();
        return $skill;
    }

    public function update(array $data): Skill
    {
        $skill = Skill::findOrFail($data['skill_id']);
        $skill->update($data);

        return $skill->fresh();
    }
}
