<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant
{
    use HasDomains; // ✅ This adds the domains() relationship

    protected $fillable = [
        'id',
        'data',
    ];
}
