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

}
