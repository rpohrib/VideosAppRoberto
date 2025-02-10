<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

//    protected function setUp(): void
//    {
//        parent::setUp();
//
//        // Create roles
//        Role::create(['name' => 'Video Manager']);
//        Role::create(['name' => 'Regular User']);
//        Role::create(['name' => 'Super Admin']);
//    }

    /** @test */
    public function user_with_permissions_can_manage_videos()
    {
//        // Asegurarse de que el rol existe
//        Role::firstOrCreate(['name' => 'Video Manager', 'guard_name' => 'web']);
//
//        $user = User::factory()->create();
//        $user->assignRole('Video Manager');
//
//        $this->actingAs($user);

        Auth::login(UserHelpers::create_video_manager_user());

        $response = $this->get('/videos/manage');
        $response->assertStatus(200);
    }

//    /** @test */
//    public function regular_users_cannot_manage_videos()
//    {
//        $this->loginAsRegularUser();
//
//        $response = $this->get('/videos/manage');
//        $response->assertStatus(403);
//    }
//
//    /** @test */
//    public function guest_users_cannot_manage_videos()
//    {
//        $response = $this->get('/videos/manage');
//        $response->assertRedirect('/login');
//    }
//
//    /** @test */
//    public function superadmins_can_manage_videos()
//    {
//        $this->loginAsSuperAdmin();
//
//        $response = $this->get('/videos/manage');
//        $response->assertStatus(200);
//    }
//
//
//    public function loginAsVideoManager()
//    {
//        $user = User::factory()->create();
//        $user->assignRole('Video Manager');
//        $this->actingAs($user);
//    }
//
//
//    public function loginAsSuperAdmin()
//    {
//        $user = User::factory()->create(['super_admin' => true]);
//        $this->actingAs($user);
//    }
//
//
//    public function loginAsRegularUser()
//    {
//        $user = User::factory()->create();
//        $user->assignRole('Regular User');
//        $this->actingAs($user);
//    }
}
