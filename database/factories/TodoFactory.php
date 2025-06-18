<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Todo::class;

    public function definition(): array
    {
        $status = ['pending', 'open', 'in_progress', 'completed'];
        $priority = ['low', 'medium', 'high'];
        $assignees = ['fahmi', 'udin', 'budi', 'rani'];

        return [
            'title' => $this->faker->sentence(3),
            'assignee' => $this->faker->randomElement($assignees),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'time_tracked' => $this->faker->randomFloat(1, 0.5, 12),
            'status' => $this->faker->randomElement($status),
            'priority' => $this->faker->randomElement($priority),
        ];
    }
}
