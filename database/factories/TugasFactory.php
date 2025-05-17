<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Materi,id;
use App\Models\Tugas;

class TugasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tugas::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'materi_id' => Materi,id::factory(),
            'judul' => fake()->regexify('[A-Za-z0-9]{255}'),
            'deskripsi' => fake()->text(),
            'deadline' => fake()->dateTime(),
        ];
    }
}
