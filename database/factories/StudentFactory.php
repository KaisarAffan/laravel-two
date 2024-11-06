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
            'department_id' => function () use ($gradeId) {
                $grade = Grade::find($gradeId);

                if ($grade) {
                    if (str_contains($grade->Name, 'PPLG')) {
                        return Department::where('name', 'PPLG')->first()->id;
                    } elseif (preg_match('/Animasi (1|2|3)/', $grade->Name)) {
                        return Department::where('name', 'Animasi 3D')->first()->id;
                    } elseif (preg_match('/Animasi (4|5)/', $grade->Name)) {
                        return Department::where('name', 'Animasi 2D')->first()->id;
                    } elseif (str_contains($grade->Name, 'Teknik Grafika')) {
                        return Department::where('name', 'DKV TG')->first()->id;
                    } elseif (str_contains($grade->Name, 'DKV')) {
                        return Department::where('name', 'DKV DG')->first()->id;
                    }
                }

            },
            'Email' => fake()->unique()->safeEmail(),
            'Alamat' => fake()->address(),
        ];
    }
}
