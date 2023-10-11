<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    // // Relation entre la table License et la table tenant
    // public function tenant(): BelongsTo 
    // {
    //     return $this->belongsTo(Tenant::class);
    // }
}
