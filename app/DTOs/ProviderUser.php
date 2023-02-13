<?php

namespace App\DTOs;

class ProviderUser
{
    public function __construct(
        public mixed $id,
        public string $email,
        public string $first_name,
        public string $last_name,
        public string $avatar_url,
        public string $data_source,
    ) {
        // promotion
    }
}
