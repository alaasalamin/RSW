<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stancl\Tenancy\Database\Models\Tenant;

class MakeTenantCommand extends Command
{
    protected $signature = 'make:tenant {name} {--domain=}';
    protected $description = 'Create a new tenant with optional domain';

    public function handle()
    {
        $name = $this->argument('name');
        $domain = $this->option('domain') ?? strtolower(str_replace(' ', '', $name)) . '.localhost';

        $tenant = Tenant::create([
            'id' => $this->argument('name'),
            'data' => [
                // You can store extra tenant metadata here
                'name' => $this->argument('name'),
            ],
            'domains' => [
                $this->option('domain'),
            ],
        ]);


        $this->info("✅ Tenant '{$name}' created with domain '{$domain}'");
    }
}
