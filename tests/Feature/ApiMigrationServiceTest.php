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

    private function mockApiCalls(): void
    {
        $stubsPath = storage_path() . '/test/stubs';

        // comment this out to make real requests
        Http::fake([
            '/api/users?page=1' => Http::response(file_get_contents($stubsPath . '/reqres-users-page-1.json')),
            '/api/users?page=2' => Http::response(file_get_contents($stubsPath . '/reqres-users-page-2.json')),
        ]);
    }

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
