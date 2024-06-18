<?php

namespace Database\Factories;

use App\Models\StudentsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentsFactory extends Factory
{
    protected $model = StudentsModel::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'department' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
