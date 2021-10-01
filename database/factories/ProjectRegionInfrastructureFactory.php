<?php

namespace Database\Factories;

use App\Models\ProjectRegionInfrastructure;
use App\Models\RefRegion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRegionInfrastructureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectRegionInfrastructure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_fund_source_id' => RefRegion::all()->random()->id,
            'y2017' => $this->faker->randomFloat() * 1000,
            'y2018' => $this->faker->randomFloat() * 1000,
            'y2019' => $this->faker->randomFloat() * 1000,
            'y2020' => $this->faker->randomFloat() * 1000,
            'y2021' => $this->faker->randomFloat() * 1000,
            'y2022' => $this->faker->randomFloat() * 1000,
        ];
    }
}
