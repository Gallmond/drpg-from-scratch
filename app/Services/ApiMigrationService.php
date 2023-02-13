<?php

namespace App\Services;

use App\Models\User;

use function PHPUnit\Framework\assertInstanceOf;

class ApiMigrationService
{

    public function createUsersFromProvider(string $providerClass, int $minCount = 100)
    {
        $service = app()->make($providerClass);
        assert($service instanceof UserProviderInterface);

        $userDTOs = $service->getUsers($minCount);

        $userDTOs->each(function($userDTO){
            User::createFromProvider($userDTO);
        });
    }

}
