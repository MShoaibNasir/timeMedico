<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->jobTitle,
            'skill_proficiency' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Expert']),
            'description' => $this->faker->sentence,
        ];
    }
}
