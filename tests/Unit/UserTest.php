<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase

{

    use RefreshDatabase;
    /** @test */
    public function it_checks_if_user_is_super_admin()
    {
        $user = User::factory()->create();
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $user->assignRole($superAdmin);

        $this->assertTrue($user->isSuperAdmin());

    }


    /** @test */
    public function user_without_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function user_with_permissions_can_see_default_users_page()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'User Manager']);
        $user->assignRole($role);

        $this->actingAs($user)
            ->get(route('users.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function not_logged_users_cannot_see_default_users_page()
    {
        $this->get(route('users.index'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_without_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('users.show', $user->id))
            ->assertStatus(200);
    }

    /** @test */
    public function user_with_permissions_can_see_user_show_page()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'User Manager']);
        $user->assignRole($role);

        $this->actingAs($user)
            ->get(route('users.show', $user->id))
            ->assertStatus(200);
    }

    /** @test */
    public function not_logged_users_cannot_see_user_show_page()
    {
        $user = User::factory()->create();
        $this->get(route('users.show', $user->id))
            ->assertRedirect(route('login'));
    }

}
