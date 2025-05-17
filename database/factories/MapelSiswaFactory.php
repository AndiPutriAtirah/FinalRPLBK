<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Mapel,id;
use App\Models\MapelSiswa;
use App\Models\Users,id;

class MapelSiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MapelSiswa::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'mapel_id' => Mapel,id::factory(),
            'siswa_id' => Users,id::factory(),
        ];
    }
}
