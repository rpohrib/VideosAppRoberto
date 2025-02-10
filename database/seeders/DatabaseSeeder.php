<?php

namespace Database\Seeders;

use App\Helpers\UserHelpers;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            VideosTableSeeder::class,
        ]);

        // Crear permisos
        UserHelpers::create_permissions();

        // Crear usuaris per defecte
        UserHelpers::create_superadmin_user();
        UserHelpers::create_regular_user();
        UserHelpers::create_video_manager_user();
    }
}
