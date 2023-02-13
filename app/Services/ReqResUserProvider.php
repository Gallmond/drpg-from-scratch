<?php

namespace App\Services;

use App\DTOs\ProviderUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ReqResUserProvider implements UserProviderInterface
{
    public function __construct(
        private $providerName = 'reqres',
        private $domain = 'https://reqres.in',
    )
    {
        // promotion
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }

    private function getDTO(array $data): ProviderUser
    {
        return new ProviderUser(
            $data['id'],
            $data['email'],
            $data['first_name'],
            $data['last_name'],
            $data['avatar'],
            $this->getProviderName(),
        );
    }

    public function getUsers(int $minCount): Collection
    {
        $userDTOs = [];
        $page = 1;

        do{
            $pageData = $this->apiCall('/api/users', ['page' => $page]);

            foreach ($pageData['data'] ?? [] as $datum){
                $userDTOs[] = $this->getDTO($datum);
            }

            // current page is last page (or higher)
            $exhausted = $pageData['page'] >= $pageData['total_pages'];

            $page++;
        }while(
            count($userDTOs) < $minCount
            && !$exhausted
        );

        return collect($userDTOs);
    }


    private function apiCall(string $endPoint, array $queryParams): array
    {
        $response = Http::get("{$this->domain}{$endPoint}", $queryParams);

        return $response->json();
    }

}
