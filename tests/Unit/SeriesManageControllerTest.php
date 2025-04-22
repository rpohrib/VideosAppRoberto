<?php

namespace Tests\Feature;

use App\Models\Series;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function loginAsVideoManager()
    {
        $user = User::factory()->create();
        $user->assignRole('video_manager');
        $this->actingAs($user);
    }

    private function loginAsSuperAdmin()
    {
        $user = User::factory()->create();
        $user->assignRole('superadmin');
        $this->actingAs($user);
    }

    private function loginAsRegularUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function user_with_permissions_can_see_add_series()
    {
        $this->loginAsVideoManager();
        $this->get(route('series.manage.create'))->assertStatus(200);
    }

    /** @test */
    public function user_without_series_manage_create_cannot_see_add_series()
    {
        $this->loginAsRegularUser();
        $this->get(route('series.manage.create'))->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_store_series()
    {
        $this->loginAsVideoManager();
        $data = Series::factory()->make()->toArray();
        $this->post(route('series.store'), $data)->assertRedirect(route('series.index'));
        $this->assertDatabaseHas('series', $data);
    }

    /** @test */
    public function user_without_permissions_cannot_store_series()
    {
        $this->loginAsRegularUser();
        $data = Series::factory()->make()->toArray();
        $this->post(route('series.store'), $data)->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_destroy_series()
    {
        $this->loginAsVideoManager();
        $series = Series::factory()->create();
        $this->delete(route('series.delete', $series->id))->assertRedirect(route('series.index'));
        $this->assertDatabaseMissing('series', ['id' => $series->id]);
    }

    /** @test */
    public function user_without_permissions_cannot_destroy_series()
    {
        $this->loginAsRegularUser();
        $series = Series::factory()->create();
        $this->delete(route('series.delete', $series->id))->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_see_edit_series()
    {
        $this->loginAsVideoManager();
        $series = Series::factory()->create();
        $this->get(route('series.manage.edit', $series->id))->assertStatus(200);
    }

    /** @test */
    public function user_without_permissions_cannot_see_edit_series()
    {
        $this->loginAsRegularUser();
        $series = Series::factory()->create();
        $this->get(route('series.manage.edit', $series->id))->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_update_series()
    {
        $this->loginAsVideoManager();
        $series = Series::factory()->create();
        $data = ['title' => 'Updated Title'];
        $this->put(route('series.update', $series->id), $data)->assertRedirect(route('series.index'));
        $this->assertDatabaseHas('series', ['id' => $series->id, 'title' => 'Updated Title']);
    }

    /** @test */
    public function user_without_permissions_cannot_update_series()
    {
        $this->loginAsRegularUser();
        $series = Series::factory()->create();
        $data = ['title' => 'Updated Title'];
        $this->put(route('series.update', $series->id), $data)->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_manage_series()
    {
        $this->loginAsVideoManager();
        $this->get(route('series.index'))->assertStatus(200);
    }

    /** @test */
    public function regular_users_cannot_manage_series()
    {
        $this->loginAsRegularUser();
        $this->get(route('series.index'))->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_series()
    {
        $this->get(route('series.index'))->assertRedirect(route('login'));
    }

    /** @test */
    public function videomanagers_can_manage_series()
    {
        $this->loginAsVideoManager();
        $this->get(route('series.index'))->assertStatus(200);
    }

    /** @test */
    public function superadmins_can_manage_series()
    {
        $this->loginAsSuperAdmin();
        $this->get(route('series.index'))->assertStatus(200);
    }
}
