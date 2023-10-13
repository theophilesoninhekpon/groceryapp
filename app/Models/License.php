<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    // Les champs modifiables
    protected $fillable = [
        'offers_id',
        'status',
        'access_token',
        'expires_at',
        'created_by',
        'updated_by'
    ];
}
