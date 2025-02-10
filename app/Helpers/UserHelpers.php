<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
                'super_admin' => true,
            ]
        );

        // Assegurar-nos que 'team_id' es guarda correctament
        if ($professor->current_team_id !== $team->id) {
            $professor->current_team_id = $team->id;
            $professor->save();
        }

        return $professor;
    }

    public static function add_personal_team(User $user)
    {
        $team = Team::create([
            'user_id' => $user->id,
            'name' => "{$user->name}'s Team",
            'personal_team' => true,
        ]);

        $user->current_team_id = $team->id;
        $user->save();
    }

    public static function create_regular_user(): User
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'regular@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => false,
        ]);

        self::add_personal_team($user);

        return $user;
    }

    public static function create_video_manager_user(): User
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videosmanager@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => false,
        ]);

        self::add_personal_team($user);
        //Assignem el rol de Video Manager a l'usuari
        Permission::create(['name' => 'Video Manager']);
        $user->givePermissionTo('Video Manager');

        return $user;


    }

    public static function create_superadmin_user(): User
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => bcrypt('123456789'),
            'super_admin' => true,
        ]);

        self::add_personal_team($user);

        return $user;
    }

    public static function define_gates()
    {
        Gate::define('manage-videos', function ($user) {
            return $user->hasRole('Video Manager') || $user->isSuperAdmin();
        });

        Gate::define('super-admin', function ($user) {
            return $user->isSuperAdmin();
        });
    }

    public static function create_permissions()
    {
        $permissions = [
            'view videos',
            'create videos',
            'edit videos',
            'delete videos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'Video Manager']);
        $role->givePermissionTo($permissions);
    }



}
