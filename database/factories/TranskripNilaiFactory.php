<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TranskripNilai;
use App\Models\Users,id;

class TranskripNilaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TranskripNilai::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'siswa_id' => Users,id::factory(),
            'total_nilai' => fake()->randomFloat(2, 0, 999.99),
            'keterangan' => fake()->regexify('[A-Za-z0-9]{100}'),
        ];
    }
}
