<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\User;

class UserModelTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserModelHasAvatar(): void {
        $user = User::factory()->create();
        assert($user instanceof User);

        $this->assertIsString($user->avatar_url);
    }

    public function testUserModelHasDataSource(): void {
        $user = User::factory()->create();
        assert($user instanceof User);

        $this->assertIsString($user->data_source);
    }
}
