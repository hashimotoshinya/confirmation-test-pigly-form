<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('-180 days', 'today')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 40, 100),
            'calories' => $this->faker->numberBetween(1000, 3000),
            'exercise_time' => sprintf('%02d:%02d', rand(0, 2), rand(0, 59)),
            'exercise_content' => $this->faker->randomElement(['ランニング', 'ウォーキング', '筋トレ', 'ヨガ']),
        ];
    }
}
