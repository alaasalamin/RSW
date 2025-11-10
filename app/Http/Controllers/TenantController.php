<?php

namespace App\Http\Controllers;

use App\Services\TenantProvisioningService;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function store(Request $request, TenantProvisioningService $service)
    {
        $request->validate([
            'name' => 'required|string',
            'domain' => 'required|string',
        ]);

        $tenant = $service->createTenant($request->name, $request->domain);

        return response()->json([
            'message' => "Tenant '{$tenant->id}' created successfully",
            'tenant' => $tenant,
        ]);
    }
}
