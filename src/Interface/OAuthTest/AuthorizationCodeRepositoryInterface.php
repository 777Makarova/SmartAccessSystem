<?php

namespace App\Interface\OAuthTest;

use App\Models\OAuthTest\AuthorizationCode;

interface AuthorizationCodeRepositoryInterface
{
    public function find(string $authCodeId): ?AuthorizationCode;

    public function save(AuthorizationCode $authCode): void;
}
