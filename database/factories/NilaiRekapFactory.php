<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Mapel,id;
use App\Models\NilaiRekap;
use App\Models\Users,id;

class NilaiRekapFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NilaiRekap::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'siswa_id' => Users,id::factory(),
            'mapel_id' => Mapel,id::factory(),
            'nilai_akhir' => fake()->randomFloat(2, 0, 999.99),
        ];
    }
}
