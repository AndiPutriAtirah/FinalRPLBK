<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Mapel,id;
use App\Models\Materi;

class MateriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Materi::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'mapel_id' => Mapel,id::factory(),
            'judul' => fake()->regexify('[A-Za-z0-9]{255}'),
            'deskripsi' => fake()->text(),
            'media_url' => fake()->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
