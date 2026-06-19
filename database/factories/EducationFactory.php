<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    protected $model = Education::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // auto-create related user
            'degree' => $this->faker->word,
            'degree_title' => $this->faker->sentence(3),
            'majors' => $this->faker->word,
            'institute_name' => $this->faker->company,
            'board_name' => $this->faker->company,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'obtained_marks' => $this->faker->numberBetween(300, 800),
            'total_marks' => 1000,
            'obtained_percentage' => $this->faker->randomFloat(2, 60, 100),
            'grade' => $this->faker->randomElement(['A+', 'A', 'B']),
            'foreign_qualified' => $this->faker->randomElement(['Yes', 'No']),
            'education_document' => null,
        ];
    }
}
