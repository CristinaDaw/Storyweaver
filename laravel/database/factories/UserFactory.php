<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
* Factoría UserFactory
*
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
*/

class UserFactory extends Factory
{

    /**
     * El nombre del modelo correspondiente a la factoría.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'nickname' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password')
        ];
    }
    
}
