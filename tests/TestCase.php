<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockApiCalls();
    }

    protected function mockApiCalls(): void
    {
        $stubsPath = storage_path() . '/test/stubs';

        // comment this out to make real requests
        Http::fake([
            '/api/users?page=1' => Http::response(file_get_contents($stubsPath . '/reqres-users-page-1.json')),
            '/api/users?page=2' => Http::response(file_get_contents($stubsPath . '/reqres-users-page-2.json')),
        ]);
    }
}
