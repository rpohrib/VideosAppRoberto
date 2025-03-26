<?php

namespace Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function loginAsVideoManager()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Video Manager']);
        $user->assignRole($role);
        $this->actingAs($user);
    }

    private function loginAsSuperAdmin()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);
        $this->actingAs($user);
    }

    private function loginAsRegularUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function user_with_permissions_can_see_add_users()
    {
        $this->loginAsSuperAdmin();
        $this->get(route('users.manage.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function user_without_users_manage_create_cannot_see_add_users()
    {
        $this->loginAsSuperAdmin();
        $response = $this->get(route('users.manage.create'))
            ->assertStatus(200);

        $response->assertContent("You do not have permission to view this page.");
    }

    /** @test */
    public function user_with_permissions_can_store_users()
    {
        $this->loginAsSuperAdmin();
        $this->post(route('users.manage.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assertRedirect(route('users.manage.index'));
    }

    /** @test */
    public function user_without_permissions_cannot_store_users()
    {
        $this->loginAsRegularUser();
        $this->post(route('users.manage.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_destroy_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $this->delete(route('users.manage.destroy', $user->id))
            ->assertRedirect(route('users.manage.index'));
    }

    /** @test */
    public function user_without_permissions_cannot_destroy_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $this->delete(route('users.manage.destroy', $user->id))
            ->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_see_edit_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $this->get(route('users.manage.edit', $user->id))
            ->assertStatus(200);
    }

    /** @test */
    public function user_without_permissions_cannot_see_edit_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $this->get(route('users.manage.edit', $user->id))
            ->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_update_users()
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ])->assertRedirect(route('users.manage.index'));
    }

    /** @test */
    public function user_without_permissions_cannot_update_users()
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $this->put(route('users.manage.update', $user->id), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ])->assertStatus(403);
    }

    /** @test */
    public function user_with_permissions_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $this->get(route('users.manage.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function regular_users_cannot_manage_users()
    {
        $this->loginAsRegularUser();
        $this->get(route('users.manage.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function guest_users_cannot_manage_users()
    {
        $this->get(route('users.manage.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function superadmins_can_manage_users()
    {
        $this->loginAsSuperAdmin();
        $this->get(route('users.manage.index'))
            ->assertStatus(200);
    }
}
