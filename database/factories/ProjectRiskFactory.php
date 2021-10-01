<?php

namespace Database\Factories;

use App\Models\ProjectRisk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRiskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectRisk::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'risk' => $this->faker->paragraph,
        ];
    }
}
