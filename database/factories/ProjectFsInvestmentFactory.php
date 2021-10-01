<?php

namespace Database\Factories;

use App\Models\ProjectFsInvestment;
use App\Models\RefFundSource;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFsInvestmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectFsInvestment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ref_fund_source_id' => RefFundSource::all()->random()->id,
            'y2017' => $this->faker->randomFloat() * 1000,
            'y2018' => $this->faker->randomFloat() * 1000,
            'y2019' => $this->faker->randomFloat() * 1000,
            'y2020' => $this->faker->randomFloat() * 1000,
            'y2021' => $this->faker->randomFloat() * 1000,
            'y2022' => $this->faker->randomFloat() * 1000,
        ];
    }
}
