<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Inserir els usuaris Test i Professor
        DB::table('users')->insert([
            [
                'name' => 'Test',
                'email' => 'test@example.com',
                'password' => bcrypt('test'), // Contrasenya encriptada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Professor',
                'email' => 'professor@example.com',
                'password' => bcrypt('professor'), // Contrasenya encriptada
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

   
    public function down()
    {
        // Eliminar els usuaris Test i Professor si existeixen
        DB::table('users')
            ->where('email', 'test@example.com')
            ->orWhere('email', 'professor@example.com')
            ->delete();
    }
};
