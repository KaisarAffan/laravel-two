<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gradeName = fake()->unique()->randomElement([
            'X PPLG 1', 'X PPLG 2', 'XI PPLG 1', 'XI PPLG 2', 'XII PPLG 1', 'XII PPLG 2',
            'X Animasi 1', 'X Animasi 2', 'X Animasi 3', 'X Animasi 4', 'X Animasi 5',
            'XI Animasi 1', 'XI Animasi 2', 'XI Animasi 3', 'XI Animasi 4', 'XI Animasi 5',
            'XII Animasi 1', 'XII Animasi 2', 'XII Animasi 3', 'XII Animasi 4', 'XII Animasi 5',
            'X Teknik Grafika 1', 'X Teknik Grafika 2', 'XI Teknik Grafika 1', 'XI Teknik Grafika 2',
            'XII Teknik Grafika 1', 'XII Teknik Grafika 2', 'X DKV 1', 'X DKV 2', 'XI DKV 1',
            'XI DKV 2', 'XII DKV 1', 'XII DKV 2',
        ]);

        $departmentId = null;

        if (str_contains($gradeName, 'PPLG')) {
            $departmentId = Department::where('name', 'PPLG')->value('id');
        } elseif (preg_match('/Animasi (1|2|3)/', $gradeName)) {
            $departmentId = Department::where('name', 'Animasi 3D')->value('id');
        } elseif (preg_match('/Animasi (4|5)/', $gradeName)) {
            $departmentId = Department::where('name', 'Animasi 2D')->value('id');
        } elseif (str_contains($gradeName, 'Teknik Grafika')) {
            $departmentId = Department::where('name', 'DKV TG')->value('id');
        } elseif (str_contains($gradeName, 'DKV')) {
            $departmentId = Department::where('name', 'DKV DG')->value('id');
        }

        return [
            'name' => $gradeName,
            'department_id' => $departmentId,
        ];
    }
}
