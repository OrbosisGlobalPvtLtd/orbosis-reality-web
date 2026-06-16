<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenModal extends PersonalAccessToken
{
    const TABLE = 'personal_access_tokens_modal';
    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'tokenable_id',
        'tokenable_type',
        'expires_at',
    ];

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];
}
