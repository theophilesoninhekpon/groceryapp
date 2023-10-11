<?php

namespace App\Models;

use App\Models\License;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'offers_id',
            'company',
            // 'access_token',
            'created_by',
            'updated_by'
        ];
    }

    // Relation entre la table Tenant et la table Domain
    public function domains()
    {
        return $this->hasMany(config('tenancy.domain_model'));
    }
    
    // // Relation entre la table Tenant et la table License
    // public function licenses(): HasMany 
    // {
    //     return $this->hasMany(License::class);
    // }
}