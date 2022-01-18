<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\EventLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'eventtype' => $this->faker->randomElement(['COMMENTWRITTEN' ,'LESSONWATCHED']),
            'comment' => $this->faker->text(),
            'user_id' => User::factory(),
        ];
    }
}
