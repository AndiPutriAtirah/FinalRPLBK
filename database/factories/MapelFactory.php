<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Mapel;
use App\Models\Users,id;

class MapelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mapel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama_mapel' => fake()->regexify('[A-Za-z0-9]{255}'),
            'guru_id' => Users,id::factory(),
        ];
    }
}
