<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ApiMigrationCommandTest extends TestCase
{
    use DatabaseMigrations;


    public function testCommandCreatesUsers(): void
    {
        $this->assertDatabaseMissing(User::class, [
            'data_source' => 'reqres',
        ]);

        $providerName = 'reqres';
        $this->artisan("api-migration:provider $providerName")
            ->assertSuccessful();

        $this->assertDatabaseHas(User::class, [
            'data_source' => 'reqres',
        ]);
    }
}
