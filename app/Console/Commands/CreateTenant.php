<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class CreateTenant extends Command
{
    protected $signature = 'tenant:create {name} {domain}';
    protected $description = 'Create a new tenant with its domain and run migrations';

    public function handle()
    {
        $name = $this->argument('name');
        $domain = $this->argument('domain');

        // 1. Create tenant
        $tenant = Tenant::create([
            'id' => strtolower(str_replace(' ', '-', $name)),
            'data' => ['name' => $name],
        ]);

        // 2. Attach domain
        $tenant->domains()->create(['domain' => $domain]);

        // 3. Run tenant-specific migrations
        Artisan::call('tenants:migrate', [
            '--tenant' => [$tenant->id],
        ]);

        $this->info("Tenant '{$name}' created and migrations run successfully!");
    }
}
