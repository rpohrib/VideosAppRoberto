<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\Team;

class UserHelpers {
    public static function createDefaultUser(): User
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
                'password' => config('users.default_user_password'),
            ]
        );

        // Assegurar-nos que 'team_id' es guarda correctament
        if ($user->current_team_id !== $team->id) {
            $user->current_team_id = $team->id;
            $user->save();
        }

        return $user;
    }

    public static function createDefaultProfessor(): User
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
                'password' => config('users.default_professor_password'),
            ]
        );

        // Assegurar-nos que 'team_id' es guarda correctament
        if ($professor->current_team_id !== $team->id) {
            $professor->current_team_id = $team->id;
            $professor->save();
        }

        return $professor;
    }

}
