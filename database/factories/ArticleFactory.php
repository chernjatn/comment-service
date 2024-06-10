<?php

namespace Database\Factories;

use App\Enums\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ext_id'  => $this->faker->randomDigitNotNull,
            'channel' => Channel::OZERKI,
            'title'   => $this->faker->title,
            'version' => mt_rand(11111, 55555)
        ];
    }
}
