<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Creem els permisos
        UserHelpers::create_permissions();

    }

    /** @test */
    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get(route('manage.create'));
        $response->assertStatus(200);
        $response->assertViewIs('manage.create');
    }

    /** @test */
    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->get(route('manage.create'));
        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_store_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->post(route('manage.create'), [
            'title' => 'New Video',
            'description' => 'Video Description',
            'url' => 'https://example.com/video',
        ]);

        $response->assertRedirect(route('videos.index'));
        $this->assertDatabaseHas('videos', ['title' => 'New Video']);
    }

    /** @test */
    public function user_without_permissions_cannot_store_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->post(route('manage.store'), [
            'title' => 'New Video',
            'description' => 'Video Description',
            'url' => 'https://example.com/video',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('videos', ['title' => 'New Video']);
    }

    /** @test */
    public function user_with_permissions_can_destroy_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::factory()->create();

        $response = $this->delete(route('videos.destroy', $video));
        $response->assertRedirect(route('manage.index'));
        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    /** @test */
    public function user_without_permissions_cannot_destroy_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::factory()->create();

        $response = $this->delete(route('videos.destroy', $video));
        $response->assertStatus(403);
        $this->assertDatabaseHas('videos', ['id' => $video->id]);
    }

    /** @test */
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::factory()->create();

        $response = $this->get(route('manage.edit', $video));
        $response->assertStatus(200);
        $response->assertViewIs('manage.edit');
    }

    /** @test */
    public function user_without_permissions_cannot_see_edit_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::factory()->create();

        $response = $this->get(route('manage.edit', $video));
        $response->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_update_videos()
    {
        $this->loginAsVideoManager();
        $video = Video::factory()->create();

        $response = $this->put(route('videos.update', $video), [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'https://example.com/updated-video',
        ]);

        $response->assertRedirect(route('videos.index'));
        $this->assertDatabaseHas('videos', ['title' => 'Updated Title']);
    }

    /** @test */
    public function user_without_permissions_cannot_update_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::factory()->create();

        $response = $this->put(route('videos.update', $video), [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'https://example.com/updated-video',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('videos', ['title' => 'Updated Title']);
    }

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {
        Auth::login(UserHelpers::create_video_manager_user());

        // Create 3 video instances
        $videos = \App\Models\Video::factory()->count(3)->create();

        $response = $this->get('/roberto2');
        $response->assertStatus(200);

        // Additional assertions to verify the videos are present
        $response->assertSee($videos[0]->title);
        $response->assertSee($videos[1]->title);
        $response->assertSee($videos[2]->title);
    }

    /** @test */
    public function regular_users_cannot_manage_videos()
    {
        $this->loginAsRegularUser();

        $response = $this->get('/roberto2');
        $response->assertStatus(202);
    }

    /** @test */
    public function guest_users_cannot_manage_videos()
    {

        $this->loginAsRegularUser();
        $response = $this->get('/roberto2');
        $response->assertStatus(202);
    }

    /** @test */
    public function superadmins_can_manage_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/roberto2');
        $response->assertStatus(200);
    }


    public function loginAsVideoManager()
    {
        $user = User::factory()->create();
        $user->assignRole('Video Manager');
        $user->givePermissionTo('manage-videos');
        $this->actingAs($user);
    }


    public function loginAsSuperAdmin()
    {
        $user = User::factory()->create(['super_admin' => true]);
        $user->assignRole('Super Admin');
        $user->givePermissionTo('manage-videos');
        $this->actingAs($user);
    }


    public function loginAsRegularUser()
    {
        $user = User::factory()->create();
        $user->assignRole('Regular User');
        $this->actingAs($user);
    }
}
