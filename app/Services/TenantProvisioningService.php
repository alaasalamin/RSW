<?php

namespace App\Services;

use Stancl\Tenancy\Database\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class TenantProvisioningService
{
    /**
     * Create a new tenant with the given name and domain.
     */
    public function createTenant(string $name, string $domain): Tenant
    {
        $tenant = Tenant::create([
            'id' => str()->slug($name),
            'data' => [
                'name' => $name,
            ],
        ]);

        // Create a domain linked to this tenant
        $tenant->domains()->create([
            'domain' => $domain,
        ]);

        // Run tenant migrations
        Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --force',
            '--tenant' => $tenant->id,
        ]);

        return $tenant;
    }
}
