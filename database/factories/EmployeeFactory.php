<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Employee;


class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'age' => $this->faker->numberBetween(15, 150),
            'work_experience' => $this->faker->numberBetween(15, 150),
            'photo' => $this->faker->imageUrl(225, 360, 'photo', true),
            'average_salary' => $this->faker->randomNumber(9, false)
        ];
    }
}
