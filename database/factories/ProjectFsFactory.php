<?php

namespace Database\Factories;

use App\Models\ProjectFs;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectFs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(array_keys(ProjectFs::FS_STATUS)),
            'y2017' => $this->faker->randomFloat() * 1000,
            'y2018' => $this->faker->randomFloat() * 1000,
            'y2019' => $this->faker->randomFloat() * 1000,
            'y2020' => $this->faker->randomFloat() * 1000,
            'y2021' => $this->faker->randomFloat() * 1000,
            'y2022' => $this->faker->randomFloat() * 1000,
            'start_date' => $this->faker->date,
            'completion_date' => $this->faker->date,
        ];
    }
}
