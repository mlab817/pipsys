<?php

namespace Database\Factories;

use App\Models\ProjectFsInfrastructure;
use App\Models\RefFundSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFsInfrastructureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectFsInfrastructure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_fund_source_id' => RefFundSource::all()->random()->id,
            'y2016' => $this->faker->randomFloat() * 1000,
            'y2017' => $this->faker->randomFloat() * 1000,
            'y2018' => $this->faker->randomFloat() * 1000,
            'y2019' => $this->faker->randomFloat() * 1000,
            'y2020' => $this->faker->randomFloat() * 1000,
            'y2021' => $this->faker->randomFloat() * 1000,
            'y2022' => $this->faker->randomFloat() * 1000,
            'y2023' => $this->faker->randomFloat() * 1000,
        ];
    }
}
