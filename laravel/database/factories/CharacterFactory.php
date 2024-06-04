<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\characters>
 */
class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'game_id' => function () {
                return Game::factory()->create()->id;
            },
            'name' => fake()->name,
            'class' => fake()->randomElement(['Bárbaro', 'Bardo', 'Brujo', 'Clérigo', 'Druida', 'Explorador', 'Guerrero', 'Hechicero', 'Mago', 'Monje', 'Paladín', 'Pícaro']),
            'race' => fake()->randomElement(['Dracónido', 'Elfo', 'Enano', 'Gnomo', 'Humano', 'Mediano', 'Semielfo', 'Semiorco', 'Tiefling']),
            'faction' => fake()->randomElement(['Arpistas', 'Orden del Guantelete', 'Enclave Esmeralda', 'Alianza de los Señores','Zhentarim', 'Sin facción']),
            'background' => fake()->paragraph(),
        ];
    }
}
