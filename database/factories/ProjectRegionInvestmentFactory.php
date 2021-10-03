<?php

namespace Database\Factories;

use App\Models\ProjectRegionInvestment;
use App\Models\RefRegion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRegionInvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectRegionInvestment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_region_id' => RefRegion::all()->random()->id,
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
