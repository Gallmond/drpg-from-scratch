<?php

namespace App\Services;

use App\DTOs\ProviderUser;
use Illuminate\Support\Collection;

interface UserProviderInterface
{
    public function getProviderName(): string;

    /**
     * @param int $minCount
     * @return Collection<ProviderUser>
     */
    public function getUsers(int $minCount): Collection;
}
