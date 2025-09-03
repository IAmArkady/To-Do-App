<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement([
                Task::STATUS_PENDING,
                Task::STATUS_RETRY,
                Task::STATUS_FAILURE,
                Task::STATUS_RECEIVED,
                Task::STATUS_SUCCESS,
                Task::STATUS_STARTED
            ]),
        ];
    }
}
