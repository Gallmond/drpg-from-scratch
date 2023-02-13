<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\ApiMigrationService;
use App\Services\ReqResUserProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ApiMigrationServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanGetProviderUsers(): void
    {
        // mock the api calls
        $this->mockApiCalls();

        $this->assertDatabaseMissing(User::class, [
            'data_source' => 'reqres',
        ]);

        $service = $this->app->make(ApiMigrationService::class);
        assert($service instanceof ApiMigrationService);

        $service->createUsersFromProvider(ReqResUserProvider::class);

        $this->assertDatabaseHas(User::class, [
            'data_source' => 'reqres'
        ]);
    }
}
