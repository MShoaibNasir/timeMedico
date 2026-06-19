<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\UserSkill;

class SpeakAndWriteReposatory
{
    public function index(array $data)
    {
        return Skill::create($data);
    }


  
}
