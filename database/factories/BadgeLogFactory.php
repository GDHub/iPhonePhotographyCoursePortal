<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\BadgeLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BadgeLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'badge' => $this->faker->randomElement(['BEGINNER', 'INTERMEDIATE', 'ADVANCED', 'MASTER']),
            'comment' => $this->faker->text(),
            'watched' => $this->faker->randomDigit(),
            'written' => $this->faker->randomDigit(),
            'user_id' => User::factory(),
        ];
    }
}
