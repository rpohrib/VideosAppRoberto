<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_default_user_and_professor()
    {
        // Crear els usuaris i associar-los a un equip
        $defaultUser = createDefaultUser();
        $defaultProfessor = createDefaultProfessor();

        // Comprovar que els usuaris s'han creat
        $this->assertDatabaseHas('users', [
            'name' => config('users.default_user_name'),
            'email' => config('users.default_user_email'),
        ]);

        $this->assertDatabaseHas('users', [
            'name' => config('users.default_professor_name'),
            'email' => config('users.default_professor_email'),
        ]);

        // Comprovar que estan associats al mateix equip
        $team = Team::where('name', config('users.default_team_name'))->first();
        $this->assertNotNull($team);

        // Comprovar que els usuaris tenen el mateix team_id
        $this->assertEquals($team->id, $defaultUser->team_id);
        $this->assertEquals($team->id, $defaultProfessor->team_id);
    }
}
