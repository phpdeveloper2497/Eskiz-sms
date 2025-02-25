<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray();
        $status = Status::pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence(3),
            'user_id' =>$this->faker->randomElement($users) ,
            'status_id' =>$this->faker->randomElement($status) ,
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),

        ];
    }
}
