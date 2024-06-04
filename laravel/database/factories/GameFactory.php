<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factoría GameFactory
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente a la factoría.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array
     */
    
    public function definition()
    {
        $numOfImages = rand(1,5);

        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['Active', 'Finished']),
            'context' => fake()->paragraph(),
            'img_register' => collect([
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl()
            ])->random($numOfImages)
        ];
    }

}
