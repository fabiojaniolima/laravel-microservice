<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->colorName,
            'description' => $this->faker->sentence(10),
            'year_launched' => $this->faker->numberBetween(1895, date('Y')),
            'opened' => $this->faker->boolean,
            'rating' => $this->faker->randomElement(Video::RATING_LIST),
            'duration' => $this->faker->numberBetween(1, 320),
        ];
    }
}
