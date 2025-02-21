<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Annonce;
use App\Models\Category;
use App\Models\User;

class AnnonceFactory extends Factory
{
    protected $model = Annonce::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => $this->faker->imageUrl(),
            'user_id' => User::factory(), 
            'category_id' => Category::factory(), 
            'status' => 'active',
        ];
    }
}

