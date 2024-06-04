<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Game;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user-> name = 'Cristina Pérez';
        $user-> nickname = 'cripeboi';
        $user-> email = 'cripeboi@gmail.com';
        $user-> password = bcrypt('cripeboi');
        $user->save();
        $user->roles()->attach(Role::where('id',2)->first());

        // Crea 5 usuarios
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) {
                // Obtenemos roles existentes de la base de datos
                $rol = Role::where('id',2)->first();

                $user->roles()->attach($rol);

                // Creamos dos juegos adicionales para el usuario
                $games = Game::factory()->count(2)->create(['user_id' => $user->id]);

                // Para cada juego, crea un personaje
                $games->each(function ($game) {
                    Character::factory()->create(['game_id' => $game->id]);
                });



});


    }
}
