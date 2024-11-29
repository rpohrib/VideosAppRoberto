<?php

use App\Models\User;
use App\Models\Team;

function createDefaultUser(): User
{
    // Crear o obtenir l'equip per defecte
    $team = Team::firstOrCreate(
        ['name' => config('users.default_team_name')],
        ['user_id' => null] // Opcional, només si 'user_id' és nullable
    );

    // Crear o obtenir l'usuari per defecte
    $user = User::firstOrCreate(
        ['email' => config('users.default_user_email')],
        [
            'name' => config('users.default_user_name'),
            'password' => bcrypt(config('users.default_user_password')),
        ]
    );

    // Assegurar-nos que 'team_id' es guarda correctament
    if ($user->team_id !== $team->id) {
        $user->team_id = $team->id;
        $user->save();
    }

    return $user;
}

function createDefaultProfessor(): User
{
    // Crear o obtenir l'equip per defecte
    $team = Team::firstOrCreate(
        ['name' => config('users.default_team_name')],
        ['user_id' => null] // Opcional, només si 'user_id' és nullable
    );

    // Crear o obtenir el professor per defecte
    $professor = User::firstOrCreate(
        ['email' => config('users.default_professor_email')],
        [
            'name' => config('users.default_professor_name'),
            'password' => bcrypt(config('users.default_professor_password')),
        ]
    );

    // Assegurar-nos que 'team_id' es guarda correctament
    if ($professor->team_id !== $team->id) {
        $professor->team_id = $team->id;
        $professor->save();
    }

    return $professor;
}
