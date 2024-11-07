<?php

namespace Database\Factories;
use App\Models\Grade;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'Nama' => fake()->name($gender = 'female'),
            'grade_id' => $gradeId = fake()->numberBetween(1, 33),
            'Email' => fake()->unique()->safeEmail(),
            'Alamat' => fake()->address(),
        ];
    }
}
