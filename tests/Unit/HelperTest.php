<?php

namespace Tests\Feature;

use App\Helpers\UserHelpers;
use App\Helpers\VIdeosHelpers;
use App\Models\Team;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use function Laravel\Prompts\password;

class HelperTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_default_user_and_professor()
    {
        // Crear els usuaris i associar-los a un equip
        $defaultUser = UserHelpers::createDefaultUser();
        $defaultProfessor = UserHelpers::createDefaultProfessor();

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
        $this->assertEquals($team->id, $defaultUser->current_team_id);
        $this->assertEquals($team->id, $defaultProfessor->current_team_id);


         // Comprova la contrasenya de l'usuari
//        $this->assertTrue(Hash::check(config('users.default_user_password'), $defaultUser->password), 'User password does not match');
//        $this->assertTrue(Hash::check(config('users.default_professor_password'), $defaultProfessor->password), 'Professor password does not match');
    }
    /** @test */
    public function it_can_create_default_videos()
    {
        // Get the default videos
        $defaultVideos = VIdeosHelpers::getDefaultVideo();

        // Create the default videos
        foreach ($defaultVideos as $videoData) {
            Video::create($videoData);
        }

        // Assert that the videos are created in the database
        foreach ($defaultVideos as $videoData) {
            $this->assertDatabaseHas('videos', [
                'title' => $videoData['title'],
                'description' => $videoData['description'],
                'url' => $videoData['url'],
                'series_id' => $videoData['series_id'],
            ]);
        }
    }
}
