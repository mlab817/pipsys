<?php

namespace Database\Factories;

use App\Models\ProjectUpdate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectUpdateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectUpdate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'update'   => $this->faker->paragraph,
            'date'     => $this->faker->date,
        ];
    }
}
