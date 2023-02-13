<?php

namespace App\Console\Commands;

use App\Services\ApiMigrationService;
use App\Services\ReqResUserProvider;
use Illuminate\Console\Command;

class ApiMigrationCommand extends Command
{
    //TODO move this to a config
    private array $providers = [
        'reqres' => ReqResUserProvider::class,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-migration:provider {providerName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get users from a given provider and persist them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $providerName = $this->argument('providerName');
        $providerClass = $this->providers[ $providerName ] ?? null;

        if(!$providerClass){
            //TODO format this nice
            throw new \Exception("No config for given provider $providerName");
        }

        $service = app()->make(ApiMigrationService::class);
        assert($service instanceof ApiMigrationService);

        $service->createUsersFromProvider( $providerClass );

        $this->line("Migration complete from provider: $providerName");

        return Command::SUCCESS;
    }
}
