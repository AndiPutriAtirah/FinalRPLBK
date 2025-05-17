<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PengumpulanTugas;
use App\Models\Tugas,id;
use App\Models\Users,id;

class PengumpulanTugasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PengumpulanTugas::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tugas_id' => Tugas,id::factory(),
            'siswa_id' => Users,id::factory(),
            'file_url' => fake()->regexify('[A-Za-z0-9]{255}'),
            'nilai' => fake()->randomFloat(2, 0, 999.99),
            'komentar' => fake()->text(),
            'status' => fake()->randomElement(["submitted","dinilai"]),
        ];
    }
}
